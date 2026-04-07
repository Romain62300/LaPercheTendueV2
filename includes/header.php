<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'La Perche Tendue') ?></title>
    <meta name="description" content="<?= htmlspecialchars($page_description ?? "Site web de l'association La Perche Tendue") ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/LaPercheTendue/LaPercheTendueV2/public/assets/css/style.css">
</head>

<body>

<!-- Bannière cookie -->
<div class="cookie-banner" id="cookieBanner">
  <p>
    Ce site utilise des cookies.
    <button class="btn-cookie" onclick="acceptCookies()">OK</button>
  </p>
</div>

<header>
    <div class="top-header">
        <div class="logo">
            <a href="/LaPercheTendue/LaPercheTendueV2/public/index.php">
                <img src="/LaPercheTendue/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo La Perche Tendue">
            </a>
        </div>

        <h1>ASSOCIATION LA PERCHE TENDUE</h1>

        <div class="social-icons d-flex gap-3">
            <a href="#" title="Instagram" aria-label="Instagram">
                <i class="fa-brands fa-instagram fa-lg"></i>
            </a>
            <a href="#" title="Facebook" aria-label="Facebook">
                <i class="fa-brands fa-facebook fa-lg"></i>
            </a>
        </div>
    </div>

    <nav class="navbar navbar-lpt navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Ouvrir le menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/qui-sommes-nous.php">Qui sommes-nous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/epicerie.php">Épicerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/dons.php">Dons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/parrainage.php">Parrainage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/evenements.php">Événements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/actualites.php">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/LaPercheTendue/LaPercheTendueV2/public/contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="wrapper">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function acceptCookies() {
    document.getElementById('cookieBanner').style.display = 'none';
    localStorage.setItem('cookiesAccepted', 'true');
}
window.onload = function() {
    if (!localStorage.getItem('cookiesAccepted')) {
        document.getElementById('cookieBanner').style.display = 'flex';
    }
}
</script>

