<?php
/**
 * Modèle pour les statistiques et le suivi financier du tableau de bord
 */
function getDashboardStats($pdo) {
    $stats = [];

    // Total patients
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM patients");
    $stats['total_patients'] = $stmt->fetch()['count'];

    // Total consultations
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM consultations");
    $stats['total_consultations'] = $stmt->fetch()['count'];

    // Total factures impayées & montant
    $stmt = $pdo->query("SELECT COUNT(*) as count, SUM(montant_total) as total FROM factures WHERE statut = 'impaye'");
    $resImpaye = $stmt->fetch();
    $stats['factures_impayees_count'] = $resImpaye['count'] ?? 0;
    $stats['factures_impayees_montant'] = $resImpaye['total'] ?? 0;

    // Recettes Totales Encaissées (Factures réglées statut = 'paye')
    $stmt = $pdo->query("SELECT COUNT(*) as count, SUM(montant_total) as total FROM factures WHERE statut = 'paye'");
    $resPaye = $stmt->fetch();
    $stats['recettes_totales_count'] = $resPaye['count'] ?? 0;
    $stats['recettes_totales_montant'] = $resPaye['total'] ?? 0;

    // Recettes du Mois en cours
    $stmt = $pdo->query("SELECT SUM(montant_total) as total FROM factures WHERE statut = 'paye' AND MONTH(date_facture) = MONTH(CURRENT_DATE()) AND YEAR(date_facture) = YEAR(CURRENT_DATE())");
    $resMois = $stmt->fetch();
    $stats['recettes_mois'] = $resMois['total'] ?? 0;

    // Médicaments en alerte stock
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM medicaments WHERE stock_actuel <= stock_alerte");
    $stats['medicaments_alerte'] = $stmt->fetch()['count'];

    // Rendez-vous en attente
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM rendez_vous WHERE statut = 'en_attente'");
    $stats['rdv_en_attente'] = $stmt->fetch()['count'];

    // Messages de contact non lus
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM messages_contact WHERE statut = 'non_lu'");
    $stats['messages_non_lus'] = $stmt->fetch()['count'];

    return $stats;
}

function getRecentConsultations($pdo, $limit = 5) {
    $sql = "SELECT c.*, p.nom as patient_nom, p.prenom as patient_prenom, u.nom as medecin_nom
            FROM consultations c
            JOIN patients p ON c.patient_id = p.id
            JOIN utilisateurs u ON c.medecin_id = u.id
            ORDER BY c.date_consultation DESC LIMIT ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
