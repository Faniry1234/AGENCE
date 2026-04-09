<?php
require_once __DIR__ . '/app/model/database.php';

try {
    $pdo = getPDO();
    
    // Vérifier le contenu actuel de la table users
    $stmt = $pdo->query("SELECT * FROM users WHERE role = 'admin'");
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "Détails du compte admin:<br>";
        echo "ID: " . $admin['id'] . "<br>";
        echo "Email: " . $admin['email'] . "<br>";
        echo "Rôle: " . $admin['role'] . "<br>";
        echo "Hash actuel: " . $admin['password'] . "<br><br>";
        
        // Créer un nouveau hash pour 'admin123'
        $newHash = password_hash('admin123', PASSWORD_DEFAULT);
        echo "Nouveau hash pour 'admin123': " . $newHash . "<br><br>";
        
        // Mettre à jour le mot de passe
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? AND role = 'admin'");
        $stmt->execute([$newHash, 'admin@madavoyage.com']);
        
        echo "Le mot de passe a été mis à jour.<br>";
        echo "Vous pouvez maintenant essayer de vous connecter avec:<br>";
        echo "Email: admin@madavoyage.com<br>";
        echo "Mot de passe: admin123";
    } else {
        echo "Aucun compte admin trouvé! Création d'un nouveau compte...<br>";
        
        $newHash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute(['Administrateur', 'admin@madavoyage.com', $newHash, 'admin']);
        
        echo "Nouveau compte admin créé!<br>";
        echo "Email: admin@madavoyage.com<br>";
        echo "Mot de passe: admin123";
    }
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
