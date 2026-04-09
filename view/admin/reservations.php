<?php ?>
<div class="container-fluid px-4 py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0 fw-bold">
                <i class="fas fa-calendar-check me-2 text-primary"></i>
                Gestion des Réservations
            </h5>
            <div class="actions">
                <button type="button" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-download me-1"></i> Exporter
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Client</th>
                            <th scope="col">Circuit</th>
                            <th scope="col">Nombre de personnes</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reservations)): ?>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold">#<?= $reservation['id'] ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-icon bg-light rounded-circle p-2 me-2">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <?= htmlspecialchars($reservation['user_email']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-truncate">
                                            <?= htmlspecialchars($reservation['circuit_titre']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill">
                                            <?= $reservation['nombre_personnes'] ?> pers.
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">
                                            <?= number_format($reservation['montant_total'], 0, ',', ' ') ?> Ar
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClass = [
                                            'en_attente' => 'warning',
                                            'confirmé' => 'success',
                                            'annulé' => 'danger'
                                        ];
                                        $status = strtolower($reservation['statut']);
                                        $class = $statusClass[$status] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $class ?> rounded-pill text-capitalize">
                                            <?= htmlspecialchars($reservation['statut']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('d/m/Y H:i', strtotime($reservation['created_at'])) ?>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="index.php?controller=admin&action=viewReservationDetails&id=<?= $reservation['id'] ?>" 
                                               class="btn btn-sm btn-outline-primary rounded-pill me-2" 
                                               data-bs-toggle="tooltip" title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?controller=admin&action=confirmReservation&id=<?= $reservation['id'] ?>" 
                                               class="btn btn-sm btn-outline-success rounded-pill me-2" 
                                               data-bs-toggle="tooltip" title="Confirmer">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="index.php?controller=admin&action=deleteReservation&key=<?= $reservation['id'] ?>" 
                                               class="btn btn-sm btn-outline-danger rounded-pill"
                                               data-bs-toggle="tooltip" title="Supprimer"
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                        <h6 class="fw-bold">Aucune réservation trouvée</h6>
                                        <p class="text-muted mb-0">Les réservations apparaîtront ici une fois créées.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables */
:root {
    --primary-color: #2563eb;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --secondary-color: #6b7280;
    --text-primary: #1f2937;
    --text-secondary: #4b5563;
    --bg-light: #f9fafb;
    --border-color: #e5e7eb;
}

/* Styles généraux */
.card {
    background: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.card-header {
    border-bottom: 1px solid var(--border-color);
}

/* En-tête et titre */
.card-title {
    color: var(--text-primary);
    font-size: 1.25rem;
}

.card-title i {
    color: var(--primary-color);
}

/* Tableau */
.table {
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    color: var(--text-secondary);
    padding: 1rem;
    border-bottom-width: 2px;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: var(--bg-light);
}

/* Icônes et badges */
.user-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-light);
    border-radius: 50%;
}

.user-icon i {
    font-size: 1.2rem;
    color: var(--primary-color);
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
    font-size: 0.75rem;
    text-transform: capitalize;
    letter-spacing: 0.025em;
    border-radius: 9999px;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.badge.bg-success {
    background-color: var(--success-color) !important;
}

.badge.bg-warning {
    background-color: var(--warning-color) !important;
}

.badge.bg-danger {
    background-color: var(--danger-color) !important;
}

/* Boutons */
.btn-group .btn {
    padding: 0.5rem;
    border-radius: 50%;
    margin: 0 0.25rem;
    transition: all 0.2s ease;
}

.btn-group .btn i {
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
}

/* État vide */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-state i {
    color: var(--secondary-color);
    opacity: 0.5;
    margin-bottom: 1.5rem;
}

.empty-state h6 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

/* Animations */
.badge {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.badge:hover {
    transform: scale(1.1);
}

/* Tooltips */
.tooltip {
    --bs-tooltip-bg: var(--text-primary);
    --bs-tooltip-color: #ffffff;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Bouton d'export */
.btn-primary {
    background-color: var(--primary-color);
    border: none;
    padding: 0.5rem 1.25rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background-color: #1d4ed8;
    transform: translateY(-1px);
}

/* Responsive design */
@media (max-width: 768px) {
    .card {
        border-radius: 0.5rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group .btn {
        padding: 0.4rem;
    }
    
    .card-header {
        flex-direction: column;
        align-items: stretch !important;
        gap: 1rem;
        padding: 1rem;
    }
    
    .actions {
        text-align: center;
    }
    
    .user-icon {
        width: 32px;
        height: 32px;
    }
    
    .badge {
        font-size: 0.7rem;
    }
}
</style>

<script>
// Initialiser les tooltips Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>