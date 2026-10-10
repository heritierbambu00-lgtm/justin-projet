<?php
/**
 * Contrôleur des consultations médicales
 */
checkRole();
require_once 'model_consultation.php';
require_once 'model_patient.php';
require_once 'model_auth.php';

$subAction = $_GET['sub'] ?? 'list';
$message = '';
$error = '';

if ($subAction === 'create_form') {
    $patients = getAllPatients($pdo);
    $medecins = getAllUsers($pdo);
    include 'view_consultation_form.php';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = (int)($_POST['patient_id'] ?? 0);
    $medecin_id = (int)($_POST['medecin_id'] ?? $_SESSION['user_id']);
    $motif = trim($_POST['motif'] ?? '');
    $diagnostic = trim($_POST['diagnostic'] ?? '');
    $prescription = trim($_POST['prescription'] ?? '');
    $notes = trim($_POST['notes'] ?? '');

    if ($patient_id > 0 && !empty($motif) && !empty($diagnostic)) {
        if (createConsultation($pdo, $patient_id, $medecin_id, $motif, $diagnostic, $prescription, $notes)) {
            redirect('index.php?action=consultations&msg=created');
        } else {
            $error = "Erreur lors de l'enregistrement de la consultation.";
        }
    } else {
        $error = "Veuillez sélectionner un patient et renseigner le motif et le diagnostic.";
    }
}

$consultations = getAllConsultations($pdo);
$patients = getAllPatients($pdo);
$medecins = getAllUsers($pdo);

include 'view_consultations.php';
