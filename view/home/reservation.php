<?php
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit;
}

// Inclure le fichier de configuration ou de connexion à la base de données si nécessaire
// include('config.php');

// Fonction pour enregistrer les actions des utilisateurs (à adapter selon votre méthode d'enregistrement)
function logUserAction($userEmail, $action, $circuit = null) {
    // Code pour enregistrer l'action dans la base de données ou un fichier journal
    // Par exemple : INSERT INTO logs (user_email, action, circuit, timestamp) VALUES (?, ?, ?, NOW())
}

// Exemple d'utilisation des fonctions
logUserAction($_SESSION['user_email'], 'Connexion');
logUserAction($_SESSION['user_email'], 'Ajout au panier', $circuit);
logUserAction($_SESSION['user_email'], 'Réservation', $circuit);
?>

<section class="py-5 bg-light-custom">
    <div class="container px-4">
        <h2 class="display-6 fw-bold text-dark mb-4 text-center">Réservation</h2>
        <?php if (!empty($_GET['success'])): ?>
            <div class="alert alert-success text-center">Votre réservation a bien été enregistrée !</div>
        <?php endif; ?>
        <!-- Ajoute ici le formulaire ou la liste des réservations -->
    </div>
</section>