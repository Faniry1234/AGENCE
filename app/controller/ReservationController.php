<?php
require_once __DIR__ . '/../model/database.php';
$pdo = getPDO();

class ReservationController {
    public function index() {
        $pageTitle = "Réservation";
        $view = 'reservation/index.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }
    public function reserve() {
        require_once __DIR__ . '/../model/database.php';
        $pdo = getPDO();
        $circuitNom = $_POST['circuit'] ?? '';
        $stmt = $pdo->prepare("SELECT id, nom, prix FROM circuits WHERE nom = ?");
        $stmt->execute([$circuitNom]);
        $circuit = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($circuit) {
            $userId = $_SESSION['user_id'] ?? null;
            $stmt = $pdo->prepare("INSERT INTO reservations (user_id, circuit_id, montant, statut, type_paiement) VALUES (?, ?, ?, 'en attente', 'total')");
            $stmt->execute([$userId, $circuit['id'], $circuit['prix']]);
            $_SESSION['reservation_id'] = $pdo->lastInsertId();
            // Ajoute le circuit réservé dans la session pour l'affichage
            $_SESSION['reservation'][] = [
                'nom' => $circuit['nom'],
                'prix' => $circuit['prix']
            ];
            header('Location: index.php?controller=reservation&action=index&success=1');
            exit;
        }
    }
    public function delete() {
        $key = $_POST['key'] ?? null;
        if ($key !== null && isset($_SESSION['reservation'][$key])) {
            unset($_SESSION['reservation'][$key]);
            $_SESSION['reservation'] = array_values($_SESSION['reservation']); // Réindexer
        }
        header('Location: index.php?controller=reservation&action=index');
        exit;
    }
    public function deleteReservation() {
        if (empty($_SESSION['admin'])) {
            header('Location: index.php?controller=admin&action=login');
            exit;
        }
        $key = $_GET['key'] ?? null;
        if ($key !== null && isset($_SESSION['reservation'][$key])) {
            unset($_SESSION['reservation'][$key]);
            $_SESSION['reservation'] = array_values($_SESSION['reservation']);
        }
        header('Location: index.php?controller=admin&action=reservations');
        exit;
    }
}