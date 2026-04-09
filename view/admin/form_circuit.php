<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-route me-2"></i>
                    <?= isset($circuit) ? 'Modifier le circuit' : 'Ajouter un circuit' ?>
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" 
                               value="<?= htmlspecialchars($circuit['titre'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($circuit['description'] ?? '') ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prix" class="form-label">Prix (Ar)</label>
                            <input type="number" class="form-control" id="prix" name="prix" 
                                   value="<?= htmlspecialchars($circuit['prix'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duree" class="form-label">Durée</label>
                            <input type="text" class="form-control" id="duree" name="duree" 
                                   placeholder="ex: 3 jours" value="<?= htmlspecialchars($circuit['duree'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="difficulte" class="form-label">Difficulté</label>
                        <select class="form-control" id="difficulte" name="difficulte">
                            <option value="">-- Sélectionner --</option>
                            <option value="Facile" <?= ($circuit['difficulte'] ?? '') === 'Facile' ? 'selected' : '' ?>>Facile</option>
                            <option value="Moyen" <?= ($circuit['difficulte'] ?? '') === 'Moyen' ? 'selected' : '' ?>>Moyen</option>
                            <option value="Difficile" <?= ($circuit['difficulte'] ?? '') === 'Difficile' ? 'selected' : '' ?>>Difficile</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">URL de l'image</label>
                        <input type="text" class="form-control" id="image" name="image" 
                               value="<?= htmlspecialchars($circuit['image'] ?? '') ?>" 
                               placeholder="public/assets/images...">
                    </div>
                    <div class="mb-3">
                        <label for="image_file" class="form-label">Importer une image locale</label>
                        <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                        <?php if (!empty($circuit['image'])): ?>
                            <small class="text-muted">Image actuelle : <?= htmlspecialchars($circuit['image']) ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                        <a href="index.php?controller=admin&action=circuits" class="btn btn-secondary rounded-pill">
                            <i class="fas fa-times me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
