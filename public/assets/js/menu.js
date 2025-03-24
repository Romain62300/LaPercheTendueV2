document.addEventListener("DOMContentLoaded", function () {
    // === MENU BURGER ===
    var toggler = document.querySelector(".navbar-toggler");
    var navbarCollapse = document.querySelector(".navbar-collapse");

    if (toggler && navbarCollapse) {
        toggler.addEventListener("click", function () {
            if (navbarCollapse.classList.contains("show")) {
                navbarCollapse.style.display = "none";
            } else {
                navbarCollapse.style.display = "block";
            }
        });
    }

    // === GESTION DES COOKIES ===
    const banner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("accept-cookies");
    const manageLink = document.getElementById("gestionCookies");

    // Affiche la bannière si l'utilisateur n'a pas encore accepté
    if (banner && acceptBtn && !localStorage.getItem("cookiesAccepted")) {
        banner.style.display = "flex";
    }

    // Clic sur "J’accepte"
    if (acceptBtn) {
        acceptBtn.addEventListener("click", function () {
            localStorage.setItem("cookiesAccepted", "true");
            banner.style.display = "none";
        });
    }

    // Clic sur "Gestion des cookies"
    if (manageLink) {
        manageLink.addEventListener("click", function (e) {
            e.preventDefault();
            if (banner) banner.style.display = "flex";
        });
    }
});