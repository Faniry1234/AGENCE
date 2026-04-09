<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();

class EquipesController {
    public function index() {
        $pageTitle = "Notre équipe - Mada Voyage";
        $view = 'equipes/index.php';
        require 'views/layout.php';
    }
}
