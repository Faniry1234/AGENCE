<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="fw-bold mb-0"><i class="fas fa-users-cog text-info"></i> Gestion des équipes</h2>
            <a href="index.php?controller=admin&action=index" class="btn btn-outline-secondary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Retour au tableau de bord
            </a>
        </div>
        <a href="index.php?controller=admin&action=addEquipe" class="btn btn-success mb-3 rounded-pill">
            <i class="fas fa-plus me-1"></i> Ajouter un membre
        </a>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Rôle</th>
                    <th>Bio</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($equipes)): ?>
                    <?php foreach ($equipes as $membre): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($membre['nom'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($membre['role'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars(substr($membre['bio'] ?? '', 0, 80)) ?><?= strlen($membre['bio'] ?? '') > 80 ? '...' : '' ?></td>
                            <td>
                                <?php if (!empty($membre['email'])): ?>
                                    <a href="mailto:<?= htmlspecialchars($membre['email']) ?>" class="text-danger"><i class="fas fa-envelope"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($membre['whatsapp'])): ?>
                                    <a href="<?= htmlspecialchars($membre['whatsapp']) ?>" class="text-success ms-2"><i class="fab fa-whatsapp"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($membre['facebook'])): ?>
                                    <a href="<?= htmlspecialchars($membre['facebook']) ?>" class="text-primary ms-2"><i class="fab fa-facebook"></i></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?controller=admin&action=editEquipe&id=<?= $membre['id'] ?>" class="btn btn-info btn-sm rounded-pill me-2"><i class="fas fa-edit"></i> Modifier</a>
                                <a href="index.php?controller=admin&action=deleteEquipe&id=<?= $membre['id'] ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Supprimer ce membre de l\'équipe ?');"><i class="fas fa-trash"></i> Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun membre enregistré</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
