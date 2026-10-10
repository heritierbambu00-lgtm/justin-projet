<?php
/**
 * Modèle pour les messages de contact (Admin & Public)
 */
function getAllMessagesContact($pdo) {
    $stmt = $pdo->query("SELECT * FROM messages_contact ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

function createMessageContact($pdo, $nom, $email, $telephone, $sujet, $message) {
    $stmt = $pdo->prepare("INSERT INTO messages_contact (nom, email, telephone, sujet, message, statut) VALUES (?, ?, ?, ?, ?, 'non_lu')");
    return $stmt->execute([$nom, $email, $telephone, $sujet, $message]);
}

function updateStatutMessageContact($pdo, $id, $statut) {
    $stmt = $pdo->prepare("UPDATE messages_contact SET statut = ? WHERE id = ?");
    return $stmt->execute([$statut, $id]);
}

function deleteMessageContact($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM messages_contact WHERE id = ?");
    return $stmt->execute([$id]);
}
