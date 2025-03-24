document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("accept-cookies");

    // Affiche la bannière si l'utilisateur n'a pas encore accepté
    if (!localStorage.getItem("cookiesAccepted")) {
        banner.style.display = "flex";
    }

    // Lorsqu'il accepte
    if (acceptBtn) {
        acceptBtn.addEventListener("click", function () {
            localStorage.setItem("cookiesAccepted", "true");
            banner.style.display = "none";
        });
    }

    // Si on clique sur "Gestion des cookies"
    const manageLink = document.getElementById("gestionCookies");
    if (manageLink) {
        manageLink.addEventListener("click", function (e) {
            e.preventDefault();
            banner.style.display = "flex";
        });
    }
});
