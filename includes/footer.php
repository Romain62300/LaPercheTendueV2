<footer class="footer">
    <div class="wrapper">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Adresse</h3>
                <p>Association PERCHE TENDUE</p>
                <p>Épicerie Solidaire de Lens</p>
                <p>+32 x xxx xx xx</p>
                <a href="https://www.google.com/maps?q=50.4371,2.8265" target="_blank" class="btn-google-maps">
                    <img src="/la-perche-tendue/public/assets/images/google-maps.png" alt="Google Maps"> Adresse
                </a>
            </div>
            <div class="footer-section">
                <h3>Horaires</h3>
                <p>Lundi : 8h30-12h30 / 13h30-17h00</p>
                <p>Mardi : 8h30-12h30 / 13h30-17h00</p>
                <p>Mercredi : 8h30-12h30 / 13h30-17h00</p>
                <p>Jeudi : 8h30-12h30 / 13h30-17h00</p>
                <p>Vendredi : 8h30-12h30 / 13h30-17h00</p>
            </div>
        </div>

        <div class="footer-bottom-container">
            <p>Copyright 2025 Ville de Lens |
                <!--    <a href="#" class="footer-link">Mentions légales</a> | 
                <a href="#" class="footer-link">Gestion des cookies</a>-->
                <a href="/la-perche-tendue/public/mentions-legales.php" class="footer-link">Mentions légales</a> |
                <a href="#" id="gestionCookies" class="footer-link">Gestion des cookies</a>
                <!--<script src="/la-perche-tendue/public/assets/js/menu.js"></script>
<script src="/la-perche-tendue/public/assets/js/cookies.js"></script>-->
                <!-- Scripts JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                <script src="/la-perche-tendue/public/assets/js/cookies.js"></script>
                <script src="/la-perche-tendue/public/assets/js/menu.js"></script>

                <!-- Empêche le menu burger de se fermer immédiatement -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let navbarToggler = document.querySelector(".navbar-toggler");
                        let navbarMenu = document.querySelector("#navbarNav");

                        if (navbarToggler && navbarMenu) {
                            navbarToggler.addEventListener("click", function() {
                                if (!navbarMenu.classList.contains("show")) {
                                    navbarMenu.classList.add("show");
                                } else {
                                    navbarMenu.classList.remove("show");
                                }
                            });
                        }
                    });
                </script>


            </p>
        </div>
    </div>
</footer>