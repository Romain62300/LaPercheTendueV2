<?php include '../includes/header.php'; ?>

<div class="container-container">
    <h2>Contactez-nous</h2>

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green; text-align: center;">Votre message a bien été envoyé !</p>
    <?php endif; ?>

    <?php
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = htmlspecialchars(trim($_POST['nom']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars(trim($_POST['message']));

        if (!empty($_POST['honeypot'])) {
            die("Spam détecté !");
        }

        if (empty($nom)) {
            $errors[] = "Le champ Nom est requis.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Veuillez entrer une adresse email valide.";
        }
        if (empty($message)) {
            $errors[] = "Le champ Message est requis.";
        }
    }

    if (!empty($errors)) {
        echo "<div style='color: red; text-align: center;'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
    ?>

   <!-- <div class="contact-form">
        <form action="/la-perche-tendue/src/Controller/ContactController.php" method="POST">
            <input type="text" name="honeypot" style="display:none;"> 

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
            </div>
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" placeholder="Votre message" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </div>
</div>
<div class="contact-form">
    <form action="/la-perche-tendue/src/Controller/ContactController.php" method="POST">
        <input type="text" name="honeypot" style="display:none;"> <!-- Champ anti-bot -->

      <!--  <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" title="Entrez votre nom" aria-label="Nom" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre adresse email" title="Entrez votre adresse email" aria-label="Email" required>
        </div>
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea id="message" name="message" placeholder="Votre message" title="Tapez votre message ici" aria-label="Message" required></textarea>
        </div>
        <button type="submit" class="btn-submit" title="Envoyer votre message">Envoyer</button>
    </form>
</div>

-->

<div class="contact-form">
    <form action="/la-perche-tendue/src/Controller/ContactController.php" method="POST">
        <input type="text" name="honeypot" style="display:none;" aria-hidden="true" title="Champ anti-spam caché"
        tabindex="-1"> <!-- Champ anti-bot -->

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" title="Entrez votre nom" aria-label="Nom" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre adresse email" title="Entrez votre adresse email" aria-label="Email" required>
        </div>
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea id="message" name="message" placeholder="Votre message" title="Tapez votre message ici" aria-label="Message" required></textarea>
        </div>
        <button type="submit" class="btn-submit" title="Envoyer votre message" aria-label="Envoyer le message">Envoyer</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
