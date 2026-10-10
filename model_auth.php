<?php
/**
 * Modèle d'authentification (Mots de passe en clair)
 */
function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function getAllUsers($pdo) {
    $stmt = $pdo->query("SELECT id, nom, email, role, created_at FROM utilisateurs ORDER BY nom ASC");
    return $stmt->fetchAll();
}

function createUser($pdo, $nom, $email, $password, $role) {
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password, role) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$nom, $email, $password, $role]);
}
