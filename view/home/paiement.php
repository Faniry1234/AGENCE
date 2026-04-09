<?php if (!empty($paiementSuccess)): ?>
    <div class="alert custom-alert-success">
        <div class="alert-icon"><i class="fas fa-check-circle fa-2x"></i></div>
        <div class="alert-content">
            <h4>Paiement Réussi !</h4>
            <p>Votre transaction a été enregistrée avec succès. Merci de votre confiance.</p>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($paiementError)): ?>
    <div class="alert custom-alert-danger">
        <div class="alert-icon"><i class="fas fa-exclamation-circle fa-2x"></i></div>
        <div class="alert-content">
            <h4>Erreur de Paiement</h4>
            <p><?= $paiementError ?></p>
        </div>
    </div>
<?php endif; ?>

<section class="payment-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="payment-card">
                    <!-- En-tête -->
                    <div class="payment-header text-center">
                        <div class="payment-logo">
                            <i class="fas fa-shield-alt fa-2x text-primary"></i>
                        </div>
                        <h2 class="payment-title">Paiement Sécurisé</h2>
                        <p class="payment-subtitle">Choisissez votre mode de paiement préféré</p>
                    </div>

                    <!-- Formulaire -->
                    <form method="post" action="index.php?controller=home&action=paiement" class="payment-form">
                        <!-- Sélection de l'opérateur -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-mobile-alt text-primary me-2"></i>
                                Opérateur Mobile Money
                            </h3>
                            <div class="payment-methods">
                                <label class="payment-method-card">
                                    <input type="radio" name="methode" value="Mvola" required>
                                    <span class="payment-method-content">
                                        <div class="operator-logo mvola-bg">
                                            <i class="fas fa-wallet fa-2x"></i>
                                        </div>
                                        <span class="operator-name">MVola</span>
                                    </span>
                                </label>
                                <label class="payment-method-card">
                                    <input type="radio" name="methode" value="Orange Money" required>
                                    <span class="payment-method-content">
                                        <div class="operator-logo orange-bg">
                                            <i class="fas fa-mobile-alt fa-2x"></i>
                                        </div>
                                        <span class="operator-name">Orange Money</span>
                                    </span>
                                </label>
                                <label class="payment-method-card">
                                    <input type="radio" name="methode" value="Airtel Money" required>
                                    <span class="payment-method-content">
                                        <div class="operator-logo airtel-bg">
                                            <i class="fas fa-money-bill-wave fa-2x"></i>
                                        </div>
                                        <span class="operator-name">Airtel Money</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Informations de paiement -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informations de Paiement
                            </h3>
                            <div class="form-floating mb-4">
                                <input type="tel" name="numero" id="numero" class="form-control" placeholder="Numéro" required pattern="[0-9]{10}">
                                <label for="numero">Numéro Mobile Money</label>
                                <div class="form-text">Format : 03X XX XXX XX</div>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="number" name="montant" id="montant" class="form-control" value="<?= htmlspecialchars($montant ?? 0) ?>" readonly>
                                <label for="montant">Montant à Payer (Ar)</label>
                            </div>
                        </div>

                        <!-- Résumé et validation -->
                        <div class="payment-summary">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="summary-label">Total à payer :</span>
                                <span class="summary-amount"><?= number_format($montant ?? 0, 0, ',', ' ') ?> Ar</span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-lock me-2"></i>
                                Valider le paiement
                            </button>
                        </div>
                    </form>

                    <!-- Informations de sécurité -->
                    <div class="payment-footer">
                        <div class="security-info">
                            <i class="fas fa-shield-alt text-success"></i>
                            <span>Paiement 100% sécurisé</span>
                        </div>
                        <div class="security-info">
                            <i class="fas fa-lock text-success"></i>
                            <span>Protection des données</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .payment-section {
        background-color: #f8f9fa;
    }

    .payment-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .payment-header {
        margin-bottom: 2rem;
    }

    .payment-logo {
        width: 64px;
        height: 64px;
        background: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .payment-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .payment-subtitle {
        color: #6c757d;
        font-size: 1rem;
    }

    .form-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 0.5rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #2c3e50;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .payment-method-card {
        cursor: pointer;
        position: relative;
        border: 2px solid #dee2e6;
        border-radius: 0.75rem;
        padding: 1.25rem 1rem;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-method-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .payment-method-card:hover {
        border-color: #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
    }

    .payment-method-card input[type="radio"]:checked+.payment-method-content {
        background: rgba(13, 110, 253, 0.1);
    }

    .payment-method-card input[type="radio"]:checked+.payment-method-content .operator-logo {
        transform: scale(1.05);
    }

    .payment-method-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .operator-logo {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 0.75rem;
        transition: transform 0.3s ease;
        color: white;
    }

    .mvola-bg {
        background: linear-gradient(135deg, #e67e22, #d35400);
        box-shadow: 0 4px 15px rgba(230, 126, 34, 0.2);
    }

    .orange-bg {
        background: linear-gradient(135deg, #ff6b04, #ff4500);
        box-shadow: 0 4px 15px rgba(255, 107, 4, 0.2);
    }

    .airtel-bg {
        background: linear-gradient(135deg, #ff0000, #cc0000);
        box-shadow: 0 4px 15px rgba(255, 0, 0, 0.2);
    }

    .operator-name {
        display: block;
        font-size: 1rem;
        font-weight: 500;
        color: #2c3e50;
        margin-top: 0.5rem;
    }

    .payment-summary {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-top: 2rem;
    }

    .summary-label {
        font-weight: 600;
        color: #2c3e50;
    }

    .summary-amount {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0d6efd;
    }

    .payment-footer {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #dee2e6;
        display: flex;
        justify-content: center;
        gap: 2rem;
    }

    .security-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .custom-alert-success,
    .custom-alert-danger {
        display: flex;
        align-items: start;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
    }

    .custom-alert-success {
        background-color: #d1e7dd;
        border: 1px solid #badbcc;
        color: #0f5132;
    }

    .custom-alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c2c7;
        color: #842029;
    }

    .alert-icon {
        margin-right: 1rem;
    }

    .alert-content h4 {
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .alert-content p {
        margin-bottom: 0;
    }

    .form-floating>.form-control {
        padding: 1rem 0.75rem;
    }

    .form-text {
        color: #6c757d;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>