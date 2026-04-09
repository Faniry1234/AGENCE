<?php
/**
 * Application entry point for Mada Voyage
 * Charge la configuration, gère le routage et exécute les contrôleurs
 */

// Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Charger la configuration d'environnement
require_once __DIR__ . '/config/Config.php';

// Charger le système de routage
require_once __DIR__ . '/core/route.php';

// Définir les headers de sécurité
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Récupérer les paramètres de routage
$controller = filter_var($_GET['controller'] ?? 'home', FILTER_SANITIZE_STRING);
$action = filter_var($_GET['action'] ?? 'index', FILTER_SANITIZE_STRING);

// Valider les paramètres (éviter path traversal)
if (!preg_match('/^[a-zA-Z0-9_]+$/', $controller) || !preg_match('/^[a-zA-Z0-9_]+$/', $action)) {
    http_response_code(400);
    die('Invalid request parameters');
}

try {
    // Construire le chemin du contrôleur
    $controllerFile = __DIR__ . "/app/controller/" . ucfirst($controller) . "Controller.php";
    
    if (!file_exists($controllerFile)) {
        http_response_code(404);
        throw new Exception("Contrôleur non trouvé: " . htmlspecialchars($controller));
    }
    
    require_once $controllerFile;
    
    $className = ucfirst($controller) . "Controller";
    
    if (!class_exists($className)) {
        http_response_code(500);
        throw new Exception("La classe contrôleur n'existe pas: " . htmlspecialchars($className));
    }
    
    // Créer une instance du contrôleur
    $ctrl = new $className();
    
    if (!method_exists($ctrl, $action)) {
        http_response_code(404);
        throw new Exception("L'action n'existe pas: " . htmlspecialchars($action));
    }
    
    // Exécuter l'action
    $ctrl->$action();
    
} catch (Exception $e) {
    // Gestion des erreurs
    if (APP_DEBUG) {
        echo "<div style='background: #fee; padding: 20px; margin: 20px; border: 1px solid #f00;'>";
        echo "<h2>Erreur</h2>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        echo "</div>";
    } else {
        http_response_code(500);
        error_log($e->getMessage());
        echo file_get_contents(__DIR__ . '/view/error/500.php') ?? 'Une erreur est survenue.';
    }
    exit;
}