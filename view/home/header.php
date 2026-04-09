<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user = $_SESSION['user'] ?? null;
$admin = $_SESSION['admin'] ?? null;
?>
<header class="navbar navbar-expand-lg fixed-top" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: 0 2px 20px rgba(0,0,0,0.1);">
    <div class="container d-flex align-items-center">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <img src="public/assets/images/logo-madavoyage.png" alt="Mada Voyage" style="height:48px;width:auto;margin-right:12px;" class="logo-hover">
            <span class="brand-text" style="font-size: 1.5rem; font-weight: 700; background: linear-gradient(45deg, #1a237e, #0277bd); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Mada Voyage</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            style="border: none; padding: 0.5rem;">
            <i class="fas fa-bars" style="color: #1a237e; font-size: 1.5rem;"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill" href="index.php?controller=home&action=index">
                        <i class="fas fa-home me-1"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill" href="index.php?controller=home&action=service">
                        <i class="fas fa-concierge-bell me-1"></i> Service
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill" href="index.php?controller=home&action=equipes">
                        <i class="fas fa-users me-1"></i> Équipe
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill" href="index.php?controller=home&action=circuit">
                        <i class="fas fa-route me-1"></i> Circuits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-pill" href="index.php?controller=home&action=contact">
                        <i class="fas fa-envelope me-1"></i> Contact
                    </a>
                </li>
                <?php if ($admin): ?>
                <li class="nav-item">
                    <a href="index.php?controller=admin&action=index" class="nav-link px-3 py-2 rounded-pill admin-link">
                        <i class="fas fa-user-shield me-1"></i> Administration
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item ms-2">
                    <a href="index.php?controller=home&action=panier" class="btn btn-primary rounded-pill px-3 py-2">
                        <i class="fas fa-calendar-check me-1"></i> Mes Réservations
                    </a>
                </li>
                <?php if ($user): ?>
                    <li class="nav-item dropdown ms-2">
                        <a class="btn btn-info rounded-pill px-3 py-2 dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i> <?= htmlspecialchars($user) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 15px;">
                            <li><a class="dropdown-item py-2" href="index.php?controller=auth&action=profil">
                                    <i class="fas fa-user-circle me-2 text-primary"></i> Mon Profil
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item py-2 text-danger" href="index.php?controller=auth&action=logout">
                                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-2">
                        <a href="index.php?controller=auth&action=index" class="btn btn-outline-primary rounded-pill px-3 py-2">
                            <i class="fas fa-sign-in-alt me-1"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="index.php?controller=auth&action=register" class="btn btn-warning rounded-pill px-3 py-2">
                            <i class="fas fa-user-plus me-1"></i> Inscription
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<style>
    .navbar {
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 3px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .navbar-brand {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .logo-hover {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover .logo-hover {
        transform: rotate(5deg);
    }

    .brand-text {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #1a237e, #0277bd);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all 0.3s ease;
    }

    .nav-link {
        color: #1a237e !important;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: #0277bd !important;
        background: rgba(2, 119, 189, 0.1);
        transform: translateY(-2px);
    }

    .admin-link {
        color: #d32f2f !important;
        font-weight: 600;
    }

    .admin-link:hover {
        color: #b71c1c !important;
        background: rgba(211, 47, 47, 0.1);
    }

    .dropdown-menu {
        margin-top: 10px;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        border-radius: 10px;
        margin: 2px 5px;
        padding: 8px 20px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: rgba(2, 119, 189, 0.1);
        transform: translateX(5px);
    }

    .btn {
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: linear-gradient(45deg, #1a237e, #0277bd);
        border: none;
    }

    .btn-warning {
        background: linear-gradient(45deg, #ff9800, #f57c00);
        border: none;
        color: white;
    }

    .btn-info {
        background: linear-gradient(45deg, #0277bd, #00bcd4);
        border: none;
        color: white;
    }

    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            padding: 1rem;
            border-radius: 15px;
            margin-top: 1rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            margin: 5px 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });
    });
</script>
<li class="nav-item">
    <a href="index.php?controller=home&action=panier" class="btn btn-reservation btn-sm rounded-pill ms-2">
        <i class="fas fa-calendar-check"></i> Mes Réservations
    </a>
</li>
<?php if ($user): ?>
    <li class="nav-item dropdown">
        <a class="btn btn-login btn-sm rounded-pill ms-2 dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profilDropdown">
            <li><a class="dropdown-item" href="index.php?controller=auth&action=profil"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
            <li><a class="dropdown-item" href="index.php?controller=auth&action=logout"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a></li>
        </ul>
    </li>
<?php else: ?>
    <li class="nav-item">
        <a href="index.php?controller=auth&action=index" class="btn btn-login btn-sm rounded-pill ms-2">
            Connexion
        </a>
    </li>
    <li class="nav-item">
        <a href="index.php?controller=auth&action=register" class="btn btn-inscription btn-sm rounded-pill ms-2">
            Inscription
        </a>
    </li>
<?php endif; ?>
</ul>
</div>
</div>
<?php if ($admin): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1000;">
        <div class="d-flex align-items-center bg-info text-white px-3 py-2 rounded-pill shadow-sm">
            <i class="fas fa-user-shield me-2"></i>
            <span class="me-2">Admin connecté</span>
            <a href="index.php?controller=admin&action=logout" class="btn btn-danger btn-sm rounded-pill ms-2">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
<?php endif; ?>
</header>
<style>
    .btn-panier {
        background: #4F8FC0 !important;
        color: #fff !important;
        border: none !important;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(79, 143, 192, 0.12);
        transition: transform 0.2s, box-shadow 0.2s, background 0.2s, color 0.2s;
    }

    .btn-panier:hover {
        background: #6BB9F0 !important;
        color: #232946 !important;
        transform: scale(1.08) rotate(-2deg);
        box-shadow: 0 4px 16px rgba(79, 143, 192, 0.18);
    }

    .btn-login {
        background: #A3CEF1 !important;
        color: #232946 !important;
        border: none !important;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(163, 206, 241, 0.12);
        transition: transform 0.2s, box-shadow 0.2s, background 0.2s, color 0.2s;
    }

    .btn-login:hover {
        background: #BEE9E8 !important;
        color: #1D3557 !important;
        transform: scale(1.08) rotate(2deg);
        box-shadow: 0 4px 16px rgba(163, 206, 241, 0.18);
    }

    .btn-inscription {
        background: #F9DC5C !important;
        color: #232946 !important;
        border: none !important;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(249, 220, 92, 0.12);
        transition: transform 0.2s, box-shadow 0.2s, background 0.2s, color 0.2s;
    }

    .btn-inscription:hover {
        background: #FFE066 !important;
        color: #457B9D !important;
        transform: scale(1.08) rotate(-2deg);
        box-shadow: 0 4px 16px rgba(249, 220, 92, 0.18);
    }

    /* Pour les autres boutons Bootstrap */
    .btn-primary,
    .btn-success,
    .btn-info,
    .btn-secondary,
    .btn-danger {
        background: #A3CEF1 !important;
        color: #232946 !important;
        border: none !important;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(163, 206, 241, 0.12);
        transition: transform 0.2s, box-shadow 0.2s, background 0.2s, color 0.2s;
    }

    .btn-primary:hover,
    .btn-success:hover,
    .btn-info:hover,
    .btn-secondary:hover,
    .btn-danger:hover {
        background: #BEE9E8 !important;
        color: #1D3557 !important;
        transform: scale(1.08) rotate(2deg);
        box-shadow: 0 4px 16px rgba(163, 206, 241, 0.18);
    }
</style>