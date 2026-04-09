<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-users text-success"></i> Gestion des utilisateurs</h2>
        <a href="index.php?controller=admin&action=addUser" class="btn btn-success mb-3 rounded-pill">
            <i class="fas fa-plus me-1"></i> Ajouter un utilisateur
        </a>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th><i class="fas fa-user"></i> Nom</th>
                    <th><i class="fas fa-envelope"></i> Email</th>
                    <th><i class="fas fa-user-shield"></i> Rôle</th>
                    <th><i class="fas fa-tools"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($u['nom'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($u['email'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge bg-<?= $u['role'] === 'admin' ? 'danger' : 'primary' ?> rounded-pill">
                                <?= htmlspecialchars($u['role'] ?? 'user') ?>
                            </span>
                        </td>
                        <td>
                            <a href="index.php?controller=admin&action=editUser&id=<?= $u['id'] ?>" class="btn btn-info btn-sm rounded-pill me-2"><i class="fas fa-edit"></i> Modifier</a>
                            <a href="index.php?controller=admin&action=deleteUser&id=<?= $u['id'] ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Supprimer cet utilisateur ?');"><i class="fas fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Aucun utilisateur enregistré</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>