<footer class="footer">
  <div class="footer-content">

    <div class="footer-section">
      <h3>Épicerie de Lens</h3>
      <p>56 rue Casimir Beugnet</p>
      <p>62300 Lens</p>
      <p><a href="tel:0668492507" style="color:inherit;">06 68 49 25 07</a></p>
      <p>Mardi – Samedi : 13h – 18h</p>
      <a href="https://www.google.com/maps?q=56+rue+Casimir+Beugnet+62300+Lens"
         target="_blank" rel="noopener noreferrer" class="btn-google-maps">
        Voir sur Google Maps
      </a>
    </div>

    <div class="footer-section">
      <h3>Épicerie d'Arras</h3>
      <p>122 rue du Commandant Dumetz</p>
      <p>62000 Arras</p>
      <p><a href="tel:0660238469" style="color:inherit;">06 60 23 84 69</a></p>
      <p>Mardi – Samedi : 12h – 17h</p>
      <a href="https://www.google.com/maps?q=122+rue+du+Commandant+Dumetz+62000+Arras"
         target="_blank" rel="noopener noreferrer" class="btn-google-maps">
        Voir sur Google Maps
      </a>
    </div>

  </div>

  <div class="footer-bottom-container">
    <p>
      Copyright 2025 Association La Perche Tendue |
      <a href="/LaPercheTendueV2/public/mentions-legales.php" class="footer-link">
        Mentions légales
      </a> |
      <a href="#" id="gestionCookies" class="footer-link">
        Gestion des cookies
      </a>
    </p>
  </div>
</footer>

<script src="/LaPercheTendueV2/public/assets/js/menu.js"></script>
<script src="/LaPercheTendueV2/public/assets/js/tarteaucitron/tarteaucitron.js"></script>
<script src="/LaPercheTendueV2/public/assets/js/tarteaucitron/tarteaucitron.fr.js"></script>

<script>
window.addEventListener('load', function () {
  if (typeof tarteaucitron !== 'undefined') {
    tarteaucitron.init({
      "privacyUrl": "/LaPercheTendueV2/public/mentions-legales.php",
      "hashtag": "#tarteaucitron",
      "cookieName": "tarteaucitron",
      "orientation": "bottom",
      "showAlertSmall": true,
      "cookieslist": true,
      "closePopup": false,
      "showIcon": true,
      "iconPosition": "BottomRight",
      "adblocker": false,
      "DenyAllCta": true,
      "AcceptAllCta": true,
      "highPrivacy": true,
      "handleBrowserDNTRequest": false,
      "removeCredit": true,
      "moreInfoLink": true,
      "useExternalCss": false
    });
  }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const gestionBtn = document.getElementById('gestionCookies');
  if (gestionBtn && typeof tarteaucitron !== 'undefined') {
    gestionBtn.addEventListener('click', function (e) {
      e.preventDefault();
      tarteaucitron.userInterface.openPanel();
    });
  }
});
</script>

</body>
</html>