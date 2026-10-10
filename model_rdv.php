<?php
/**
 * Modèle pour les rendez-vous
 */
function getAllRendezVous($pdo) {
    $stmt = $pdo->query("SELECT * FROM rendez_vous ORDER BY date_rdv DESC");
    return $stmt->fetchAll();
}

function createRendezVous($pdo, $nom_patient, $telephone, $email, $date_rdv, $motif) {
    $stmt = $pdo->prepare("INSERT INTO rendez_vous (nom_patient, telephone, email, date_rdv, motif, statut) VALUES (?, ?, ?, ?, ?, 'en_attente')");
    return $stmt->execute([$nom_patient, $telephone, $email, $date_rdv, $motif]);
}

function updateStatutRendezVous($pdo, $id, $statut) {
    $stmt = $pdo->prepare("UPDATE rendez_vous SET statut = ? WHERE id = ?");
    return $stmt->execute([$statut, $id]);
}

function deleteRendezVous($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE id = ?");
    return $stmt->execute([$id]);
}
