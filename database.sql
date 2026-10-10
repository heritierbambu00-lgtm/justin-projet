-- ========================================================
-- Script SQL pour CENTRE DE SANTÉ CECA 20 LUME
-- Monnaie : Franc Congolais (FC)
-- Compatible InfinityFree (AUCUNE instruction CREATE DATABASE)
-- ========================================================

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Table des Utilisateurs
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'medecin', 'pharmacien', 'receptionniste') NOT NULL DEFAULT 'medecin',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Table des Patients
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `numero_dossier` VARCHAR(50) NOT NULL UNIQUE,
  `nom` VARCHAR(100) NOT NULL,
  `prenom` VARCHAR(100) NOT NULL,
  `date_naissance` DATE NOT NULL,
  `sexe` ENUM('M', 'F') NOT NULL,
  `telephone` VARCHAR(25) DEFAULT NULL,
  `adresse` TEXT DEFAULT NULL,
  `groupe_sanguin` VARCHAR(10) DEFAULT 'Inconnu',
  `antecedents` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Table des Consultations Médicales
DROP TABLE IF EXISTS `consultations`;
CREATE TABLE `consultations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `patient_id` INT NOT NULL,
  `medecin_id` INT NOT NULL,
  `date_consultation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `motif` VARCHAR(255) NOT NULL,
  `diagnostic` TEXT NOT NULL,
  `prescription` TEXT DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  FOREIGN KEY (`patient_id`) REFERENCES `patients`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`medecin_id`) REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Table des Actes Médicaux (Tarifs en Franc Congolais FC)
DROP TABLE IF EXISTS `actes_medicaux`;
CREATE TABLE `actes_medicaux` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `libelle` VARCHAR(150) NOT NULL,
  `prix` DECIMAL(12, 2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `actes_medicaux` (`id`, `libelle`, `prix`) VALUES
(1, 'Consultation Générale', 15000.00),
(2, 'Consultation Spécialisée', 30000.00),
(3, 'Test Paludisme (TDR)', 8000.00),
(4, 'Pansement simple', 6000.00),
(5, 'Injection intramusculaire', 4000.00);

-- 5. Table des Factures (Suivi Financier en FC)
DROP TABLE IF EXISTS `factures`;
CREATE TABLE `factures` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `numero_facture` VARCHAR(50) NOT NULL UNIQUE,
  `patient_id` INT NOT NULL,
  `consultation_id` INT DEFAULT NULL,
  `montant_total` DECIMAL(12, 2) NOT NULL,
  `statut` ENUM('impaye', 'paye') NOT NULL DEFAULT 'impaye',
  `mode_paiement` VARCHAR(50) DEFAULT 'Espèces',
  `date_facture` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `patients`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`consultation_id`) REFERENCES `consultations`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Table des Médicaments (Pharmacie - Prix en FC)
DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE `medicaments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(150) NOT NULL,
  `dosage` VARCHAR(50) NOT NULL,
  `forme` VARCHAR(50) NOT NULL,
  `prix_unitaire` DECIMAL(12, 2) NOT NULL,
  `stock_actuel` INT NOT NULL DEFAULT 0,
  `stock_alerte` INT NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `medicaments` (`id`, `nom`, `dosage`, `forme`, `prix_unitaire`, `stock_actuel`, `stock_alerte`) VALUES
(1, 'Paracétamol', '500mg', 'Comprimé', 1500.00, 120, 20),
(2, 'Arteméther-Luméfantrine', '80/480mg', 'Comprimé', 7500.00, 8, 15),
(3, 'Oméprazole', '20mg', 'Gélule', 4500.00, 45, 10),
(4, 'Amoxicilline', '500mg', 'Gélule', 6000.00, 5, 10),
(5, 'Ibuprofène', '400mg', 'Comprimé', 2500.00, 75, 15);

-- 7. Table des Mouvements de Stock Pharmacie
DROP TABLE IF EXISTS `mouvements_stock`;
CREATE TABLE `mouvements_stock` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `medicament_id` INT NOT NULL,
  `type_mouvement` ENUM('ENTREE', 'SORTIE') NOT NULL,
  `quantite` INT NOT NULL,
  `motif` VARCHAR(255) NOT NULL,
  `date_mouvement` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`medicament_id`) REFERENCES `medicaments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Table des Rendez-vous
DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE `rendez_vous` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom_patient` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(30) NOT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `date_rdv` DATETIME NOT NULL,
  `motif` VARCHAR(255) NOT NULL,
  `statut` ENUM('en_attente', 'confirme', 'annule') NOT NULL DEFAULT 'en_attente',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Table des Messages de Contact
DROP TABLE IF EXISTS `messages_contact`;
CREATE TABLE `messages_contact` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telephone` VARCHAR(30) DEFAULT NULL,
  `sujet` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `statut` ENUM('non_lu', 'lu', 'traite') NOT NULL DEFAULT 'non_lu',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
