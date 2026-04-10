<?php
// filepath: e:\structure mvc by mr Avotra\view\layout\layout.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pageTitle) ? $pageTitle : 'Mada Voyage - Voyages Touristiques à Madagascar' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="Mada Voyage - Découvrez les plus beaux circuits touristiques à Madagascar avec nos équipes expérimentées.">
    <meta name="theme-color" content="#0277bd">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="public/assets/css/style.css" rel="stylesheet">
    <link href="public/assets/css/responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-light-custom text-dark">
    <?php
    // Démarre la session si nécessaire
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Affiche le header admin si connecté en tant qu'admin
    if (!empty($_SESSION['admin'])) {
        if (file_exists(__DIR__ . '/../admin/header.php')) {
            include __DIR__ . '/../admin/header.php';
        } else {
            echo '<header class="navbar navbar-dark bg-dark"><div class="container"><span class="text-light fw-bold">Admin connecté</span></div></header>';
        }
    } else {
        include __DIR__ . '/../home/header.php';
    }
    ?>
    <main>
        <?php 
        // Affiche le contenu de la vue demandée
        if (!empty($view) && file_exists(__DIR__ . '/../' . $view)) {
            include __DIR__ . '/../' . $view;
        } else {
            echo '<div class="container py-5"><div class="alert alert-danger">Vue introuvable.</div></div>';
        }
        ?>
    </main>
    <?php
    // Affiche le footer admin si connecté en tant qu'admin
    if (!empty($_SESSION['admin'])) {
        if (file_exists(__DIR__ . '/../admin/footer.php')) {
            include __DIR__ . '/../admin/footer.php';
        } else {
            echo '<footer class="bg-dark text-light text-center py-3"><small>Admin Mada Voyage &copy; ' . date('Y') . '</small></footer>';
        }
    } else {
        include __DIR__ . '/../home/footer.php';
    }
    ?>
    <script src="public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>