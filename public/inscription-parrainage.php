<?php
$page_title = "Inscription au parrainage - La Perche Tendue";
$page_description = "Inscrivez-vous pour devenir parrain ou bénéficiaire de notre programme de parrainage.";
?>
<?php
include '../includes/header.php';
require '../database/database.php';

// Récupération des valeurs en cas d'erreur
$nom = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
?>

<div class="container mt-5">
    <h2 class="text-center">Inscription au Parrainage</h2>
    <p class="text-center">Devenez parrain et soutenez une personne en difficulté.</p>

    <!-- Affichage des erreurs -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <strong>Erreur :</strong> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Affichage du message de succès -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <strong>Succès :</strong> <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form action="/la-perche-tendue/src/Controller/ParrainageController.php" method="POST">
        <input type="text" name="honeypot" style="display:none;" aria-hidden="true" title="Champ anti-spam caché" tabindex="-1">

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" value="<?= $nom ?>" required minlength="3">
        </div>

        <div class="form-group mt-3">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" value="<?= $email ?>" required>
        </div>

        <div class="form-group mt-3">
            <label for="message">Message :</label>
            <textarea id="message" name="message" class="form-control" placeholder="Votre message (optionnel)" maxlength="500"><?= $message ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">S'inscrire comme parrain</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
