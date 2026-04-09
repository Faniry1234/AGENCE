<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-users-cog me-2"></i>
                    <?= isset($equipe) ? 'Modifier le membre' : 'Ajouter un membre' ?>
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($equipe['nom'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Rôle</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?= htmlspecialchars($equipe['role'] ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4"><?= htmlspecialchars($equipe['bio'] ?? '') ?></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($equipe['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp" class="form-label">WhatsApp / contact</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars($equipe['whatsapp'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?= htmlspecialchars($equipe['facebook'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">URL de l'image</label>
                            <input type="text" class="form-control" id="image" name="image" value="<?= htmlspecialchars($equipe['image'] ?? '') ?>" placeholder="public/assets/images/...">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="image_file" class="form-label">Importer une image locale</label>
                        <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                        <?php if (!empty($equipe['image'])): ?>
                            <small class="text-muted">Image actuelle : <?= htmlspecialchars($equipe['image']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="ordre" class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" id="ordre" name="ordre" value="<?= htmlspecialchars($equipe['ordre'] ?? 0) ?>">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-info rounded-pill">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                        <a href="index.php?controller=admin&action=equipes" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-times me-1"></i> Annuler
                        </a>
                        <a href="index.php?controller=admin&action=equipes" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
