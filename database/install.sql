CREATE DATABASE IF NOT EXISTS la_perche_tendue CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE la_perche_tendue;

-- =====================================================
-- Table utilisateurs
-- =====================================================
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- Table contacts
-- user_id est optionnel : NULL pour les visiteurs anonymes
-- =====================================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL DEFAULT '',
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NULL,
    message TEXT NOT NULL,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- =====================================================
-- Table bénéficiaires
-- =====================================================
CREATE TABLE IF NOT EXISTS beneficiaires (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telephone VARCHAR(20),
    adresse TEXT,
    situation VARCHAR(255),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- Table dons
-- =====================================================
CREATE TABLE IF NOT EXISTS dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    date_don TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_utilisateur_don FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =====================================================
-- Table articles (actualités)
-- =====================================================
CREATE TABLE IF NOT EXISTS articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    image VARCHAR(255) NULL,
    auteur_id INT NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_auteur_article FOREIGN KEY (auteur_id) REFERENCES utilisateurs(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- =====================================================
-- Table parrainages
-- =====================================================
CREATE TABLE IF NOT EXISTS parrainages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    parrain_id INT NULL,
    beneficiaire_id INT NULL,
    message TEXT NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_parrain FOREIGN KEY (parrain_id) REFERENCES utilisateurs(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    CONSTRAINT fk_beneficiaire FOREIGN KEY (beneficiaire_id) REFERENCES beneficiaires(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- =====================================================
-- Table stocks (épicerie solidaire)
-- =====================================================
CREATE TABLE IF NOT EXISTS stocks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    produit VARCHAR(100) NOT NULL,
    categorie VARCHAR(50),
    quantite INT NOT NULL DEFAULT 0,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- Table événements
-- =====================================================
CREATE TABLE IF NOT EXISTS evenements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(100) NOT NULL,
    description TEXT,
    date_evenement DATETIME NOT NULL,
    lieu VARCHAR(255),
    organisateur_id INT NULL,
    CONSTRAINT fk_organisateur FOREIGN KEY (organisateur_id) REFERENCES utilisateurs(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- =====================================================
-- Table médias (bibliothèque de photos uploadées)
-- =====================================================
CREATE TABLE IF NOT EXISTS medias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_fichier VARCHAR(255) NOT NULL UNIQUE,
    titre VARCHAR(255) NOT NULL,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- Table pages_photos (association photo <-> section de page)
-- =====================================================
CREATE TABLE IF NOT EXISTS pages_photos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    page_slug VARCHAR(50) NOT NULL,
    section_slug VARCHAR(50) NOT NULL,
    nom_fichier VARCHAR(255) NOT NULL,
    UNIQUE KEY uk_page_section (page_slug, section_slug)
);

-- =====================================================
-- Table pages_contenu (textes éditables du CMS)
-- =====================================================
CREATE TABLE IF NOT EXISTS pages_contenu (
    id INT PRIMARY KEY AUTO_INCREMENT,
    page_slug VARCHAR(50) NOT NULL UNIQUE,
    page_titre VARCHAR(255) NOT NULL,
    bloc VARCHAR(50) NOT NULL,
    contenu TEXT NOT NULL,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- Contenu initial des pages (à importer après install.sql)
-- Voir database/pages_contenu.sql
-- =====================================================
