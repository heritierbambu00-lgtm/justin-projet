<?php
/**
 * Modèle pour la gestion de la pharmacie et des stocks
 */
function getAllMedicaments($pdo) {
    $stmt = $pdo->query("SELECT * FROM medicaments ORDER BY nom ASC");
    return $stmt->fetchAll();
}

function getMedicamentById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM medicaments WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getMedicamentsEnAlerte($pdo) {
    $stmt = $pdo->query("SELECT * FROM medicaments WHERE stock_actuel <= stock_alerte ORDER BY stock_actuel ASC");
    return $stmt->fetchAll();
}

function createMedicament($pdo, $nom, $dosage, $forme, $prix_unitaire, $stock_actuel, $stock_alerte) {
    $stmt = $pdo->prepare("INSERT INTO medicaments (nom, dosage, forme, prix_unitaire, stock_actuel, stock_alerte) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$nom, $dosage, $forme, $prix_unitaire, $stock_actuel, $stock_alerte]);
}

function updateStockMedicament($pdo, $id, $quantite, $type_mouvement, $motif) {
    // 1. Récupérer stock actuel
    $med = getMedicamentById($pdo, $id);
    if (!$med) return false;

    $nouveauStock = $med['stock_actuel'];
    if ($type_mouvement === 'ENTREE') {
        $nouveauStock += $quantite;
    } else {
        $nouveauStock = max(0, $nouveauStock - $quantite);
    }

    // 2. Mettre à jour le stock
    $stmt = $pdo->prepare("UPDATE medicaments SET stock_actuel = ? WHERE id = ?");
    $stmt->execute([$nouveauStock, $id]);

    // 3. Enregistrer le mouvement
    $stmtMouv = $pdo->prepare("INSERT INTO mouvements_stock (medicament_id, type_mouvement, quantite, motif) VALUES (?, ?, ?, ?)");
    return $stmtMouv->execute([$id, $type_mouvement, $quantite, $motif]);
}

function getMouvementsStock($pdo) {
    $sql = "SELECT m.*, med.nom as medicament_nom, med.dosage, med.forme
            FROM mouvements_stock m
            JOIN medicaments med ON m.medicament_id = med.id
            ORDER BY m.id DESC LIMIT 50";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}
