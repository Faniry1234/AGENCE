<?php
if ($_SERVER['REQUEST_URI'] === '/admin' || $_SERVER['REQUEST_URI'] === '/admin/') {
    header('Location: index.php?controller=admin&action=login');
    exit;
}

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$baseDir = dirname(__DIR__); // racine du projet

$controllerFile = $baseDir . "/app/controller/" . ucfirst($controller) . "Controller.php";
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . "Controller";
    if (class_exists($className)) {
        $ctrl = new $className();
        if (method_exists($ctrl, $action)) {
            $ctrl->$action();
            exit;
        }
    }
}

// Fallback : page d'accueil
require_once $baseDir . "/app/controller/HomeController.php";
$ctrl = new HomeController();
$ctrl->index();