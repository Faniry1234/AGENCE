<?php ?>
<!-- Hero Section -->
<section class="contact-hero py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <h1 class="display-4 fw-bold mb-4">Contactez-nous</h1>
                <p class="lead mb-0">
                    Nous sommes là pour vous aider à planifier votre voyage de rêve à Madagascar
                </p>
            </div>
            <div class="col-lg-6 text-lg-end animate__animated animate__fadeInRight">
                <img src="public/assets/images/logo-madavoyage.png" alt="Logo Mada Voyage" class="hero-logo">
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Informations de contact -->
            <div class="col-lg-4">
                <div class="contact-info-card card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Nos Coordonnées
                        </h3>
                        
                        <div class="contact-info-item d-flex align-items-center mb-4">
                            <div class="contact-icon-wrapper me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="contact-info-title">Téléphone</h4>
                                <a href="tel:+261341234567" class="contact-info-link">+261 34 12 34 567</a>
                            </div>
                        </div>

                        <div class="contact-info-item d-flex align-items-center mb-4">
                            <div class="contact-icon-wrapper me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="contact-info-title">Email</h4>
                                <a href="mailto:contact@madavoyage.com" class="contact-info-link">contact@madavoyage.com</a>
                            </div>
                        </div>

                        <div class="contact-info-item d-flex align-items-center mb-4">
                            <div class="contact-icon-wrapper me-3">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div>
                                <h4 class="contact-info-title">Facebook</h4>
                                <a href="https://facebook.com/madavoyage" target="_blank" class="contact-info-link">facebook.com/madavoyage</a>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h3 class="card-title mb-4">
                            <i class="fas fa-clock text-primary me-2"></i>
                            Heures d'ouverture
                        </h3>
                        <div class="opening-hours">
                            <p class="mb-2">Lundi - Vendredi : 8h30 - 17h30</p>
                            <p class="mb-2">Samedi : 9h00 - 12h00</p>
                            <p class="mb-0">Dimanche : Fermé</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">
                            <i class="fas fa-paper-plane text-primary me-2"></i>
                            Envoyez-nous un message
                        </h3>

                        <?php if (!empty($contactSuccess)): ?>
                            <div class="alert custom-alert-success mb-4">
                                <div class="alert-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <h4>Message envoyé !</h4>
                                    <p>Nous vous répondrons dans les plus brefs délais.</p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="index.php?controller=home&action=contact" class="contact-form">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Votre nom" required>
                                        <label for="nom">Votre nom</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required>
                                        <label for="email">Votre email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="message" id="message" class="form-control" placeholder="Votre message" style="height: 150px" required></textarea>
                                        <label for="message">Votre message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Envoyer le message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Engagement de service -->
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <div class="service-commitment-card">
                            <div class="commitment-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h5>Support 24/7</h5>
                            <p>Notre équipe est disponible pour vous assister</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-commitment-card">
                            <div class="commitment-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h5>Service Personnalisé</h5>
                            <p>Des solutions adaptées à vos besoins</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-commitment-card">
                            <div class="commitment-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h5>Réponse Rapide</h5>
                            <p>Nous vous répondons sous 24h</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contact-hero {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        position: relative;
        overflow: hidden;
    }

    .hero-logo {
        height: 80px;
        width: auto;
    }

    .contact-section {
        background-color: #f8f9fa;
    }

    .contact-info-card {
        background: white;
        transition: transform 0.3s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-5px);
    }

    .contact-icon-wrapper {
        width: 40px;
        height: 40px;
        background: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d6efd;
    }

    .contact-info-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #6c757d;
    }

    .contact-info-link {
        color: #2c3e50;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .contact-info-link:hover {
        color: #0d6efd;
    }

    .opening-hours {
        color: #6c757d;
    }

    .custom-alert-success {
        display: flex;
        align-items: start;
        padding: 1rem;
        border-radius: 0.5rem;
        background-color: #d1e7dd;
        border: 1px solid #badbcc;
        color: #0f5132;
    }

    .alert-icon {
        margin-right: 1rem;
        font-size: 1.5rem;
    }

    .service-commitment-card {
        text-align: center;
        padding: 1.5rem;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: transform 0.3s ease;
    }

    .service-commitment-card:hover {
        transform: translateY(-5px);
    }

    .commitment-icon {
        width: 50px;
        height: 50px;
        background: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: #0d6efd;
        font-size: 1.5rem;
    }

    .service-commitment-card h5 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .service-commitment-card p {
        color: #6c757d;
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .form-floating > .form-control {
        padding: 1rem 0.75rem;
    }

    .form-floating > .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>