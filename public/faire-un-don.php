<?php include '../includes/header.php'; ?>
<?php require '../database/database.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Faire un don</h2>
    <p class="text-center">Votre soutien est précieux pour nous aider à poursuivre nos actions.</p>

    <form action="/la-perche-tendue/src/Controller/DonController.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="email" class="form-label">Votre email :</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="montant" class="form-label">Montant du don (€) :</label>
            <input type="number" id="montant" name="montant" class="form-control" step="0.01" min="1" max="10000" required>
        </div>
        <button type="submit" class="btn btn-success">Valider le don</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
