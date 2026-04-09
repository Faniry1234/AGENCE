<?php
require_once __DIR__ . '/app/model/database.php';

try {
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

    echo "Table 'equipes' créée ou déjà existante avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la création de la table equipes : " . $e->getMessage();
}
?>
