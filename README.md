## ⚙️ Configuration du projet

Pour configurer le projet localement, suivez ces étapes :

1. **Copiez le fichier de configuration modèle**  
   - Sous Windows (PowerShell) :
     ```powershell
     Copy-Item includes/config.example.php -Destination includes/config.php
     ```
   - Sous Linux/Mac :
     ```sh
     cp includes/config.example.php includes/config.php
     ```

2. **Modifiez `config.php`** avec vos propres informations de base de données.

---

💡 **Remarque :**  
Le fichier `config.php` est **exclu du suivi Git** pour **éviter de partager des informations sensibles**.

