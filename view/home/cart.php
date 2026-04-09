<?php
$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['prix'] * ($item['nombre_personnes'] ?? 1);
}
?>

<!-- Hero Section -->
<section class="reservation-hero py-4 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="mb-2">
                    <i class="fas fa-calendar-check me-2"></i>
                    Mes Réservations
                </h1>
                <p class="lead mb-0">
                    <i class="fas fa-map-marked-alt me-2"></i>
                    Gérez vos circuits sélectionnés
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-md-end mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-white-50">Accueil</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Mes Réservations</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Reservation Content -->
<section class="py-5 bg-light">
    <div class="container">
        <?php if (!empty($cart)): ?>
            <div class="row">
                <!-- Liste des réservations -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">
                                <i class="fas fa-list-ul text-primary me-2"></i>
                                Circuits sélectionnés
                            </h4>
                            <?php foreach ($cart as $key => $item): ?>
                                <div class="reservation-item mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h5 class="reservation-title">
                                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                                <?= htmlspecialchars($item['nom']) ?>
                                            </h5>
                                            <div class="reservation-details text-muted">
                                                <i class="fas fa-users me-2"></i>
                                                <?= $item['nombre_personnes'] ?? 1 ?> personne(s)
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <div class="reservation-price mb-2">
                                                <span class="h5 text-primary mb-0"><?= number_format($item['prix'] * ($item['nombre_personnes'] ?? 1), 0, ',', ' ') ?> Ar</span>
                                                <small class="text-muted">(<?= number_format($item['prix'], 0, ',', ' ') ?> Ar/pers.)</small>
                                            </div>
                                            <form method="post" action="index.php?controller=cart&action=delete" class="d-inline-block">
                                                <input type="hidden" name="key" value="<?= $key ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash me-2"></i>Retirer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($key !== array_key_last($cart)): ?>
                                    <hr class="reservation-divider">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Résumé et paiement -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">
                                <i class="fas fa-receipt text-primary me-2"></i>
                                Résumé
                            </h4>
                            <div class="summary-item d-flex justify-content-between mb-2">
                                <span class="text-muted">Sous-total</span>
                                <span class="fw-bold"><?= number_format($total, 0, ',', ' ') ?> Ar</span>
                            </div>
                            <hr>
                            <div class="summary-total d-flex justify-content-between align-items-center mb-4">
                                <span class="h5 mb-0">Total</span>
                                <span class="h4 text-primary mb-0"><?= number_format($total, 0, ',', ' ') ?> Ar</span>
                            </div>
                            <a href="index.php?controller=home&action=paiement" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-lock me-2"></i>
                                Procéder au paiement
                            </a>
                        </div>
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-shield-alt text-success me-2"></i>
                                Garanties
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Paiement sécurisé
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Confirmation immédiate
                                </li>
                                <li>
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Support client 24/7
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <div class="empty-cart-icon mb-4">
                    <i class="fas fa-calendar-times fa-4x text-muted"></i>
                </div>
                <h3>Aucune réservation</h3>
                <p class="text-muted mb-4">Vous n'avez pas encore sélectionné de circuit.</p>
                <a href="index.php?controller=home&action=circuit" class="btn btn-primary btn-lg">
                    <i class="fas fa-compass me-2"></i>
                    Découvrir nos circuits
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .reservation-hero {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }

    .reservation-item {
        background-color: #fff;
        transition: transform 0.2s ease;
    }

    .reservation-item:hover {
        transform: translateX(5px);
    }

    .reservation-title {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .reservation-details {
        font-size: 0.9rem;
    }

    .reservation-price {
        color: #0d6efd;
    }

    .reservation-divider {
        margin: 1.5rem 0;
        opacity: 0.1;
    }

    .summary-item {
        font-size: 0.95rem;
    }

    .btn-outline-danger {
        border-radius: 20px;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .empty-cart-icon {
        opacity: 0.5;
    }

    .card {
        border-radius: 1rem;
    }

    .summary-total {
        color: #2c3e50;
    }
</style>