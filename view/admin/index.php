<?php ?>
<!-- Admin Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary">
    <div class="container-fluid px-4">
        <span class="navbar-brand d-flex align-items-center">
            <i class="fas fa-shield-alt me-2"></i>
            Administration
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-globe me-1"></i> Voir le site
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        <i class="fas fa-user-circle me-1"></i> <?= htmlspecialchars($_SESSION['admin']) ?>
                    </span>
                </li>
                <li class="nav-item ms-2">
                    <a href="index.php?controller=admin&action=logout" class="btn btn-light btn-sm rounded-pill px-3">
                        <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="admin-dashboard bg-light min-vh-100">
    <div class="container-fluid px-4 py-4">
        <!-- Welcome Banner -->
        <div class="welcome-banner p-4 mb-4 bg-white rounded-3 shadow-sm">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-6 fw-bold mb-2">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>
                        Tableau de bord
                    </h1>
                    <p class="text-muted mb-0">
                        Bienvenue dans votre espace d'administration. Gérez facilement votre site depuis cette interface.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <div class="current-date text-muted">
                        <i class="far fa-calendar-alt me-1"></i>
                        <?= date('d/m/Y H:i') ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-primary-soft rounded-3 p-3">
                                <i class="fas fa-route fa-2x text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1 text-muted">Circuits</h6>
                                <h3 class="mb-0 fw-bold">12</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-success-soft rounded-3 p-3">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1 text-muted">Utilisateurs</h6>
                                <h3 class="mb-0 fw-bold">48</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-warning-soft rounded-3 p-3">
                                <i class="fas fa-calendar-check fa-2x text-warning"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1 text-muted">Réservations</h6>
                                <h3 class="mb-0 fw-bold">24</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-info-soft rounded-3 p-3">
                                <i class="fas fa-comments fa-2x text-info"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1 text-muted">Messages</h6>
                                <h3 class="mb-0 fw-bold">8</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Actions -->
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Quick Actions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-bolt me-2 text-warning"></i>
                            Actions rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <a href="index.php?controller=admin&action=circuits" class="action-card text-decoration-none">
                                    <div class="card action-item border-0 bg-primary-soft h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="action-icon mb-3">
                                                <i class="fas fa-route fa-2x text-primary"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Circuits</h5>
                                            <p class="text-muted small mb-0">Gérer les circuits touristiques</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?controller=admin&action=users" class="action-card text-decoration-none">
                                    <div class="card action-item border-0 bg-success-soft h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="action-icon mb-3">
                                                <i class="fas fa-users fa-2x text-success"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Utilisateurs</h5>
                                            <p class="text-muted small mb-0">Gérer les comptes</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?controller=admin&action=equipes" class="action-card text-decoration-none">
                                    <div class="card action-item border-0 bg-info-soft h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="action-icon mb-3">
                                                <i class="fas fa-users-cog fa-2x text-info"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Équipes</h5>
                                            <p class="text-muted small mb-0">Gérer les membres passionnés</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?controller=admin&action=reservations" class="action-card text-decoration-none">
                                    <div class="card action-item border-0 bg-warning-soft h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="action-icon mb-3">
                                                <i class="fas fa-calendar-check fa-2x text-warning"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Réservations</h5>
                                            <p class="text-muted small mb-0">Gérer les réservations</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?controller=admin&action=paiements" class="action-card text-decoration-none">
                                    <div class="card action-item border-0 bg-info-soft h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="action-icon mb-3">
                                                <i class="fas fa-credit-card fa-2x text-info"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Paiements</h5>
                                            <p class="text-muted small mb-0">Gérer les paiements</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="index.php?controller=admin&action=messages" class="action-card text-decoration-none">
                                    <div class="card action-item border-0 bg-danger-soft h-100">
                                        <div class="card-body text-center p-4">
                                            <div class="action-icon mb-3">
                                                <i class="fas fa-envelope fa-2x text-danger"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Messages</h5>
                                            <p class="text-muted small mb-0">Consulter les messages</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Recent Activities -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-history me-2 text-info"></i>
                            Activités récentes
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-success-soft rounded-circle p-2">
                                        <i class="fas fa-user-plus text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-semi-bold">Nouveau membre inscrit</p>
                                        <small class="text-muted">Il y a 2 heures</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-primary-soft rounded-circle p-2">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-semi-bold">Nouvelle réservation</p>
                                        <small class="text-muted">Il y a 3 heures</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="activity-icon bg-warning-soft rounded-circle p-2">
                                        <i class="fas fa-comment text-warning"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-semi-bold">Nouveau message reçu</p>
                                        <small class="text-muted">Il y a 5 heures</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables */
:root {
    --primary-color: #1a237e;
    --primary-light: #534bae;
    --primary-dark: #000051;
    --success-color: #2e7d32;
    --warning-color: #f57c00;
    --info-color: #0288d1;
    --danger-color: #d32f2f;
}

/* Background Gradients */
.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
}

/* Soft Backgrounds */
.bg-primary-soft { background-color: rgba(26, 35, 126, 0.1); }
.bg-success-soft { background-color: rgba(46, 125, 50, 0.1); }
.bg-warning-soft { background-color: rgba(245, 124, 0, 0.1); }
.bg-info-soft { background-color: rgba(2, 136, 209, 0.1); }
.bg-danger-soft { background-color: rgba(211, 47, 47, 0.1); }

/* Dashboard Styles */
.admin-dashboard {
    padding-top: 1rem;
}

.welcome-banner {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-left: 5px solid var(--primary-color);
}

/* Stat Cards */
.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
}

.stat-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Action Items */
.action-item {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 1rem;
}

.action-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.action-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Activity List */
.activity-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Card Headers */
.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .welcome-banner {
        text-align: center;
    }
    
    .stat-card {
        margin-bottom: 1rem;
    }
}
</style>
</style>