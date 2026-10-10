<?php
/**
 * Contrôleur des patients
 */
checkRole();
require_once 'model_patient.php';
require_once 'model_consultation.php';

$subAction = $_GET['sub'] ?? 'list';
$message = '';
$error = '';

if ($subAction === 'create_form') {
    $newDossier = generateNumeroDossier($pdo);
    include 'view_patient_form.php';
    return;
}

if ($subAction === 'edit_form' && isset($_GET['id'])) {
    $patient = getPatientById($pdo, (int)$_GET['id']);
    include 'view_patient_form.php';
    return;
}

if ($subAction === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_dossier = trim($_POST['numero_dossier'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $sexe = $_POST['sexe'] ?? 'M';
    $telephone = trim($_POST['telephone'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $groupe_sanguin = trim($_POST['groupe_sanguin'] ?? 'Inconnu');
    $antecedents = trim($_POST['antecedents'] ?? '');

    if (!empty($nom) && !empty($prenom) && !empty($date_naissance)) {
        if (empty($numero_dossier)) {
            $numero_dossier = generateNumeroDossier($pdo);
        }
        if (createPatient($pdo, $numero_dossier, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $antecedents)) {
            redirect('index.php?action=patients&msg=created');
        } else {
            $error = "Erreur lors de l'enregistrement du patient.";
        }
    } else {
        $error = "Les champs Nom, Prénom et Date de naissance sont obligatoires.";
    }
}

if ($subAction === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $sexe = $_POST['sexe'] ?? 'M';
    $telephone = trim($_POST['telephone'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $groupe_sanguin = trim($_POST['groupe_sanguin'] ?? 'Inconnu');
    $antecedents = trim($_POST['antecedents'] ?? '');

    if (updatePatient($pdo, $id, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $antecedents)) {
        redirect('index.php?action=patients&msg=updated');
    } else {
        $error = "Erreur lors de la mise à jour.";
    }
}

if ($subAction === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    deletePatient($pdo, $id);
    redirect('index.php?action=patients&msg=deleted');
}

if ($subAction === 'detail' && isset($_GET['id'])) {
    $patient_id = (int)$_GET['id'];
    $patient = getPatientById($pdo, $patient_id);
    $consultations = getConsultationsByPatient($pdo, $patient_id);
    include 'view_patient_detail.php';
    return;
}

$search = $_GET['search'] ?? '';
$patients = getAllPatients($pdo, $search);
$newDossier = generateNumeroDossier($pdo);

include 'view_patients.php';
