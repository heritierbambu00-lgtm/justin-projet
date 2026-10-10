<?php
/**
 * Contrôleur de la facturation des actes médicaux
 */
checkRole();
require_once 'model_facture.php';
require_once 'model_patient.php';

$subAction = $_GET['sub'] ?? 'list';
$message = '';
$error = '';

if ($subAction === 'create_form') {
    $actes = getAllActesMedicaux($pdo);
    $patients = getAllPatients($pdo);
    $newNumero = generateNumeroFacture($pdo);
    include 'view_facture_form.php';
    return;
}

if ($subAction === 'edit_form' && isset($_GET['id'])) {
    $facture = getFactureById($pdo, (int)$_GET['id']);
    include 'view_facture_edit.php';
    return;
}

if ($subAction === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = (int)($_POST['patient_id'] ?? 0);
    $acte_id = (int)($_POST['acte_id'] ?? 0);
    $montant_personnalise = trim($_POST['montant'] ?? '');
    $mode_paiement = trim($_POST['mode_paiement'] ?? 'Espèces');
    $statut = trim($_POST['statut'] ?? 'impaye');

    if ($patient_id > 0) {
        $montant = 0;
        if (!empty($montant_personnalise)) {
            $montant = (float)$montant_personnalise;
        } elseif ($acte_id > 0) {
            $actes = getAllActesMedicaux($pdo);
            foreach ($actes as $a) {
                if ($a['id'] == $acte_id) {
                    $montant = (float)$a['prix'];
                    break;
                }
            }
        }

        $numero_facture = generateNumeroFacture($pdo);
        if (createFacture($pdo, $numero_facture, $patient_id, null, $montant, $mode_paiement, $statut)) {
            redirect('index.php?action=factures&msg=created');
        } else {
            $error = "Erreur lors de la création de la facture.";
        }
    } else {
        $error = "Veuillez sélectionner un patient.";
    }
}

if ($subAction === 'update_statut' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['facture_id'];
    $statut = $_POST['statut'];
    $mode_paiement = $_POST['mode_paiement'];
    updateStatutFacture($pdo, $id, $statut, $mode_paiement);
    redirect('index.php?action=factures&msg=updated');
}

if ($subAction === 'print' && isset($_GET['id'])) {
    $facture_id = (int)$_GET['id'];
    $facture = getFactureById($pdo, $facture_id);
    include 'view_facture_print.php';
    return;
}

$factures = getAllFactures($pdo);
$actes = getAllActesMedicaux($pdo);
$patients = getAllPatients($pdo);
$newNumero = generateNumeroFacture($pdo);

include 'view_factures.php';
