<?php
require_once __DIR__ . '/../middleware/auth.php';

class AdminController {
    public function __construct() {
        // Vérifier l'accès admin pour toutes les actions
        checkAdminAccess();
    }

    private function uploadImageFile(string $inputName, string $existingPath = ''): string {
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] === UPLOAD_ERR_NO_FILE) {
            return $existingPath;
        }

        if ($_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
            return $existingPath;
        }

        $allowedMime = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];

        $tmpFile = $_FILES[$inputName]['tmp_name'];
        $imageInfo = getimagesize($tmpFile);
        if (!$imageInfo || !isset($allowedMime[$imageInfo['mime']])) {
            return $existingPath;
        }

        $uploadDir = __DIR__ . '/../../public/assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = $allowedMime[$imageInfo['mime']];
        $filename = uniqid('img_', true) . '.' . $extension;
        $destination = $uploadDir . $filename;

        if (move_uploaded_file($tmpFile, $destination)) {
            return 'public/assets/images/' . $filename;
        }

        return $existingPath;
    }

    public function index() {
        $pageTitle = "Administration";
        $view = 'admin/index.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function users() {
        $pageTitle = "Gestion des utilisateurs";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $view = 'admin/users.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function circuits() {
        $pageTitle = "Gestion des circuits";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $stmt = $pdo->query("SELECT * FROM circuits ORDER BY created_at DESC");
        $circuits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $view = 'admin/circuits.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function reservations() {
        $pageTitle = "Gestion des réservations";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();

        try {
            // Vérifier si la table existe
            $tableExists = $pdo->query("SHOW TABLES LIKE 'reservations'")->rowCount() > 0;
            
            if (!$tableExists) {
                // Rediriger vers la page de configuration
                header('Location: setup_reservations.php');
                exit;
            }

            // Récupérer les réservations avec la structure existante
            $stmt = $pdo->query("SELECT 
                r.id,
                r.user_id,
                r.circuit_id,
                r.nombre_personnes,
                r.montant_total,
                r.statut,
                r.created_at,
                u.email as user_email,
                COALESCE(c.titre, 'Circuit inconnu') as circuit_titre
            FROM reservations r 
            LEFT JOIN users u ON r.user_id = u.id 
            LEFT JOIN circuits c ON r.circuit_id = c.id 
            ORDER BY r.created_at DESC");
            
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $view = 'admin/reservations.php';
            require __DIR__ . '/../../view/layout/layout.php';
        } catch (PDOException $e) {
            // Gérer l'erreur
            die("Erreur lors de la récupération des réservations : " . $e->getMessage());
        }
    }

    public function paiements() {
        $pageTitle = "Gestion des paiements";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $stmt = $pdo->query("SELECT p.*, r.montant_total as reservation_montant, u.email as user_email 
                            FROM paiements p 
                            LEFT JOIN reservations r ON p.reservation_id = r.id 
                            LEFT JOIN users u ON r.user_id = u.id 
                            ORDER BY p.date_paiement DESC");
        $paiements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $view = 'admin/paiements.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function messages() {
        $pageTitle = "Messages reçus";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $stmt = $pdo->query("SELECT * FROM messages ORDER BY date_envoi DESC");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $view = 'admin/messages.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function login() {
        $pageTitle = "Connexion Admin";
        $loginError = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            require_once __DIR__ . '/../model/database.php';
            $pdo = getPDO();
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin'] = $user['nom'];
                $_SESSION['user'] = $user['nom'] ?: $user['email'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];
                $stmt = $pdo->prepare("INSERT INTO login_history (user_email) VALUES (?)");
                $stmt->execute([$user['email']]);
                header('Location: index.php?controller=admin&action=index');
                exit;
            } else {
                $loginError = "Identifiants incorrects.";
            }
        }
        $view = 'admin/login.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function logout() {
        // Nettoyer toutes les variables de session
        unset($_SESSION['user'], $_SESSION['user_email'], $_SESSION['admin'], $_SESSION['user_id']);
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
        exit;
    }

    // ============== UTILISATEURS ==============
    public function addUser() {
        $pageTitle = "Ajouter un utilisateur";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../model/database.php';
            $pdo = getPDO();
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($nom && $email && $password) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->execute([$nom, $email, $hashedPassword, $role]);
                header('Location: index.php?controller=admin&action=users');
                exit;
            }
        }
        $view = 'admin/form_user.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function editUser() {
        $pageTitle = "Modifier un utilisateur";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($nom && $email && $id) {
                $stmt = $pdo->prepare("UPDATE users SET nom = ?, email = ?, role = ? WHERE id = ?");
                $stmt->execute([$nom, $email, $role, $id]);
                header('Location: index.php?controller=admin&action=users');
                exit;
            }
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $view = 'admin/form_user.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function deleteUser() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=users');
        exit;
    }

    // ============== CIRCUITS ==============
    public function addCircuit() {
        $pageTitle = "Ajouter un circuit";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../model/database.php';
            $pdo = getPDO();
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $prix = $_POST['prix'] ?? '';
            $duree = $_POST['duree'] ?? '';
            $difficulte = $_POST['difficulte'] ?? '';
            $image = $_POST['image'] ?? '';
            $image = $this->uploadImageFile('image_file', $image);

            if ($titre && $prix) {
                $stmt = $pdo->prepare("INSERT INTO circuits (titre, description, prix, duree, difficulte, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$titre, $description, $prix, $duree, $difficulte, $image]);
                header('Location: index.php?controller=admin&action=circuits');
                exit;
            }
        }
        $view = 'admin/form_circuit.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function editCircuit() {
        $pageTitle = "Modifier un circuit";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $prix = $_POST['prix'] ?? '';
            $duree = $_POST['duree'] ?? '';
            $difficulte = $_POST['difficulte'] ?? '';
            $image = $_POST['image'] ?? '';
            $image = $this->uploadImageFile('image_file', $image);

            if ($titre && $prix && $id) {
                $stmt = $pdo->prepare("UPDATE circuits SET titre = ?, description = ?, prix = ?, duree = ?, difficulte = ?, image = ? WHERE id = ?");
                $stmt->execute([$titre, $description, $prix, $duree, $difficulte, $image, $id]);
                header('Location: index.php?controller=admin&action=circuits');
                exit;
            }
        }

        $stmt = $pdo->prepare("SELECT * FROM circuits WHERE id = ?");
        $stmt->execute([$id]);
        $circuit = $stmt->fetch(PDO::FETCH_ASSOC);

        $view = 'admin/form_circuit.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function deleteCircuit() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM circuits WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=circuits');
        exit;
    }

    // ============== ÉQUIPES ==============
    public function equipes() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();

        $pdo->exec("CREATE TABLE IF NOT EXISTS equipes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(255) NOT NULL,
            role VARCHAR(255) NOT NULL,
            bio TEXT,
            image VARCHAR(255),
            whatsapp VARCHAR(255),
            email VARCHAR(255),
            facebook VARCHAR(255),
            ordre INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $stmt = $pdo->query("SELECT * FROM equipes ORDER BY ordre ASC, nom ASC");
        $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pageTitle = "Gestion des équipes";
        $view = 'admin/equipes.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function addEquipe() {
        $pageTitle = "Ajouter un membre de l'équipe";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../model/database.php';
            $pdo = getPDO();
            $nom = $_POST['nom'] ?? '';
            $role = $_POST['role'] ?? '';
            $bio = $_POST['bio'] ?? '';
            $image = $_POST['image'] ?? '';
            $image = $this->uploadImageFile('image_file', $image);
            $whatsapp = $_POST['whatsapp'] ?? '';
            $email = $_POST['email'] ?? '';
            $facebook = $_POST['facebook'] ?? '';
            $ordre = $_POST['ordre'] ?? 0;

            if ($nom && $role) {
                $stmt = $pdo->prepare("INSERT INTO equipes (nom, role, bio, image, whatsapp, email, facebook, ordre) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$nom, $role, $bio, $image, $whatsapp, $email, $facebook, $ordre]);
                header('Location: index.php?controller=admin&action=equipes');
                exit;
            }
        }
        $view = 'admin/form_equipe.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function editEquipe() {
        $pageTitle = "Modifier un membre de l'équipe";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $role = $_POST['role'] ?? '';
            $bio = $_POST['bio'] ?? '';
            $image = $_POST['image'] ?? '';
            $image = $this->uploadImageFile('image_file', $image);
            $whatsapp = $_POST['whatsapp'] ?? '';
            $email = $_POST['email'] ?? '';
            $facebook = $_POST['facebook'] ?? '';
            $ordre = $_POST['ordre'] ?? 0;

            if ($nom && $role && $id) {
                $stmt = $pdo->prepare("UPDATE equipes SET nom = ?, role = ?, bio = ?, image = ?, whatsapp = ?, email = ?, facebook = ?, ordre = ? WHERE id = ?");
                $stmt->execute([$nom, $role, $bio, $image, $whatsapp, $email, $facebook, $ordre, $id]);
                header('Location: index.php?controller=admin&action=equipes');
                exit;
            }
        }

        $stmt = $pdo->prepare("SELECT * FROM equipes WHERE id = ?");
        $stmt->execute([$id]);
        $equipe = $stmt->fetch(PDO::FETCH_ASSOC);

        $view = 'admin/form_equipe.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function deleteEquipe() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM equipes WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=equipes');
        exit;
    }

    // ============== RÉSERVATIONS ==============
    public function deleteReservation() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['key'] ?? $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=reservations');
        exit;
    }

    public function confirmReservation() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("UPDATE reservations SET statut = 'confirmé' WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=reservations');
        exit;
    }

    public function viewReservationDetails() {
        $pageTitle = "Détails de la réservation";
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        $stmt = $pdo->prepare("SELECT r.*, u.nom as user_nom, u.email as user_email, c.titre as circuit_titre 
                             FROM reservations r 
                             LEFT JOIN users u ON r.user_id = u.id 
                             LEFT JOIN circuits c ON r.circuit_id = c.id 
                             WHERE r.id = ?");
        $stmt->execute([$id]);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        $view = 'admin/reservation_details.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    // ============== PAIEMENTS ==============
    public function deletePayment() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM paiements WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=paiements');
        exit;
    }

    // ============== MESSAGES ==============
    public function deleteMessage() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $id = $_GET['id'] ?? null;

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
            $stmt->execute([$id]);
        }
        header('Location: index.php?controller=admin&action=messages');
        exit;
    }
}
