<?php
function checkAdminAccess() {
    if (!isset($_SESSION['admin'])) {
        header('Location: index.php?controller=auth&action=index');
        exit;
    }
}
?>
