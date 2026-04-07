<?php
$page_title = "Nos activités - La Perche Tendue";
$page_description = "Découvrez les différentes actions menées par l'association La Perche Tendue à Lens.";
?>
<?php include_once '../includes/header.php'; ?>

<section class="page-section container">
  <h2 class="section-title">Nos activités</h2>

  <div class="intro-text">
    <p>
      La Perche Tendue mène des actions concrètes et variées pour accompagner les personnes 
      en difficulté et renforcer le lien social sur le territoire de Lens et ses environs.
    </p>
  </div>

  <div class="qui-grid">

    <div class="qui-item">
      <img src="assets/images/epicerie.jpg" alt="Aide alimentaire">
      <h3>Aide alimentaire</h3>
      <p>
        Distribution de colis alimentaires et accès à notre épicerie solidaire 
        pour les personnes en situation de précarité alimentaire.
      </p>
      <a href="epicerie.php" class="btn btn-sm">En savoir plus</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/equipe.jpg" alt="Accompagnement social">
      <h3>Accompagnement social</h3>
      <p>
        Nos bénévoles accompagnent les personnes dans leurs démarches administratives, 
        l'accès aux droits et l'inclusion numérique.
      </p>
      <a href="contact.php" class="btn btn-sm">Nous rejoindre</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/valeurs.jpg" alt="Lien social">
      <h3>Création de lien social</h3>
      <p>
        Ateliers, sorties culturelles et moments de convivialité pour rompre l'isolement 
        et favoriser les rencontres entre bénéficiaires et bénévoles.
      </p>
      <a href="evenements.php" class="btn btn-sm">Voir les événements</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/engagement.jpg" alt="Parrainage">
      <h3>Parrainage solidaire</h3>
      <p>
        Notre programme de parrainage met en relation des bénévoles avec des personnes 
        en difficulté pour un soutien moral et matériel personnalisé.
      </p>
      <a href="parrainage.php" class="btn btn-sm">Devenir parrain</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/parade.jpg" alt="Activités culturelles">
      <h3>Activités culturelles</h3>
      <p>
        Nous soutenons et organisons des événements culturels pour valoriser 
        la diversité et favoriser l'ouverture au monde.
      </p>
      <a href="evenements.php" class="btn btn-sm">Voir les événements</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/festival.jpg" alt="Bénévolat">
      <h3>Bénévolat</h3>
      <p>
        Rejoignez notre équipe de bénévoles et contribuez à nos actions solidaires 
        selon vos disponibilités et vos compétences.
      </p>
      <a href="contact.php" class="btn btn-sm">Devenir bénévole</a>
    </div>

  </div>
</section>

<?php include_once '../includes/footer.php'; ?>
