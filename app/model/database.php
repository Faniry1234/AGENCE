<?php
/**
 * Gestion de la connexion à la base de données
 */

// Charger la configuration
if (!defined('DB_HOST')) {
    require_once dirname(__DIR__, 2) . '/config/Config.php';
}

/**
 * Obtenir une instance PDO pour la base de données
 * @return PDO
 * @throws PDOException
 */
function getPDO() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            // Configuration depuis les constantes (fichier .env)
            $host = DB_HOST;
            $port = DB_PORT;
            $user = DB_USER;
            $password = DB_PASS;
            $database = DB_NAME;
            $charset = DB_CHARSET;
            $sslMode = DB_SSL_MODE;
            
            // Créer l'instance PDO
            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";
            
            // Options PDO
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            // Configuration SSL si nécessaire
            if ($sslMode === 'REQUIRED') {
                // Force SSL connection
                $options[PDO::MYSQL_ATTR_SSL_CA] = null;
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
            }
            
            $pdo = new PDO($dsn, $user, $password, $options);
            
            // Log en développement
            if (APP_DEBUG) {
                debugLog('Database connected successfully with SSL mode: ' . $sslMode);
            }
            
        } catch (PDOException $e) {
            // Gestion des erreurs
            if (APP_ENV === 'production') {
                error_log('Database connection error: ' . $e->getMessage());
                die('Database connection error. Please contact administrator.');
            } else {
                die('Erreur de connexion BD: ' . $e->getMessage());
            }
        }
    }
    
    return $pdo;
}

/**
 * Fermer la connexion à la base de données
 */
function closePDO() {
    global $pdo;
    if ($pdo !== null) {
        $pdo = null;
    }
}

// Initialiser la connexion
$pdo = getPDO();

