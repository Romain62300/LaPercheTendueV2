<?php include '../includes/header.php'; ?>
<?php require '../database/database.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Inscription au Parrainage</h2>
    <p class="text-center">Devenez parrain et soutenez une personne en difficulté.</p>

    <form action="/la-perche-tendue/src/Controller/ParrainageController.php" method="POST">
        <input type="text" name="honeypot" style="display:none;" aria-hidden="true" title="Champ anti-spam caché" tabindex="-1"> <!-- Champ anti-bot -->

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" required>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" required>
        </div>

        <div class="form-group mt-3">
            <label for="message">Message :</label>
            <textarea id="message" name="message" class="form-control" placeholder="Votre message (optionnel)"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">S'inscrire comme parrain</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
