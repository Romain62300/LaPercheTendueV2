
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

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Contactez-nous</h2>
    <p class="text-center">Remplissez le formulaire ci-dessous et nous vous répondrons dès que possible.</p>

    <div class="contact-form">
        <form action="/la-perche-tendue/src/Controller/ContactController.php" method="POST" class="p-4 border rounded bg-light">
            
            <!-- Champ anti-spam caché -->
            <input type="text" name="honeypot" style="display:none;" aria-hidden="true" title="Champ anti-spam caché" tabindex="-1">

            <!-- Protection CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" title="Entrez votre nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" title="Entrez votre adresse email" required>
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" class="form-control" placeholder="Votre message" title="Tapez votre message ici" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Envoyer</button>

        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
