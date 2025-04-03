🇬🇧 [English version here](README-EN.md)

<p align="center">
  <img src="https://img.shields.io/badge/Projet-La%20Perche%20Tendue-blueviolet?style=for-the-badge" alt="Badge Projet">
  <img src="https://img.shields.io/badge/HTML-CSS-JS-PHP-orange?style=for-the-badge" alt="Technos">
  <img src="https://img.shields.io/badge/Architecture-MVC-informational?style=for-the-badge" alt="Architecture">
</p>

# 🌐 La Perche Tendue – Site de l'association

Ce projet est le site officiel de l'association **La Perche Tendue**, qui œuvre dans le domaine de la solidarité locale.  
Il a été réalisé dans le cadre de ma formation de **Développeur Web / Web mobile** et continue d’évoluer.

## ✨ Fonctionnalités principales

- Présentation complète de l’association
- Actualités dynamiques (ajout/modif/suppression via interface admin)
- Page de dons (carte, virement, espèces)
- Parrainage solidaire
- Formulaire de contact avec protection RGPD
- Gestion des cookies via [TarteAuCitron.js](https://github.com/AmauriC/tarteaucitron.js)
- Architecture MVC en PHP
- Responsive design (HTML / CSS / JS)

---

## 🧱 Structure du projet

```bash
la-perche-tendue/
├── public/              # Pages accessibles au public (index, contact, dons...)
│   └── assets/          # CSS, JS, images, scripts cookie
├── admin/               # Interface d’administration sécurisée
├── includes/            # Fichiers partagés (header, footer, config, fonctions)
├── database/            # Script SQL d'installation
├── src/                 # Architecture MVC
│   ├── Controller/
│   ├── Model/
│   └── View/
├── .gitignore
├── README.md
├── .htaccess
```

---

## ⚙️ Configuration du projet

Pour configurer le projet localement, suivez ces étapes :

1. **Copiez le fichier de configuration modèle** (`includes/config.example.php`) :

   - Sous **Windows (PowerShell)** :
     ```powershell
     Copy-Item includes/config.example.php -Destination includes/config.php
     ```

   - Sous **Linux / macOS** :
     ```bash
     cp includes/config.example.php includes/config.php
     ```

2. **Modifiez `config.php`** avec vos propres informations de connexion à la base de données.

---

💡 **Remarque :**  
Le fichier `config.php` est **exclu du suivi Git** grâce au `.gitignore`, pour **éviter de partager des données sensibles**.

---

## 🔧 Lancer le projet en local

1. Cloner ce dépôt :
   ```bash
   git clone https://github.com/Romain62300/LaPercheTendueV2.git
   ```

2. Importer le fichier `database/install.sql` dans votre base de données locale (MySQL).

3. Configurer `includes/config.php` avec les bons identifiants DB.

4. Lancer un serveur local avec **XAMPP, WAMP ou MAMP**.

5. Ouvrir `http://localhost/la-perche-tendue/public/index.php` dans votre navigateur.

---

## 💡 Dépendances utilisées

- PHP >= 7.4
- JavaScript vanilla
- TarteAuCitron.js (RGPD)
- Aucune dépendance externe via composer/npm (léger et local)

---

## 👨‍💻 Développé par

**Romain Monier**  
Développeur Web Junior  
📍 Lens (62), France  
🔗 [Profil LinkedIn (à compléter)](https://linkedin.com/in/romain-monier)

---

## 📸 QR Code vers ce dépôt GitHub

Voici le QR code à scanner pour accéder directement au projet :

<p align="center">
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://github.com/Romain62300/LaPercheTendueV2" alt="QR Code GitHub">
</p>

---

## 📜 Licence

```text
MIT License

Copyright (c) 2025 Romain Monier

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND.
```

---

## 🚀 Démonstration locale (avec Ngrok)

Il est possible de présenter ce projet en local grâce à [Ngrok](https://ngrok.com/).  
Cela permet d’ouvrir temporairement un accès public pour la responsable de l’association ou un recruteur.


