<?php
/**
 * Contrôleur du tableau de bord intelligent
 */
checkRole();
require_once 'model_dashboard.php';
require_once 'model_pharmacie.php';

$stats = getDashboardStats($pdo);
$recentConsultations = getRecentConsultations($pdo, 5);
$medicamentsAlerte = getMedicamentsEnAlerte($pdo);

include 'view_dashboard.php';
