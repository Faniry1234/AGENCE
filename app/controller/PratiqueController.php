<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();

class PratiqueController {
    public function index() {
        $pageTitle = "Pratique - Mada Voyage";
        $view = 'pratique/index.php';
        require 'views/layout.php';
    }
}
