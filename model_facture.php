<?php
/**
 * Modèle pour la facturation des actes médicaux
 */
function getAllFactures($pdo) {
    $sql = "SELECT f.*, p.nom as patient_nom, p.prenom as patient_prenom, p.numero_dossier
            FROM factures f
            JOIN patients p ON f.patient_id = p.id
            ORDER BY f.id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

function getFactureById($pdo, $id) {
    $sql = "SELECT f.*, p.nom as patient_nom, p.prenom as patient_prenom, p.numero_dossier, p.telephone, p.adresse
            FROM factures f
            JOIN patients p ON f.patient_id = p.id
            WHERE f.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getAllActesMedicaux($pdo) {
    $stmt = $pdo->query("SELECT * FROM actes_medicaux ORDER BY libelle ASC");
    return $stmt->fetchAll();
}

function createFacture($pdo, $numero_facture, $patient_id, $consultation_id, $montant_total, $mode_paiement, $statut) {
    $stmt = $pdo->prepare("INSERT INTO factures (numero_facture, patient_id, consultation_id, montant_total, mode_paiement, statut, date_facture) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    return $stmt->execute([$numero_facture, $patient_id, $consultation_id ? $consultation_id : null, $montant_total, $mode_paiement, $statut]);
}

function updateStatutFacture($pdo, $id, $statut, $mode_paiement) {
    $stmt = $pdo->prepare("UPDATE factures SET statut = ?, mode_paiement = ? WHERE id = ?");
    return $stmt->execute([$statut, $mode_paiement, $id]);
}

function generateNumeroFacture($pdo) {
    $year = date('Y');
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM factures");
    $res = $stmt->fetch();
    $nextId = $res['total'] + 1;
    return 'FAC-' . $year . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
}
