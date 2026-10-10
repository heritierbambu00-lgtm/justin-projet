<?php
/**
 * Contrôleur des rendez-vous (Admin)
 */
checkRole();
require_once 'model_rdv.php';

$subAction = $_GET['sub'] ?? 'list';
$message = '';
$error = '';

if ($subAction === 'update_statut' && isset($_GET['id'], $_GET['statut'])) {
    $id = (int)$_GET['id'];
    $statut = $_GET['statut'];
    updateStatutRendezVous($pdo, $id, $statut);
    redirect('index.php?action=rdv_admin&msg=updated');
}

if ($subAction === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    deleteRendezVous($pdo, $id);
    redirect('index.php?action=rdv_admin&msg=deleted');
}

$rendezvous = getAllRendezVous($pdo);
include 'view_rdv_admin.php';
