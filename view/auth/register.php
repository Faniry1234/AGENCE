<?php ?>
<section class="py-5 bg-light-custom">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        <h2 class="card-title text-center mb-4 fw-bold">Inscription</h2>
                        <?php if (!empty($registerSuccess)): ?>
                            <div class="alert alert-success text-center">Inscription réussie ! <a href="index.php?controller=auth&action=index">Connectez-vous</a></div>
                        <?php endif; ?>
                        <?php if (!empty($registerError)): ?>
                            <div class="alert alert-danger text-center"><?= $registerError ?></div>
                        <?php endif; ?>
                        <form method="post" action="index.php?controller=auth&action=register">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" name="password2" id="password2" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-info rounded-pill w-100">Créer un compte</button>
                        </form>
                        <div class="text-center mt-3">
                            <small>Déjà inscrit ? <a href="index.php?controller=auth&action=index">Connexion</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>