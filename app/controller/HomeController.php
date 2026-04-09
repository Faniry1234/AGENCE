<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();
class HomeController {
    private function getCircuits() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        try {
            $stmt = $pdo->query("SELECT * FROM circuits ORDER BY created_at DESC");
            $circuits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $circuits = [];
        }

        if (empty($circuits)) {
            $circuits = [
                [
                    'id' => 1,
                    'titre' => 'Aventure au Nord : Tsingy & Baobabs',
                    'description' => 'Explorez les célèbres Tsingy de Bemaraha, les majestueux baobabs et la faune unique du nord de Madagascar.',
                    'image' => 'public/assets/images/tsingy.jpg',
                    'prix' => 250000,
                    'duree' => '7 jours',
                    'difficulte' => 'Moyenne'
                ],
                [
                    'id' => 2,
                    'titre' => 'Détente au Sud : Plages & Lémuriens',
                    'description' => 'Profitez des plages paradisiaques du sud, partez à la rencontre des lémuriens et découvrez la culture locale.',
                    'image' => 'public/assets/images/plage.jpg',
                    'prix' => 300000,
                    'duree' => '6 jours',
                    'difficulte' => 'Facile'
                ],
                [
                    'id' => 3,
                    'titre' => "Immersion Culturelle à l'Est",
                    'description' => "Vivez une expérience authentique dans l’est malgache, entre forêts tropicales et villages traditionnels.",
                    'image' => 'public/assets/images/est.jpg',
                    'prix' => 200000,
                    'duree' => '5 jours',
                    'difficulte' => 'Moyenne'
                ]
            ];
        }

        return $circuits;
    }

    public function index() {
        $pageTitle = "Accueil - Mada Voyage";
        $view = 'home/index.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function circuit() {
        $circuits = $this->getCircuits();
        $pageTitle = "Nos Circuits";
        $view = 'home/circuit.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function circuitDetail() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $circuits = $this->getCircuits();
        $circuit = null;
        if ($id !== null) {
            foreach ($circuits as $item) {
                if (isset($item['id']) && intval($item['id']) === $id) {
                    $circuit = $item;
                    break;
                }
            }
        }

        if (!$circuit) {
            header('Location: index.php?controller=home&action=circuit');
            exit;
        }

        $pageTitle = "Détails du circuit";
        $view = 'home/circuit_detail.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function contact() {
        $contactSuccess = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            require_once __DIR__ . '/../model/database.php';
            $pdo = getPDO();
            $stmt = $pdo->prepare("INSERT INTO messages (nom, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $email, $message]);
            $contactSuccess = true;
        }
        $pageTitle = "Contact";
        $view = 'home/contact.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function equipes() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        try {
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
        } catch (PDOException $e) {
            $equipes = [];
        }
        $pageTitle = "Notre équipe";
        $view = 'home/equipes.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function pratique() {
        $pageTitle = "Infos pratiques";
        $view = 'home/pratique.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function login() {
        $pageTitle = "Connexion";
        $view = 'auth/index.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function inscription() {
        $pageTitle = "Inscription";
        $view = 'auth/register.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function panier() {
        $pageTitle = "Votre panier";
        $view = 'home/cart.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function paiement() {
        $pageTitle = "Paiement";
        $paiementSuccess = false;
        $paiementError = '';
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();

        // Calcule le montant total du panier
        $montant = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $montant += $item['prix'] * ($item['nombre_personnes'] ?? 1);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $methode = $_POST['methode'] ?? '';
            $numero = $_POST['numero'] ?? '';
            // Utilise le montant calculé, pas celui du POST
            if (!$methode || !$numero || !$montant) {
                $paiementError = "Tous les champs sont obligatoires.";
            } else {
                // Enregistre les réservations
                $userId = $_SESSION['user_id'] ?? null;
                foreach ($_SESSION['cart'] as $item) {
                    // Trouver l'id du circuit
                    $stmt = $pdo->prepare("SELECT id FROM circuits WHERE titre = ?");
                    $stmt->execute([$item['nom']]);
                    $circuit = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($circuit) {
                        $stmt = $pdo->prepare("INSERT INTO reservations (user_id, circuit_id, nombre_personnes, montant_total, statut, created_at) VALUES (?, ?, ?, ?, 'en_attente', NOW())");
                        $stmt->execute([$userId, $circuit['id'], $item['nombre_personnes'] ?? 1, $item['prix'] * ($item['nombre_personnes'] ?? 1)]);
                    }
                }
                // Enregistre le paiement
                $stmt = $pdo->prepare("INSERT INTO paiements (montant, methode, date_paiement) VALUES (?, ?, NOW())");
                $stmt->execute([$montant, $methode]);
                $paiementSuccess = true;
                // Vider le panier après paiement
                unset($_SESSION['cart']);
            }
        }
        $view = 'home/paiement.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function service() {
        $pageTitle = "Nos Services";
        $view = 'home/service.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
}
