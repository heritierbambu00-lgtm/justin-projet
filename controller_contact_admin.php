<?php
/**
 * Contrôleur des messages de contact (Admin)
 */
checkRole();
require_once 'model_contact_admin.php';

$subAction = $_GET['sub'] ?? 'list';

if ($subAction === 'update_statut' && isset($_GET['id'], $_GET['statut'])) {
    $id = (int)$_GET['id'];
    $statut = $_GET['statut'];
    updateStatutMessageContact($pdo, $id, $statut);
    redirect('index.php?action=contact_admin&msg=updated');
}

if ($subAction === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    deleteMessageContact($pdo, $id);
    redirect('index.php?action=contact_admin&msg=deleted');
}

$messages = getAllMessagesContact($pdo);
include 'view_contact_admin.php';
