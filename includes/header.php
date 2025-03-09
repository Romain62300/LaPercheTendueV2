<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Perche Tendue</title>

    <!-- Lien vers le fichier CSS principal -->
    <link rel="stylesheet" href="/la-perche-tendue/public/assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!--  <link rel="stylesheet" href="/la-perche-tendue/public/assets/css/style.css">-->

    <!-- FontAwesome (icônes) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</head>



<body>

    <header>
        <!-- Partie rouge avec le logo, nom et icônes sociales -->
        <div class="top-header">
            <div class="logo">
                <img src="/la-perche-tendue/public/assets/images/logo.jpg" alt="Logo La Perche Tendue">
            </div>
            <h1>ASSOCIATION LA PERCHE TENDUE</h1>
            <!-- <div class="social-icons">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
            </div>-->
            <div class="social-icons">
                <a href="#" title="Suivez-nous sur Instagram" aria-label="Suivez-nous sur Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" title="Suivez-nous sur Facebook" aria-label="Suivez-nous sur Facebook">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>

        </div>

        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Bouton menu burger -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Liens de navigation -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/la-perche-tendue/public/index.php">ACCUEIL</a></li>
                        <li class="nav-item"><a class="nav-link" href="/la-perche-tendue/public/qui-sommes-nous.php">QUI SOMMES NOUS</a></li>
                        <li class="nav-item"><a class="nav-link" href="/la-perche-tendue/public/dons.php">DONS</a></li>
                        <li class="nav-item"><a class="nav-link" href="/la-perche-tendue/public/parrainage.php">PARRAINAGE</a></li>
                        <li class="nav-item"><a class="nav-link" href="/la-perche-tendue/public/actualites.php">ACTUALITÉS</a></li>
                        <li class="nav-item"><a class="nav-link" href="/la-perche-tendue/public/contact.php">CONTACT</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS (Ajouté ici pour activer le menu burger) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>