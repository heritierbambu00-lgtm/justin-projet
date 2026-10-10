<?php
/**
 * Modèle pour les consultations médicales
 */
function getAllConsultations($pdo) {
    $sql = "SELECT c.*, p.nom as patient_nom, p.prenof as patient_prenom, p.numero_dossier, u.nom as medecin_nom
            FROM consultations c
            JOIN patients p ON c.patient_id = p.id
            JOIN utilisateurs u ON c.medecin_id = u.id
            ORDER BY c.date_consultation DESC";
    // Correction de la faute de frappe éventuelle dans prénom
    $sqlFixed = "SELECT c.*, p.nom as patient_nom, p.prenom as patient_prenom, p.numero_dossier, u.nom as medecin_nom
                 FROM consultations c
                 JOIN patients p ON c.patient_id = p.id
                 JOIN utilisateurs u ON c.medecin_id = u.id
                 ORDER BY c.date_consultation DESC";
    $stmt = $pdo->query($sqlFixed);
    return $stmt->fetchAll();
}

function getConsultationsByPatient($pdo, $patient_id) {
    $stmt = $pdo->prepare("SELECT c.*, u.nom as medecin_nom FROM consultations c JOIN utilisateurs u ON c.medecin_id = u.id WHERE c.patient_id = ? ORDER BY c.date_consultation DESC");
    $stmt->execute([$patient_id]);
    return $stmt->fetchAll();
}

function getConsultationById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT c.*, p.nom as patient_nom, p.prenom as patient_prenom, p.numero_dossier, u.nom as medecin_nom
                           FROM consultations c
                           JOIN patients p ON c.patient_id = p.id
                           JOIN utilisateurs u ON c.medecin_id = u.id
                           WHERE c.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createConsultation($pdo, $patient_id, $medecin_id, $motif, $diagnostic, $prescription, $notes) {
    $stmt = $pdo->prepare("INSERT INTO consultations (patient_id, medecin_id, motif, diagnostic, prescription, notes, date_consultation) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    return $stmt->execute([$patient_id, $medecin_id, $motif, $diagnostic, $prescription, $notes]);
}
