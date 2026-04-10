<?php
/**
 * Configuration d'environnement pour Mada Voyage
 * Charge les paramètres depuis .env ou utilise les valeurs par défaut
 */

// Chemin du fichier .env
$envFile = dirname(__DIR__) . '/.env';

// Fonction pour charger les variables d'environnement
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        return;
    }
    
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            $value = trim($value, '"\'');
            
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

loadEnv($envFile);

// Configuration de base
define('APP_NAME', getenv('APP_NAME') ?: 'Mada Voyage');
define('APP_ENV', getenv('APP_ENV') ?: 'development');
define('APP_DEBUG', getenv('APP_DEBUG') ?: false);
define('APP_URL', getenv('APP_URL') ?: 'http://localhost');
define('APP_PORT', getenv('APP_PORT') ?: 8000);

// Configuration de la base de données
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: 3306);
define('DB_NAME', getenv('DB_NAME') ?: 'madavoyage');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');
define('DB_SSL_MODE', getenv('DB_SSL_MODE') ?: 'DISABLED');

// Chemins des fichiers
define('ROOT_PATH', dirname(__DIR__) . '/');
define('PUBLIC_PATH', ROOT_PATH . 'public/');
define('ASSETS_PATH', PUBLIC_PATH . 'assets/');
define('IMAGES_PATH', ASSETS_PATH . 'images/');
define('UPLOAD_PATH', ASSETS_PATH . 'uploads/');
define('VIEW_PATH', ROOT_PATH . 'view/');
define('CONTROLLER_PATH', ROOT_PATH . 'app/controller/');
define('MODEL_PATH', ROOT_PATH . 'app/model/');

// Chemins relatifs web
define('IMAGES_WEB_PATH', 'public/assets/images/');
define('UPLOADS_WEB_PATH', 'public/assets/uploads/');

// Configuration de sécurité
define('SESSION_TIMEOUT', getenv('SESSION_TIMEOUT') ?: 3600); // 1 heure
define('MAX_UPLOAD_SIZE', getenv('MAX_UPLOAD_SIZE') ?: 5242880); // 5 MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('ALLOWED_MIMES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

// Chemins de logs
define('LOG_PATH', getenv('LOG_PATH') ?: ROOT_PATH . 'logs/');

// Configuration d'erreurs
if (APP_ENV === 'production') {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Fuseau horaire
date_default_timezone_set(getenv('TIMEZONE') ?: 'Indian/Antananarivo');

// Fonction helper pour déboguer en développement
function debugLog($message, $data = null) {
    if (APP_DEBUG) {
        $logFile = LOG_PATH . date('Y-m-d') . '.log';
        $timestamp = date('Y-m-d H:i:s');
        $message = "[$timestamp] $message";
        if ($data) {
            $message .= "\n" . print_r($data, true);
        }
        error_log($message . "\n", 3, $logFile);
    }
}

// Vérifier et créer les dossiers nécessaires
foreach ([UPLOAD_PATH, LOG_PATH ?? null] as $path) {
    if ($path && !is_dir($path)) {
        @mkdir($path, 0755, true);
    }
}

// Classe pour les configurations dynamiques
class Config {
    private static $configs = [];
    
    public static function set($key, $value) {
        self::$configs[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        return self::$configs[$key] ?? $default;
    }
}

return [
    'app' => [
        'name' => APP_NAME,
        'env' => APP_ENV,
        'debug' => APP_DEBUG,
        'url' => APP_URL,
    ],
    'database' => [
        'host' => DB_HOST,
        'port' => DB_PORT,
        'name' => DB_NAME,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'charset' => DB_CHARSET,
    ],
    'paths' => [
        'root' => ROOT_PATH,
        'public' => PUBLIC_PATH,
        'assets' => ASSETS_PATH,
        'images' => IMAGES_PATH,
        'uploads' => UPLOAD_PATH,
        'views' => VIEW_PATH,
    ],
    'upload' => [
        'max_size' => MAX_UPLOAD_SIZE,
        'allowed_extensions' => ALLOWED_EXTENSIONS,
        'allowed_mimes' => ALLOWED_MIMES,
    ],
];
