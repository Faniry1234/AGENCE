<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>
                    <?= isset($user) ? 'Modifier l\'utilisateur' : 'Ajouter un utilisateur' ?>
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" 
                               value="<?= isset($user) ? htmlspecialchars($user['nom']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= isset($user) ? htmlspecialchars($user['email']) : '' ?>" required>
                    </div>
                    <?php if (!isset($user)): ?>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="user" <?= (!isset($user) || $user['role'] === 'user') ? 'selected' : '' ?>>Utilisateur</option>
                            <option value="admin" <?= isset($user) && $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                        <a href="index.php?controller=admin&action=users" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-times me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
