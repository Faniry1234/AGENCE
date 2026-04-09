<?php ?>
<!-- Hero Section -->
<section class="bg-primary text-white py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <h1 class="display-4 fw-bold mb-4">Notre Équipe</h1>
                <p class="lead mb-4">
                    <i class="fas fa-quote-left text-warning me-2"></i>
                    Passionnés par Madagascar, nous sommes là pour vous faire vivre des expériences uniques
                    <i class="fas fa-quote-right text-warning ms-2"></i>
                </p>
                <hr class="my-4 bg-white">
                <div class="d-flex gap-3">
                    <div class="text-center">
                        <i class="fas fa-users fa-2x text-warning mb-2"></i>
                        <h5 class="fw-bold">Experts Locaux</h5>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-heart fa-2x text-warning mb-2"></i>
                        <h5 class="fw-bold">Passionnés</h5>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-award fa-2x text-warning mb-2"></i>
                        <h5 class="fw-bold">Certifiés</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <img src="public/assets/images/FB_IMG_17444397658922702.jpg" class="img-fluid rounded-3 shadow-lg" alt="Notre Équipe">
            </div>
        </div>
    </div>
</section>

<!-- Notre Mission -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-bullseye fa-2x text-primary me-3"></i>
                            <h3 class="card-title mb-0">Notre Mission</h3>
                        </div>
                        <p class="card-text lead">
                            Chez Mada Voyage, nous nous engageons à créer des expériences de voyage authentiques et mémorables, tout en promouvant un tourisme responsable qui bénéficie aux communautés locales.
                        </p>
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Service personnalisé</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Expertise locale</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Tourisme responsable</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-handshake fa-2x text-primary me-3"></i>
                            <h3 class="card-title mb-0">Nos Valeurs</h3>
                        </div>
                        <p class="card-text lead">
                            Nous croyons en un tourisme qui respecte l'environnement et valorise la culture malgache. Notre équipe s'engage à vous offrir une expérience authentique et enrichissante.
                        </p>
                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded text-center">
                                    <i class="fas fa-leaf text-success mb-2"></i>
                                    <h6 class="mb-0">Écotourisme</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded text-center">
                                    <i class="fas fa-hands-helping text-primary mb-2"></i>
                                    <h6 class="mb-0">Solidarité</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded text-center">
                                    <i class="fas fa-heart text-danger mb-2"></i>
                                    <h6 class="mb-0">Passion</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded text-center">
                                    <i class="fas fa-star text-warning mb-2"></i>
                                    <h6 class="mb-0">Excellence</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Équipe -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">
            <i class="fas fa-users text-primary me-2"></i>
            Notre Équipe de Passionnés
        </h2>
        <div class="row g-4">
            <?php if (!empty($equipes)): ?>
                <?php foreach ($equipes as $membre): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm team-card">
                            <?php if (!empty($membre['image'])): ?>
                                <img src="<?= htmlspecialchars($membre['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($membre['nom']) ?>">
                            <?php else: ?>
                                <img src="public/assets/images/FB_IMG_17444397506608915.jpg" class="card-img-top" alt="Membre de l'équipe">
                            <?php endif; ?>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($membre['nom']) ?></h5>
                                <p class="text-muted"><?= htmlspecialchars($membre['role']) ?></p>
                                <p class="card-text"><?= nl2br(htmlspecialchars($membre['bio'] ?? '')) ?></p>
                                <div class="social-icons">
                                    <?php if (!empty($membre['whatsapp'])): ?>
                                        <a href="<?= htmlspecialchars($membre['whatsapp']) ?>" target="_blank" title="WhatsApp" class="text-success mx-2"><i class="fab fa-whatsapp"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty($membre['email'])): ?>
                                        <a href="mailto:<?= htmlspecialchars($membre['email']) ?>" title="Email" class="text-danger mx-2"><i class="fas fa-envelope"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty($membre['facebook'])): ?>
                                        <a href="<?= htmlspecialchars($membre['facebook']) ?>" target="_blank" title="Facebook" class="text-primary mx-2"><i class="fab fa-facebook"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Notre équipe de passionnés est en cours de création. Revenez bientôt pour découvrir nos membres.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .team-card {
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .team-card:hover {
        transform: translateY(-10px);
    }

    .team-card img {
        height: 300px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team-card:hover img {
        transform: scale(1.05);
    }

    .social-icons a {
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        transform: translateY(-3px);
    }

    /* Animation pour les icônes de la section hero */
    .animate__animated {
        animation-duration: 1s;
    }

    /* Style pour les badges de valeurs */
    .bg-light {
        background-color: #f8f9fa !important;
    }

    .rounded {
        border-radius: 1rem !important;
    }

    /* Effet de survol pour les cartes de valeurs */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
</style>