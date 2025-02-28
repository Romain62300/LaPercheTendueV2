<?php include '../includes/header.php'; ?>

<div class="container-container">
    <h2>Contactez-nous</h2>

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green; text-align: center;">Votre message a bien été envoyé !</p>
    <?php endif; ?>

    <?php
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (empty($_POST['nom'])) {
            $errors[] = "Le champ Nom est requis.";
        }
        if (empty($_POST['email'])) {
            $errors[] = "Le champ Email est requis.";
        }
        if (empty($_POST['message'])) {
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

    <div class="contact-form">
        <form action="/la-perche-tendue/src/Controller/ContactController.php" method="POST">

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" >
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre adresse email" >
            </div>
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" placeholder="Votre message" ></textarea>
            </div>
            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
