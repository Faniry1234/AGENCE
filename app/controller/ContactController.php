<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();

class ContactController {
    public function index() {
        $pageTitle = "Contact - Mada Voyage";
        $view = 'contact/index.php';
        require 'views/layout.php';
    }
}
