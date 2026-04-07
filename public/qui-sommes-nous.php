<?php
$page_title = "Qui sommes-nous ? - La Perche Tendue";
$page_description = "Découvrez l'association La Perche Tendue, ses valeurs, son équipe et son engagement solidaire.";
?>
<?php include_once '../includes/header.php'; ?>

<section class="qui-sommes-nous container">
  <h2 id="presentation" class="section-title" aria-label="Présentation de l'association">Qui sommes-nous ?</h2>

  <div class="intro-text">
    <p>
      La Perche Tendue est une association solidaire engagée auprès des personnes en difficulté. 
      À travers nos actions de terrain, nous accompagnons les publics fragilisés dans différents domaines : 
      aide alimentaire, inclusion sociale, accès aux droits et création de lien social.
    </p>

    <p>
      Notre objectif est simple : apporter un soutien concret, humain et accessible à celles et ceux qui en ont besoin, 
      tout en favorisant l’autonomie, la dignité et l’entraide au quotidien.
    </p>
  </div>

  <div class="qui-grid">
    <div class="qui-item">
      <img src="assets/images/valeurs.jpg" alt="Illustration des valeurs de solidarité et de respect de l'association">
      <h3>Nos valeurs</h3>
      <p>
        Solidarité, respect, dignité et engagement sont au cœur de notre action. 
        Elles guident chacune de nos initiatives et donnent du sens à notre présence sur le terrain.
      </p>
      <a href="valeurs.php" class="btn btn-sm">En savoir plus</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/equipe.jpg" alt="Illustration de l'équipe de l'association La Perche Tendue">
      <h3>Notre équipe</h3>
      <p>
        Bénévoles, partenaires et personnes engagées œuvrent ensemble pour accompagner au mieux les bénéficiaires 
        et faire vivre les actions de l’association au quotidien.
      </p>
      <a href="equipe.php" class="btn btn-sm">En savoir plus</a>
    </div>

    <div class="qui-item">
      <img src="assets/images/engagement.jpg" alt="Illustration de l'engagement de l'association">
      <h3>Notre engagement</h3>
      <p>
        Nous menons des actions concrètes pour répondre aux besoins essentiels, renforcer le lien social 
        et soutenir les parcours de vie avec bienveillance et proximité.
      </p>
      <a href="engagement.php" class="btn btn-sm">En savoir plus</a>
    </div>
  </div>
</section>

<?php include_once '../includes/footer.php'; ?>