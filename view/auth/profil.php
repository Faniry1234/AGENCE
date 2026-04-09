<?php ?>
<!-- filepath: e:\structure mvc by mr Avotra\view\auth\profil.php -->
<section class="py-5 bg-light-custom">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4 p-md-5 shadow-lg border-0 rounded-4">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-user-circle fa-5x text-primary-custom"></i>
                        </div>
                        <h2 class="display-6 fw-bold text-dark mb-2">Mon Profil</h2>
                        <span class="badge bg-info text-dark fs-6 px-3 py-2 mb-3">Connecté</span>
                    </div>
                    <div class="mb-4">
                        <div class="row mb-2">
                            <div class="col-4 text-end fw-bold">Nom :</div>
                            <div class="col-8"><?= isset($user) && $user ? htmlspecialchars($user) : '<span class="text-danger">Utilisateur inconnu</span>' ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 text-end fw-bold">Email :</div>
                            <div class="col-8"><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="index.php?controller=auth&action=logout" class="btn btn-danger rounded-pill px-4 py-2 fs-5">
                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Historique des connexions -->
<div class="mb-4">
    <h5 class="fw-bold mb-3"><i class="fas fa-history me-2"></i>Historique des connexions</h5>
    <?php if (!empty($loginHistory)): ?>
        <ul class="list-group">
            <?php foreach ($loginHistory as $history): ?>
                <li class="list-group-item">
                    <i class="fas fa-sign-in-alt text-success me-2"></i>
                    <?= date('d/m/Y H:i', strtotime($history['login_time'])) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="text-muted">Aucune connexion enregistrée.</div>
    <?php endif; ?>
</div>

<!-- Historique des actions -->
<div class="mb-4">
    <h5 class="fw-bold mb-3"><i class="fas fa-list me-2"></i>Historique des actions</h5>
    <?php if (!empty($userActions)): ?>
        <ul class="list-group">
            <?php foreach ($userActions as $action): ?>
                <li class="list-group-item">
                    <span class="fw-bold"><?= htmlspecialchars($action['action']) ?></span>
                    <?php if ($action['details']): ?>
                        <span class="text-muted">: <?= htmlspecialchars($action['details']) ?></span>
                    <?php endif; ?>
                    <span class="float-end text-secondary"><?= date('d/m/Y H:i', strtotime($action['action_time'])) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="text-muted">Aucune action enregistrée.</div>
    <?php endif; ?>
</div>