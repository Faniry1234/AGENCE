<?php
require_once __DIR__ . '/app/model/database.php';

try {
    $pdo = getPDO();
    
    // Création des tables si elles n'existent pas
    
    // Table users
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255),
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Table users vérifiée/créée<br>";

    // Table circuits
    $pdo->exec("CREATE TABLE IF NOT EXISTS circuits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titre VARCHAR(255) NOT NULL,
        description TEXT,
        prix DECIMAL(10,2) NOT NULL,
        duree VARCHAR(50),
        difficulte VARCHAR(50),
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Table circuits vérifiée/créée<br>";

    // Table réservations
    $pdo->exec("CREATE TABLE IF NOT EXISTS reservations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        circuit_id INT,
        date_reservation DATE,
        nombre_personnes INT,
        statut VARCHAR(50) DEFAULT 'en_attente',
        montant_total DECIMAL(10,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (circuit_id) REFERENCES circuits(id)
    )");
    echo "Table reservations vérifiée/créée<br>";

    // Table paiements
    $pdo->exec("CREATE TABLE IF NOT EXISTS paiements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        reservation_id INT,
        montant DECIMAL(10,2),
        methode_paiement VARCHAR(50),
        numero_transaction VARCHAR(255),
        statut VARCHAR(50),
        date_paiement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (reservation_id) REFERENCES reservations(id)
    )");
    echo "Table paiements vérifiée/créée<br>";

    // Table messages
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255),
        email VARCHAR(255),
        message TEXT,
        lu BOOLEAN DEFAULT FALSE,
        date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Table messages vérifiée/créée<br>";

    // Table historique des connexions
    $pdo->exec("CREATE TABLE IF NOT EXISTS login_history (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_email VARCHAR(255),
        login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Table login_history vérifiée/créée<br>";

    // Table actions utilisateurs
    $pdo->exec("CREATE TABLE IF NOT EXISTS user_actions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_email VARCHAR(255),
        action VARCHAR(255),
        details TEXT,
        action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Table user_actions vérifiée/créée<br>";

    // Mettre à jour ou créer le compte admin
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute(['admin@madavoyage.com']);
    $admin = $stmt->fetch();

    $password = 'admin123';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($admin) {
        // Mettre à jour le mot de passe admin existant
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? AND role = 'admin'");
        $stmt->execute([$hashedPassword, 'admin@madavoyage.com']);
        echo "Mot de passe administrateur mis à jour<br>";
    } else {
        // Créer le compte admin
        $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            'Administrateur',
            'admin@madavoyage.com',
            $hashedPassword,
            'admin'
        ]);
        echo "Compte administrateur créé avec succès<br>";
        echo "Email: admin@madavoyage.com<br>";
        echo "Mot de passe: admin123<br>";
    }

    // Vérifier si des circuits existent
    $stmt = $pdo->query("SELECT COUNT(*) FROM circuits");
    $circuitCount = $stmt->fetchColumn();

    if ($circuitCount == 0) {
        // Ajouter des circuits de démonstration
        $circuits = [
            [
                'Circuit Baobabs et Tsingy',
                'Découvrez les majestueux baobabs et les impressionnants Tsingy de Madagascar',
                1200.00,
                '7 jours',
                'Modérée',
                'baobab.jpg'
            ],
            [
                'Aventure Nord Madagascar',
                'Explorez les trésors cachés du nord de Madagascar',
                1500.00,
                '10 jours',
                'Difficile',
                'nord.jpg'
            ],
            [
                'Paradis de Nosy Be',
                'Détendez-vous sur les plages paradisiaques de Nosy Be',
                900.00,
                '5 jours',
                'Facile',
                'nosy.jpg'
            ],
            [
                'Trek dans le Parc National',
                'Randonnée à travers la faune et la flore uniques de Madagascar',
                1100.00,
                '6 jours',
                'Modérée',
                'sambo.jpg'
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO circuits (titre, description, prix, duree, difficulte, image) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($circuits as $circuit) {
            $stmt->execute($circuit);
        }
        echo "Circuits de démonstration ajoutés<br>";
    }

    echo "<br>Configuration de la base de données terminée avec succès !";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
