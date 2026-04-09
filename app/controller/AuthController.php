<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();

class AuthController {
    public function index() {
        $pageTitle = "Connexion";
        $loginError = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            require_once __DIR__ . '/../model/database.php';
            $pdo = getPDO();
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                // Si admin, redirige vers admin dashboard
                if ($user['role'] === 'admin') {
                    $_SESSION['admin'] = $user['nom'];
                    $_SESSION['user'] = $user['nom'] ?: $user['email'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_id'] = $user['id'];
                    $stmt = $pdo->prepare("INSERT INTO login_history (user_email) VALUES (?)");
                    $stmt->execute([$user['email']]);
                    header('Location: index.php?controller=admin&action=index');
                    exit;
                }
                // Client normal
                $_SESSION['user'] = $user['nom'] ?: $user['email'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];
                $stmt = $pdo->prepare("INSERT INTO login_history (user_email) VALUES (?)");
                $stmt->execute([$user['email']]);
                header('Location: index.php?controller=auth&action=profil');
                exit;
            } else {
                $loginError = "Identifiants incorrects.";
            }
        }
        $view = 'auth/login.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function register() {
        $pageTitle = "Inscription";
        $registerError = '';
        $registerSuccess = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $pass = $_POST['password'] ?? '';
            $pass2 = $_POST['password2'] ?? '';
            if ($pass !== $pass2) {
                $registerError = "Les mots de passe ne correspondent pas.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $registerError = "Email invalide.";
            } elseif (strlen($pass) < 6) {
                $registerError = "Mot de passe trop court.";
            } else {
                require_once __DIR__ . '/../model/database.php';
                $pdo = getPDO();
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $registerError = "Cet email est déjà utilisé.";
                } else {
                    $stmt = $pdo->prepare("INSERT INTO users (nom, email, password) VALUES (?, ?, ?)");
                    $stmt->execute([$nom, $email, password_hash($pass, PASSWORD_DEFAULT)]);
                    $registerSuccess = true;
                }
            }
        }
        $view = 'auth/register.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function logout() {
        // Nettoyer toutes les variables de session
        unset($_SESSION['user'], $_SESSION['user_email'], $_SESSION['admin'], $_SESSION['user_id']);
        session_destroy();
        header('Location: index.php?controller=auth&action=index');
        exit;
    }

    public function profil() {
        if (empty($_SESSION['user_email'])) {
            header('Location: index.php?controller=auth&action=index');
            exit;
        }
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$_SESSION['user_email']]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $userData['nom'] ?? $userData['email'];
        // Récupérer l'historique des connexions
        $stmt = $pdo->prepare("SELECT login_time FROM login_history WHERE user_email = ? ORDER BY login_time DESC LIMIT 10");
        $stmt->execute([$_SESSION['user_email']]);
        $loginHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Récupérer les actions de l'utilisateur
        $stmt = $pdo->prepare("SELECT action, details, action_time FROM user_actions WHERE user_email = ? ORDER BY action_time DESC LIMIT 20");
        $stmt->execute([$_SESSION['user_email']]);
        $userActions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pageTitle = "Mon profil";
        $view = 'auth/profil.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
}