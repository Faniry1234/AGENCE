<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <h2 class="fw-bold mb-4">
            <i class="fas fa-credit-card text-success"></i> Gestion des paiements
        </h2>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Utilisateur</th>
                    <th>Montant</th>
                    <th>Méthode</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($paiements)): ?>
                    <?php foreach ($paiements as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['user_email'] ?? 'N/A') ?></td>
                        <td class="fw-bold text-success"><?= htmlspecialchars($p['montant'] ?? 0) ?> Ar</td>
                        <td><?= htmlspecialchars($p['methode'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($p['date_paiement'] ?? 'N/A') ?></td>
                        <td>
                            <a href="index.php?controller=admin&action=deletePayment&id=<?= $p['id'] ?>" 
                               class="btn btn-danger btn-sm rounded-pill" 
                               onclick="return confirm('Supprimer ce paiement ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun paiement enregistré</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>