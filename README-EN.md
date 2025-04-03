<p align="center">
  <img src="https://img.shields.io/badge/Project-La%20Perche%20Tendue-blueviolet?style=for-the-badge" alt="Project Badge">
  <img src="https://img.shields.io/badge/HTML-CSS-JS-PHP-orange?style=for-the-badge" alt="Technologies">
  <img src="https://img.shields.io/badge/Architecture-MVC-informational?style=for-the-badge" alt="Architecture">
</p>

# 🌐 La Perche Tendue – Association Website

This project is the official website of the **La Perche Tendue** association, which works in the field of local solidarity.  
It was developed as part of my **Web / Mobile Developer training** and continues to evolve.

## ✨ Key Features

- Full presentation of the association
- Dynamic news management (create/edit/delete from admin interface)
- Donation page (card, wire transfer, cash)
- Solidarity sponsorship system
- Contact form with RGPD protection
- Cookie consent management via [TarteAuCitron.js](https://github.com/AmauriC/tarteaucitron.js)
- Custom MVC architecture in PHP
- Responsive design (HTML / CSS / JS)

---

## 🧱 Project Structure

```bash
la-perche-tendue/
├── public/              # Public pages (index, contact, donations...)
│   └── assets/          # CSS, JS, images, cookie script
├── admin/               # Admin interface (secured)
├── includes/            # Shared files (header, footer, config, functions)
├── database/            # SQL install script
├── src/                 # MVC architecture
│   ├── Controller/
│   ├── Model/
│   └── View/
├── .gitignore
├── README.md
├── .htaccess
```

---

## ⚙️ Project Configuration

To set up the project locally, follow these steps:

1. **Copy the sample configuration file** (`includes/config.example.php`) :

   - On **Windows (PowerShell)**:
     ```powershell
     Copy-Item includes/config.example.php -Destination includes/config.php
     ```

   - On **Linux / macOS**:
     ```bash
     cp includes/config.example.php includes/config.php
     ```

2. **Edit `config.php`** with your own database connection credentials.

---

💡 **Note:**  
The `config.php` file is **excluded from Git tracking** using `.gitignore` to avoid exposing sensitive information.

---

## 🔧 Run the project locally

1. Clone this repository:
   ```bash
   git clone https://github.com/Romain62300/LaPercheTendueV2.git
   ```

2. Import the `database/install.sql` file into your local MySQL database.

3. Configure your connection in `includes/config.php`.

4. Run a local server with **XAMPP, WAMP or MAMP**.

5. Open `http://localhost/la-perche-tendue/public/index.php` in your browser.

---

## 💡 Dependencies Used

- PHP >= 7.4
- Vanilla JavaScript
- TarteAuCitron.js (for RGPD compliance)
- No external Composer/NPM dependencies (lightweight and local)

---

## 👨‍💻 Developed by

**Romain Monier**  
Junior Web Developer  
📍 Lens, France  
🔗 [LinkedIn Profile (to complete)](https://linkedin.com/in/romain-monier)

---

## 📸 GitHub QR Code

Scan the QR code to access this repository:

<p align="center">
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://github.com/Romain62300/LaPercheTendueV2" alt="QR Code GitHub">
</p>

---

## 📜 License

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

## 🚀 Local Demo with Ngrok

It is possible to present this project locally using [Ngrok](https://ngrok.com/).  
This allows you to share a temporary public link with the association's manager or a recruiter.
