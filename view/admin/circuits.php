<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-route text-primary"></i> Gestion des circuits</h2>
        <a href="index.php?controller=admin&action=addCircuit" class="btn btn-success mb-3 rounded-pill">
            <i class="fas fa-plus me-1"></i> Ajouter un circuit
        </a>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($circuits)): ?>
                    <?php foreach ($circuits as $c): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($c['titre'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars(substr($c['description'] ?? '', 0, 50)) ?>...</td>
                        <td class="text-center">
                            <?php if (isset($c['image']) && !empty($c['image'])): ?>
                                <img src="<?= htmlspecialchars($c['image']) ?>" style="height:40px; border-radius: 4px;" alt="Circuit">
                            <?php else: ?>
                                <span class="text-muted">Pas d'image</span>
                            <?php endif; ?>
                        </td>
                        <td class="fw-bold text-success"><?= htmlspecialchars($c['prix'] ?? 0) ?> Ar</td>
                        <td>
                            <a href="index.php?controller=admin&action=editCircuit&id=<?= $c['id'] ?>" class="btn btn-info btn-sm rounded-pill me-2"><i class="fas fa-edit"></i> Modifier</a>
                            <a href="index.php?controller=admin&action=deleteCircuit&id=<?= $c['id'] ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Supprimer ce circuit ?');"><i class="fas fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun circuit enregistré</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>