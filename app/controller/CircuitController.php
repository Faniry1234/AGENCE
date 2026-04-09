<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();

class CircuitController {
    public function index() {
        $pageTitle = "Circuits - Mada Voyage";
        $view = 'circuit/index.php';
        require 'views/layout.php';
    }
}
