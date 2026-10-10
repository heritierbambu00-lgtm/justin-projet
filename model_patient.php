<?php
/**
 * Modèle pour la gestion des patients
 */
function getAllPatients($pdo, $search = '') {
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $stmt = $pdo->prepare("SELECT * FROM patients WHERE nom LIKE ? OR prenom LIKE ? OR numero_dossier LIKE ? OR telephone LIKE ? ORDER BY id DESC");
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    } else {
        $stmt = $pdo->query("SELECT * FROM patients ORDER BY id DESC");
        return $stmt->fetchAll();
    }
}

function getPatientById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createPatient($pdo, $numero_dossier, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $antecedents) {
    $stmt = $pdo->prepare("INSERT INTO patients (numero_dossier, nom, prenom, date_naissance, sexe, telephone, adresse, groupe_sanguin, antecedents) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$numero_dossier, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $antecedents]);
}

function updatePatient($pdo, $id, $nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $antecedents) {
    $stmt = $pdo->prepare("UPDATE patients SET nom = ?, prenom = ?, date_naissance = ?, sexe = ?, telephone = ?, adresse = ?, groupe_sanguin = ?, antecedents = ? WHERE id = ?");
    return $stmt->execute([$nom, $prenom, $date_naissance, $sexe, $telephone, $adresse, $groupe_sanguin, $antecedents, $id]);
}

function deletePatient($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
    return $stmt->execute([$id]);
}

function generateNumeroDossier($pdo) {
    $year = date('Y');
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM patients");
    $res = $stmt->fetch();
    $nextId = $res['total'] + 1;
    return 'PAT-' . $year . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
}
