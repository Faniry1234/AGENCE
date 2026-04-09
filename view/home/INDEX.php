<?php ?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center">
        <div class="hero-icon animate__animated animate__fadeInDown mb-3">
            <i class="fas fa-globe-africa fa-3x text-warning"></i>
        </div>
        <h1 class="mb-4 animate__animated animate__fadeInDown">
            <i class="fas fa-map-marked-alt me-2"></i>Bienvenue à Madagascar
        </h1>
        <p class="lead mb-5 animate__animated animate__fadeInUp">
            <i class="fas fa-star text-warning me-2"></i>Découvrez la Grande Île comme vous ne l'avez jamais vue :<br>
            <span class="mt-2 d-block">
                <i class="fas fa-route text-info me-2"></i>circuits authentiques
                <i class="fas fa-mountain text-success mx-2"></i>aventures inoubliables
                <i class="fas fa-umbrella-beach text-warning mx-2"></i>détente paradisiaque
                <i class="fas fa-hands-helping text-danger mx-2"></i>immersion culturelle
            </span>
        </p>
        <div class="d-flex justify-content-center gap-3 animate__animated animate__fadeInUp">
            <a href="index.php?controller=home&action=circuit" class="btn btn-primary btn-lg">
                <i class="fas fa-compass me-2"></i>Explorer nos circuits
            </a>
            <a href="index.php?controller=home&action=contact" class="btn btn-outline-light btn-lg">
                <i class="fas fa-envelope me-2"></i>Nous contacter
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">
            <i class="fas fa-gem text-primary me-2"></i>
            Nos Services Premium
            <div class="mt-2">
                <small class="text-muted"><i class="fas fa-stars"></i></small>
            </div>
        </h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="public/assets/images/nord.jpg" class="card-img-top" alt="Circuits Sur Mesure">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-route"></i> Sur Mesure
                            </span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-route fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Circuits Sur Mesure</h5>
                        <p class="card-text">Des itinéraires personnalisés selon vos envies et votre rythme.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="public/assets/images/paradis.jpg" class="card-img-top" alt="Hébergements Sélectionnés">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-success rounded-pill">
                                <i class="fas fa-hotel"></i> Confort
                            </span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-hotel fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Hébergements Sélectionnés</h5>
                        <p class="card-text">Les meilleurs logements pour un confort optimal pendant votre séjour.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="public/assets/images/sambo.jpg" class="card-img-top" alt="Guides Experts">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-info rounded-pill">
                                <i class="fas fa-users"></i> Expertise
                            </span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Guides Experts</h5>
                        <p class="card-text">Des guides locaux passionnés pour vous faire découvrir les trésors de Madagascar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Destinations -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">
            <i class="fas fa-map-marked-alt text-primary me-2"></i>
            Destinations Populaires
            <div class="mt-2">
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
            </div>
        </h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="public/assets/images/baobab.jpg" class="card-img-top" alt="Allée des Baobabs">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-tree"></i> Incontournable
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-tree text-success me-2"></i>
                            Allée des Baobabs
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Une avenue bordée de baobabs géants, spectacle unique au monde.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="public/assets/images/lemurien.jpg" class="card-img-top" alt="Parc National">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-success rounded-pill">
                                <i class="fas fa-leaf"></i> Écotourisme
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-paw text-success me-2"></i>
                            Parcs Nationaux
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Découvrez la faune unique de Madagascar dans son habitat naturel.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="public/assets/images/nosy.jpg" class="card-img-top" alt="Plages">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-info rounded-pill">
                                <i class="fas fa-water"></i> Balnéaire
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-umbrella-beach text-warning me-2"></i>
                            Plages Paradisiaques
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Des plages de sable blanc bordées d'eaux turquoises.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <div class="mb-4">
            <i class="fas fa-compass fa-3x text-warning animate__animated animate__pulse animate__infinite"></i>
        </div>
        <h2 class="mb-4">
            <i class="fas fa-plane-departure me-2"></i>
            Prêt pour l'aventure ?
        </h2>
        <p class="lead mb-4">
            <i class="fas fa-gift text-warning me-2"></i>
            Réservez maintenant et bénéficiez de nos offres spéciales
        </p>
        <div class="d-flex justify-content-center">
            <a href="index.php?controller=home&action=contact" class="btn btn-lg btn-outline-light">
                <i class="fas fa-headset me-2"></i>
                Besoin d'aide ?
            </a>
        </div>
    </div>
</section>

<style>
    .hero-icon {
        display: inline-block;
        padding: 20px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        margin-bottom: 1rem;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
        backdrop-filter: blur(10px);
    }

    .card {
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .card-img-top {
        transition: transform 0.5s ease;
    }

    /* Animation pour les étoiles */
    @keyframes star-pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    .text-warning.fas.fa-star {
        display: inline-block;
        animation: star-pulse 2s infinite;
        animation-delay: calc(var(--star-index) * 0.3s);
    }

    /* Animation pour l'icône de la boussole */
    @keyframes compass-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .fa-compass {
        display: inline-block;
        animation: compass-spin 10s linear infinite;
    }
</style>