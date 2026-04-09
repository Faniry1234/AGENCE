<?php
class CartController {
    public function add() {
        // Récupère le nom du circuit envoyé par le formulaire
        $circuitNom = $_POST['circuit'] ?? '';
        $nombre_personnes = $_POST['nombre_personnes'] ?? 1;
        // Liste des circuits (doit être identique à celui de la vue circuit)
        $circuits = [
            [
                'nom' => "Aventure au Nord : Tsingy & Baobabs",
                'prix' => 250000
            ],
            [
                'nom' => "Détente au Sud : Plages & Lémuriens",
                'prix' => 300000
            ],
            [
                'nom' => "Immersion Culturelle à l'Est",
                'prix' => 200000
            ],
            [
                'nom' => "Nosy Be : L'île aux Parfums",
                'prix' => 350000
            ],
            [
                'nom' => "Parc National de l'Isalo",
                'prix' => 400000
            ],
            [
                'nom' => "Antananarivo : La Capitale",
                'prix' => 150000
            ]
        ];
        // Recherche le circuit dans le tableau
        foreach ($circuits as $circuit) {
            if ($circuit['nom'] === $circuitNom) {
                $_SESSION['cart'][] = [
                    'nom' => $circuit['nom'],
                    'prix' => $circuit['prix'],
                    'nombre_personnes' => $nombre_personnes
                ];
                break;
            }
        }
        header('Location: index.php?controller=home&action=panier');
        exit;
    }

    public function index() {
        $pageTitle = "Votre panier";
        $view = 'home/cart.php';
        require __DIR__ . '/../../view/layout/layout.php';
    }

    public function delete() {
        $key = $_POST['key'] ?? null;
        if ($key !== null && isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Réindexer
        }
        header('Location: index.php?controller=home&action=panier');
        exit;
    }
}