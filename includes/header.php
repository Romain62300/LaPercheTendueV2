<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'La Perche Tendue') ?></title>
    <meta name="description" content="<?= htmlspecialchars($page_description ?? "Site web de l'association La Perche Tendue") ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href=" /LaPercheTendue/LaPercheTendueV2/public/assets/css/style.css">

    <style>
        /* HEADER */
        .top-header {
            background: linear-gradient(135deg, #C62828 0%, #8B0000 100%);
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.2);
        }

        .top-header .logo img {
            height: 75px;
            width: auto;
            border-radius: 8px;
            background: white;
            padding: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            object-fit: contain;
        }

        .top-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 800;
            color: white;
            text-align: center;
            flex-grow: 1;
            margin: 0;
            letter-spacing: 0.03em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .top-header .social-icons a {
            color: rgba(255,255,255,0.85);
            font-size: 1.4rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .top-header .social-icons a:hover {
            color: #FFD700;
            transform: scale(1.2);
        }

        /* NAVBAR */
        .navbar-lpt {
            background-color: #2E4369;
            padding: 0;
            border-bottom: 3px solid #C62828;
        }

        .navbar-lpt .navbar-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            width: 100%;
            gap: 0;
        }

        .navbar-lpt .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-family: 'Source Sans 3', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 14px 20px !important;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            margin-bottom: -3px;
        }

        .navbar-lpt .nav-link:hover {
            color: white !important;
            border-bottom-color: #C62828;
            background-color: rgba(255,255,255,0.07);
        }

        .navbar-toggler {
            border-color: rgba(255,255,255,0.3) !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* BODY */
        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #f5f6fa;
            color: #444;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* IMAGES */
        img { max-width: 100%; height: auto; }

        /* SECTIONS */
     section {
    max-width: 100%;
    margin: 0 auto;
    padding: 40px 40px;
    width: 100%;
}
        /* TITRES */
        h2.text-center {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 800;
            color: #2E4369;
            margin-bottom: 16px;
            padding-bottom: 16px;
            position: relative;
        }

        h2.text-center::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #C62828;
            border-radius: 2px;
            margin: 12px auto 0;
        }

        /* CARTES SERVICES */
        .services-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 40px;
        }

        .services-grid .service {
            width: 280px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            text-align: center;
        }

        .services-grid .service:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.14);
        }

        .services-grid .service a { display: block; padding-bottom: 16px; color: inherit; text-decoration: none; }

        .services-grid .service img {
            width: 100%;
            height: 145px;
            object-fit: cover;
        }

        .services-grid .service p {
            font-size: 0.85rem;
            color: #2E4369;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 12px 10px 0;
            margin: 0;
        }

        /* CARTES ACTUALITÉS */
        .actualites-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 40px;
        }

        .actualite {
            width: 320px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            border-top: 4px solid #C62828;
            text-decoration: none;
            color: inherit;
        }

        .actualite:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.14);
        }

        .actualite img { width: 100%; height: 190px; object-fit: cover; }

        .actualite h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            color: #2E4369;
            font-weight: 700;
            padding: 16px 18px 8px;
        }

        .actualite p {
            font-size: 0.92rem;
            color: #555;
            padding: 0 18px 20px;
            flex-grow: 1;
            line-height: 1.6;
        }

        /* CARTES PERCHE */
        .perche-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 40px;
        }

        .perche-item {
            width: 280px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            border-top: 4px solid #2E4369;
        }

        .perche-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.14);
        }

        .perche-item img { width: 100%; height: 180px; object-fit: cover; }
        .perche-item p { padding: 14px 14px 8px; color: #2E4369; font-weight: 600; font-size: 0.95rem; margin: 0; }

        /* BOUTONS */
        .btn-primary, .btn {
            background-color: #C62828 !important;
            border-color: #C62828 !important;
            color: white !important;
            font-weight: 700;
            border-radius: 8px;
            padding: 10px 22px;
            transition: all 0.3s ease;
            font-family: 'Source Sans 3', sans-serif;
        }

        .btn-primary:hover, .btn:hover {
            background-color: #A31F1F !important;
            border-color: #A31F1F !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(198,40,40,0.35);
        }

        .btn-don {
            display: inline-block;
            margin: 10px auto 20px;
            padding: 11px 26px;
            background-color: #C62828;
            color: white;
            border-radius: 8px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-don:hover {
            background-color: #A31F1F;
            transform: scale(1.04);
            color: white;
        }

        /* DONS */
        .dons-section { max-width: 1200px; margin: 0 auto; padding: 60px 24px; text-align: center; }

        .dons-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 28px;
            margin-top: 40px;
        }

        .don-item {
            width: 280px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            border-top: 4px solid #C62828;
        }

        .don-item:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.14); }
        .don-item img { width: 100%; height: 180px; object-fit: cover; }
        .don-item h3 { font-family: 'Playfair Display', serif; font-size: 1.05rem; color: #2E4369; font-weight: 700; padding: 16px 16px 6px; }
        .don-item p { font-size: 0.92rem; padding: 0 16px 16px; color: #555; flex-grow: 1; }

        /* FORMULAIRES */
        .contact-container, .parrainage-info, .form-container {
            max-width: 760px;
            margin: 48px auto;
            padding: 48px 44px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }

        .form-group { margin-bottom: 18px; }
        .form-group label { font-weight: 600; color: #2E4369; font-size: 0.95rem; display: block; margin-bottom: 6px; }

        .form-group input,
        .form-group textarea,
        .form-boite input,
        .form-boite textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e4ed;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafbfd;
            font-family: 'Source Sans 3', sans-serif;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #C62828;
            background: white;
            box-shadow: 0 0 0 3px rgba(198,40,40,0.1);
        }

        .form-group textarea { min-height: 130px; resize: vertical; }

        .btn-submit, .btn-parrain {
            display: block;
            width: 100%;
            max-width: 220px;
            margin: 24px auto 0;
            padding: 13px;
            background-color: #C62828;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover, .btn-parrain:hover {
            background-color: #A31F1F;
            transform: translateY(-2px);
        }

        /* FOOTER */
        .footer {
            background: #2E4369;
            color: rgba(255,255,255,0.88);
            padding: 48px 24px 0;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            max-width: 1000px;
            margin: 0 auto 32px;
            flex-wrap: wrap;
            gap: 32px;
        }

        .footer-section { min-width: 200px; }

        .footer-section h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: white;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .footer-section p, .footer-section address {
            font-size: 0.92rem;
            line-height: 1.8;
            font-style: normal;
        }

        .footer-bottom-container {
            background-color: rgba(0,0,0,0.2);
            color: rgba(255,255,255,0.75);
            padding: 14px 24px;
            text-align: center;
            font-size: 13px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .footer-bottom-container a {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 600;
            padding: 0 10px;
            transition: all 0.3s ease;
        }

        .footer-bottom-container a:hover { color: #FFD700 !important; }

        /* COOKIE BANNER */
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #2E4369;
            color: white;
            padding: 14px 24px;
            font-size: 14px;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            box-shadow: 0 -2px 12px rgba(0,0,0,0.2);
            gap: 16px;
        }

        #cookieAccept {
            background-color: #C62828;
            color: white;
            border: none;
            padding: 8px 18px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        #cookieAccept:hover { background-color: #A31F1F; }

        /* QUI SOMMES NOUS */
        .qui-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 28px;
            margin-top: 40px;
        }

        .qui-item {
            width: 280px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease;
            border-top: 4px solid #2E4369;
        }

        .qui-item:hover { transform: translateY(-6px); box-shadow: 0 12px 32px rgba(0,0,0,0.14); }
        .qui-item img { width: 100%; height: 180px; object-fit: cover; }
        .qui-item h3 { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #2E4369; padding: 16px 14px 8px; font-weight: 700; }
        .qui-item p { font-size: 0.92rem; color: #555; padding: 0 14px 20px; }

        .intro-text {
            max-width: 860px;
            margin: 0 auto 40px;
            font-size: 1.08rem;
            line-height: 1.8;
            color: #444;
        }

        /* WRAPPER */
        .wrapper { flex: 1; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .top-header { padding: 12px 16px; flex-wrap: wrap; justify-content: center; }
            .top-header h1 { font-size: 1.2rem; width: 100%; order: 2; }
            .contact-container, .parrainage-info { padding: 28px 20px; }
            .footer-content { flex-direction: column; text-align: center; }
        }

        @media (max-width: 500px) {
            h2.text-center { font-size: 1.5rem; }
            .top-header h1 { font-size: 1rem; }
        }
    </style>
</head>

<body>

<header>
    <!-- Bandeau rouge -->
    <div class="top-header">
        <div class="logo">
            <img src=" /LaPercheTendue/LaPercheTendueV2/public/assets/images/logo.jpg" alt="Logo La Perche Tendue">
        </div>
        <h1>ASSOCIATION LA PERCHE TENDUE</h1>
        <div class="social-icons d-flex gap-3">
            <a href="#" title="Instagram" aria-label="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#" title="Facebook" aria-label="Facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-lpt navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href=" /LaPercheTendue/LaPercheTendueV2/public/index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href=" /LaPercheTendue/LaPercheTendueV2/public/qui-sommes-nous.php">Qui sommes-nous</a></li>
                    <li class="nav-item"><a class="nav-link" href=" /LaPercheTendue/LaPercheTendueV2/public/dons.php">Dons</a></li>
                    <li class="nav-item"><a class="nav-link" href=" /LaPercheTendue/LaPercheTendueV2/public/parrainage.php">Parrainage</a></li>
                    <li class="nav-item"><a class="nav-link" href=" /LaPercheTendue/LaPercheTendueV2/public/actualites.php">Actualités</a></li>
                    <li class="nav-item"><a class="nav-link" href=" /LaPercheTendue/LaPercheTendueV2/public/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="cookie-banner" id="cookieBanner">
    <p>Ce site utilise des cookies uniquement techniques.</p>
    <button id="cookieAccept">OK</button>
</div>