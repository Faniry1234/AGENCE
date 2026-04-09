<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-envelope text-info"></i> Boîte de réception des messages clients</h2>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['nom'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($m['email'] ?? 'N/A') ?></td>
                        <td><?= nl2br(htmlspecialchars($m['message'] ?? 'N/A')) ?></td>
                        <td><?= htmlspecialchars($m['date_envoi'] ?? 'N/A') ?></td>
                        <td>
                            <a href="index.php?controller=admin&action=deleteMessage&id=<?= $m['id'] ?>" 
                               class="btn btn-danger btn-sm rounded-pill" 
                               onclick="return confirm('Supprimer ce message ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun message reçu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>