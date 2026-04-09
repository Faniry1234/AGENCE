<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$circuits = $circuits ?? [];
?>
<section id="nos-voyages" class="py-5 py-md-5 bg-light-custom">
    <div class="container px-4 text-center">
        <h2 class="display-5 fw-bold text-dark mb-5">Nos Circuits Phares</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($circuits as $circuit): ?>
            <div class="col">
                <div class="card h-100 shadow-sm overflow-hidden">
                    <img src="<?= htmlspecialchars($circuit['image'] ?? $circuit['img'] ?? 'public/assets/images/tsingy.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($circuit['titre'] ?? $circuit['nom']) ?>">
                    <div class="card-body p-4 d-flex flex-column">
                        <h3 class="h5 card-title fw-semibold mb-2 text-dark"><?= htmlspecialchars($circuit['titre'] ?? $circuit['nom']) ?></h3>
                        <p class="card-text text-muted small mb-4"><?= htmlspecialchars($circuit['description'] ?? $circuit['desc'] ?? '') ?></p>
                        <div class="mt-auto">
                            <div class="d-flex gap-2 mb-3">
                                <a href="index.php?controller=home&action=circuitDetail&id=<?= intval($circuit['id'] ?? 0) ?>" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-info-circle me-2"></i> Détails
                                </a>
                                <form method="post" action="index.php?controller=cart&action=add" class="flex-fill">
                                    <input type="hidden" name="circuit" value="<?= htmlspecialchars($circuit['titre'] ?? $circuit['nom']) ?>">
                                    <div class="mb-2">
                                        <input type="number" name="nombre_personnes" min="1" max="10" value="1" class="form-control form-control-sm" placeholder="Nombre de personnes">
                                    </div>
                                    <button type="submit" class="btn btn-primary rounded-pill btn-sm w-100">
                                        <i class="fas fa-calendar-check me-2"></i>Réserver
                                    </button>
                                </form>
                            </div>
                            <div class="text-start">
                                <span class="fw-semibold">Prix :</span> <?= number_format($circuit['prix'] ?? ($circuit['prix'] ?? 0), 0, ',', ' ') ?> Ar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-5 d-flex flex-wrap justify-content-center gap-3">
            <a href="index.php?controller=home&action=panier" class="btn btn-reservation btn-lg rounded-pill shadow-lg" style="background: #1D3557; color: #fff; border: none;">
                <i class="fas fa-calendar-check"></i> Voir mes réservations
            </a>
            <a href="index.php?controller=home&action=login" class="btn btn-login btn-lg rounded-pill shadow-lg" style="background: #457B9D; color: #fff; border: none;">
                <i class="fas fa-sign-in-alt"></i> Connexion
            </a>
            <a href="index.php?controller=home&action=inscription" class="btn btn-inscription btn-lg rounded-pill shadow-lg" style="background: #F1C40F; color: #1D3557; border: none;">
                <i class="fas fa-user-plus"></i> Inscription
            </a>
        </div>
    </div>
</section>
<div style="position:fixed;bottom:30px;right:30px;z-index:1050;">
    <a href="index.php?controller=home&action=panier" class="btn btn-reservation btn-lg rounded-pill shadow-lg me-2">
        <i class="fas fa-calendar-check"></i> Mes Réservations
        <span class="badge bg-primary" id="cart-count">
            <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
        </span>
    </a>
    <a href="index.php?controller=home&action=paiement" class="btn btn-success btn-lg rounded-pill shadow-lg">
        <i class="fas fa-credit-card"></i> Payer
    </a>
</div>
<a href="index.php?controller=reservation&action=index" class="btn btn-primary rounded-pill btn-lg shadow-lg">
    <i class="fas fa-calendar-check"></i> Réserver un circuit
</a>
<style>
.btn-panier {
    background: #1D3557 !important;
    color: #fff !important;
    border: none !important;
}
.btn-panier:hover {
    background: #16324F !important;
    color: #F1C40F !important;
}

.btn-login {
    background: #457B9D !important;
    color: #fff !important;
    border: none !important;
}
.btn-login:hover {
    background: #28527A !important;
    color: #F1C40F !important;
}

.btn-inscription {
    background: #F1C40F !important;
    color: #1D3557 !important;
    border: none !important;
}
.btn-inscription:hover {
    background: #FFD700 !important;
    color: #457B9D !important;
}
</style>