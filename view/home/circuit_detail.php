<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <img src="<?= htmlspecialchars($circuit['image'] ?? 'public/assets/images/tsingy.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($circuit['titre'] ?? '') ?>">
                    <div class="card-body">
                        <h1 class="h3 fw-bold mb-3"><?= htmlspecialchars($circuit['titre'] ?? '') ?></h1>
                        <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($circuit['description'] ?? '')) ?></p>
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-white rounded shadow-sm text-center">
                                    <h6 class="mb-1">Durée</h6>
                                    <p class="mb-0 fw-semibold"><?= htmlspecialchars($circuit['duree'] ?? 'N/A') ?></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-white rounded shadow-sm text-center">
                                    <h6 class="mb-1">Difficulté</h6>
                                    <p class="mb-0 fw-semibold"><?= htmlspecialchars($circuit['difficulte'] ?? 'N/A') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded shadow-sm">
                                <div>
                                    <p class="mb-1 text-muted">Prix par personne</p>
                                    <h4 class="mb-0 fw-bold text-dark"><?= number_format($circuit['prix'] ?? 0, 0, ',', ' ') ?> Ar</h4>
                                </div>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="index.php?controller=home&action=circuit" class="btn btn-outline-primary rounded-pill">
                                    <i class="fas fa-arrow-left me-2"></i> Retour aux circuits
                                </a>
                                <form method="post" action="index.php?controller=cart&action=add" class="flex-grow-1">
                                    <input type="hidden" name="circuit" value="<?= htmlspecialchars($circuit['titre'] ?? '') ?>">
                                    <div class="mb-3">
                                        <label for="nombre_personnes" class="form-label">Nombre de personnes</label>
                                        <input type="number" id="nombre_personnes" name="nombre_personnes" min="1" max="10" value="1" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary rounded-pill w-100">
                                        <i class="fas fa-calendar-check me-2"></i> Réserver ce circuit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100">
                    <h2 class="h5 mb-3">Ce que vous allez vivre</h2>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">Découverte de paysages uniques</li>
                        <li class="list-group-item">Rencontres avec la faune locale</li>
                        <li class="list-group-item">Expériences culturelles authentiques</li>
                        <li class="list-group-item">Hébergements sélectionnés</li>
                    </ul>
                    <div class="mt-auto">
                        <h3 class="h6 text-muted">Plus d'infos :</h3>
                        <p class="mb-1"><strong>Durée :</strong> <?= htmlspecialchars($circuit['duree'] ?? 'N/A') ?></p>
                        <p class="mb-1"><strong>Difficulté :</strong> <?= htmlspecialchars($circuit['difficulte'] ?? 'N/A') ?></p>
                        <p class="mb-0"><strong>Prix :</strong> <?= number_format($circuit['prix'] ?? 0, 0, ',', ' ') ?> Ar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
