<?php
$page_title = "Mentions légales - La Perche Tendue";
$page_description = "Mentions légales et politique de confidentialité du site La Perche Tendue.";
?>
<?php include_once '../includes/header.php'; ?>

<section class="mentions-legales container">
  <h2 class="text-center">Mentions légales</h2>

  <p style="background-color: #d9f7ff; padding: 1rem; border-left: 4px solid #007BFF;">
    Ce site respecte le RGPD. Vos données ne sont ni revendues ni partagées. <a href="#cookies">En savoir plus</a>.
  </p>

  <p><strong>Site :</strong> www.laperchetendue.fr</p>
  <p><strong>Responsable éditeur :</strong> Association La Perche Tendue</p>

  <h3>Identité de l'association</h3>
  <ul>
    <li><strong>Nom :</strong> Association La Perche Tendue</li>
    <li><strong>Épicerie de Lens :</strong> 56 rue Casimir Beugnet, 62300 Lens — 06 68 49 25 07</li>
    <li><strong>Épicerie d'Arras :</strong> 122 rue du Commandant Dumetz, 62000 Arras — 06 60 23 84 69</li>
    <li><strong>Email :</strong> [à compléter]</li>
    <li><strong>Responsable de la publication :</strong> [à compléter]</li>
  </ul>

  <h3>Hébergement</h3>
  <p>Ce site est actuellement hébergé localement en développement via <strong>WAMP</strong>.</p>

  <h3>Protection des données personnelles</h3>
  <p>Les données transmises via le formulaire de contact sont utilisées uniquement dans le cadre des missions de l'association. Elles ne sont ni revendues, ni transmises à des tiers.</p>

  <h3 id="cookies">Cookies</h3>
  <p>Le site utilise uniquement des cookies strictement nécessaires au bon fonctionnement.</p>
  <p>Les cookies tiers (YouTube, Facebook, etc.) sont soumis à votre consentement via le bandeau RGPD (TarteAuCitron.js).</p>
  <p>Vous pouvez modifier vos choix à tout moment via le bouton <strong>« Gestion des cookies »</strong> situé en bas de page.</p>

  <h3>Checklist conformité RGPD</h3>
  <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #f2f2f2;">
      <tr>
        <th>Élément</th>
        <th>Présent ?</th>
        <th>Détail</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Bandeau d'information</td>
        <td>✅ Oui</td>
        <td>« Ce site utilise des cookies » affiché au premier chargement</td>
      </tr>
      <tr>
        <td>Script RGPD</td>
        <td>✅ Oui</td>
        <td>TarteAuCitron.js</td>
      </tr>
      <tr>
        <td>Consentement explicite</td>
        <td>✅ Oui</td>
        <td>L'utilisateur doit cliquer sur « OK »</td>
      </tr>
      <tr>
        <td>Bouton "Gestion des cookies"</td>
        <td>✅ Oui</td>
        <td>Permet d'ouvrir le panneau de gestion</td>
      </tr>
      <tr>
        <td>Scripts bloqués avant consentement</td>
        <td>✅ Oui</td>
        <td>Automatique via TarteAuCitron</td>
      </tr>
    </tbody>
  </table>

  <p style="margin-top: 2rem; font-size: 0.9em; color: #555;">
    Site développé et intégré par <strong>Romain Monier</strong> &ndash; développeur web
  </p>
  <p><strong>Dernière mise à jour :</strong> Mai 2026</p>
</section>

<?php include_once '../includes/footer.php'; ?>