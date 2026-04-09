<?php
require_once __DIR__ . '/app/model/database.php';

try {
    $pdo = getPDO();

    // 1. Créer la table reservations
    $pdo->exec("DROP TABLE IF EXISTS reservations");
    $pdo->exec("CREATE TABLE reservations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        circuit_id INT,
        date_reservation DATE,
        nombre_personnes INT DEFAULT 1,
        statut VARCHAR(50) DEFAULT 'en_attente',
        montant_total DECIMAL(10,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (circuit_id) REFERENCES circuits(id)
    )");
    echo "Table reservations créée avec succès<br>";

    // 2. Ajouter des données de test
    $pdo->exec("INSERT INTO reservations (user_id, circuit_id, date_reservation, nombre_personnes, montant_total, statut) 
                SELECT 
                    (SELECT id FROM users WHERE role = 'admin' LIMIT 1),
                    (SELECT id FROM circuits LIMIT 1),
                    CURRENT_DATE,
                    2,
                    1200.00,
                    'en_attente'");
    echo "Données de test ajoutées avec succès<br>";

    echo "<br>Configuration terminée avec succès !";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
