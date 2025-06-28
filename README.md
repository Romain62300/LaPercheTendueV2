🇬🇧 [English version here](README-EN.md)

<p align="center">
  <img src="https://img.shields.io/badge/Projet-La%20Perche%20Tendue-blueviolet?style=for-the-badge" alt="Badge Projet">
  <img src="https://img.shields.io/badge/HTML-CSS-JS-PHP-orange?style=for-the-badge" alt="Technos">
  <img src="https://img.shields.io/badge/Architecture-MVC-informational?style=for-the-badge" alt="Architecture">
</p>

# 🌐 La Perche Tendue – Site de l'association

Ce projet est le site officiel de l'association **La Perche Tendue**, engagée dans la solidarité locale, l’aide alimentaire et le soutien aux familles en difficulté.

Il a été conçu dans le cadre de ma formation de **Développeur Web / Web mobile** pour mettre en pratique une architecture MVC, des formulaires sécurisés et une gestion dynamique de contenus. Il continue à évoluer et à être amélioré.

---

## ✨ Fonctionnalités principales

- 🧭 Présentation de l’association et de ses valeurs
- 📰 Actualités dynamiques (CRUD via interface admin)
- 💳 Dons en ligne (par carte, virement ou espèces)
- 🤝 Parrainage solidaire
- ✉️ Formulaire de contact avec validation RGPD
- 🍪 Gestion des cookies avec [TarteAuCitron.js](https://github.com/AmauriC/tarteaucitron.js)
- 🧱 Architecture MVC en PHP
- 📱 Responsive design (HTML / CSS / JS)

---

## 🎓 Objectifs pédagogiques

Ce projet m’a permis de pratiquer :
- L’organisation MVC manuelle en PHP
- L’intégration de formulaires avec vérification serveur
- La sécurisation des accès administrateur
- La création de pages dynamiques avec réécriture d’URL
- Le versionnage avec Git et GitHub

---

## 🖼️ Aperçu du site

> (À remplacer par une capture d’écran du site si tu veux)

```bash
http://localhost/la-perche-tendue/public/index.php
```

---

## 🧱 Structure du projet

```bash
la-perche-tendue/
├── public/              # Pages accessibles au public (index, contact, dons…)
│   └── assets/          # CSS, JS, images, RGPD
├── admin/               # Interface d’administration
├── includes/            # Fichiers partagés (config, header, footer…)
├── database/            # Script SQL d’installation
├── src/                 # MVC : Controller / Model / View
├── .gitignore
├── .htaccess
├── README.md
```

---

## ⚙️ Configuration locale

1. **Copier le fichier de configuration** :
```bash
cp includes/config.example.php includes/config.php
```

2. **Modifier `config.php`** avec vos infos MySQL

3. **Importer la BDD** :
   - Utiliser le fichier `database/install.sql` via PhpMyAdmin ou en ligne de commande

4. **Lancer votre serveur local** (WAMP, XAMPP…)

5. Accéder au site via :  
   `http://localhost/la-perche-tendue/public/index.php`

---

## 💡 Dépendances utilisées

- PHP >= 7.4
- HTML / CSS / JS natif
- TarteAuCitron.js
- Pas de dépendances Composer ou npm (projet 100% local)

---

## 👨‍💻 Auteur

**Romain Monier**  
Développeur Web Junior – Formation CDA Simplon Lille  
📍 Lens, France

---

## 📸 QR Code vers ce dépôt GitHub

<p align="center">
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://github.com/Romain62300/LaPercheTendueV2" alt="QR Code GitHub">
</p>

---

## 📜 Licence

```text
MIT License

Ce projet est libre d’utilisation, modification et redistribution sous licence MIT.
```

---

## 🚀 Présentation à distance possible (Ngrok)

Une démonstration peut être organisée en ligne via [Ngrok](https://ngrok.com/), permettant à l’association ou à un recruteur d’accéder temporairement au site local.
 