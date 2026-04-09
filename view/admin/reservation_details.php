<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-check me-2"></i>
                    Détails de la réservation #<?= htmlspecialchars($reservation['id']) ?>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Informations du client</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="fw-bold">Nom:</td>
                                <td><?= htmlspecialchars($reservation['user_nom'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email:</td>
                                <td><?= htmlspecialchars($reservation['user_email'] ?? 'N/A') ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Informations de la réservation</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="fw-bold">Circuit:</td>
                                <td><?= htmlspecialchars($reservation['circuit_titre'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nombre de personnes:</td>
                                <td><?= htmlspecialchars($reservation['nombre_personnes']) ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Montant total:</td>
                                <td class="text-success fw-bold"><?= number_format($reservation['montant_total'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Statut:</td>
                                <td>
                                    <?php
                                    $statusClass = [
                                        'en_attente' => 'warning',
                                        'confirmé' => 'success',
                                        'annulé' => 'danger'
                                    ];
                                    $status = strtolower($reservation['statut']);
                                    $class = $statusClass[$status] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?= $class ?> rounded-pill text-capitalize">
                                        <?= htmlspecialchars($reservation['statut']) ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Date de création:</td>
                                <td><?= date('d/m/Y H:i', strtotime($reservation['created_at'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="d-flex gap-2">
                    <?php if ($reservation['statut'] !== 'confirmé'): ?>
                    <a href="index.php?controller=admin&action=confirmReservation&id=<?= $reservation['id'] ?>" class="btn btn-success rounded-pill">
                        <i class="fas fa-check me-1"></i> Confirmer
                    </a>
                    <?php endif; ?>
                    <a href="index.php?controller=admin&action=deleteReservation&key=<?= $reservation['id'] ?>" 
                       class="btn btn-danger rounded-pill" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                        <i class="fas fa-trash me-1"></i> Supprimer
                    </a>
                    <a href="index.php?controller=admin&action=reservations" class="btn btn-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
