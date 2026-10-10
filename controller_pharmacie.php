<?php
/**
 * Contrôleur de la pharmacie et gestion des stocks
 */
checkRole();
require_once 'model_pharmacie.php';

$subAction = $_GET['sub'] ?? 'list';
$message = '';
$error = '';

if ($subAction === 'create_form') {
    $formType = 'med';
    include 'view_pharmacie_form.php';
    return;
}

if ($subAction === 'mouvement_form') {
    $formType = 'mouvement';
    $medicaments = getAllMedicaments($pdo);
    include 'view_pharmacie_form.php';
    return;
}

if ($subAction === 'add_med' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $dosage = trim($_POST['dosage'] ?? '');
    $forme = trim($_POST['forme'] ?? '');
    $prix_unitaire = (float)($_POST['prix_unitaire'] ?? 0);
    $stock_actuel = (int)($_POST['stock_actuel'] ?? 0);
    $stock_alerte = (int)($_POST['stock_alerte'] ?? 10);

    if (!empty($nom) && $prix_unitaire > 0) {
        if (createMedicament($pdo, $nom, $dosage, $forme, $prix_unitaire, $stock_actuel, $stock_alerte)) {
            redirect('index.php?action=pharmacie&msg=created');
        } else {
            $error = "Erreur lors de l'ajout du médicament.";
        }
    } else {
        $error = "Veuillez remplir les champs obligatoires (Nom, Prix).";
    }
}

if ($subAction === 'mouvement' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicament_id = (int)$_POST['medicament_id'];
    $type_mouvement = $_POST['type_mouvement'];
    $quantite = (int)$_POST['quantite'];
    $motif = trim($_POST['motif'] ?? 'Approvisionnement / Délivrance');

    if ($medicament_id > 0 && $quantite > 0) {
        if (updateStockMedicament($pdo, $medicament_id, $quantite, $type_mouvement, $motif)) {
            redirect('index.php?action=pharmacie&msg=mouvement');
        } else {
            $error = "Erreur lors de la mise à jour du stock (stock insuffisant pour une sortie ?).";
        }
    } else {
        $error = "Veuillez indiquer une quantité valide.";
    }
}

$medicaments = getAllMedicaments($pdo);
$medicamentsAlerte = getMedicamentsEnAlerte($pdo);
$mouvements = getMouvementsStock($pdo);

include 'view_pharmacie.php';
