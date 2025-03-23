<?php include_once '../includes/header.php'; ?>

<!-- SECTION : SERVICES EN 1 CLIC -->
<section class="services container">
  <h2 class="text-center">« NOS SERVICES EN 1 CLIC »</h2>
  <div class="services-grid">
    <div class="service">
      <a href="#">
        <img src="assets/images/actu1.jpg" alt="Activités">
        <p>« NOS ACTIVITÉS »</p>
      </a>
    </div>
    <div class="service">
      <a href="#">
        <img src="assets/images/actu2.jpg" alt="Événements">
        <p>« NOS ÉVÈNEMENTS »</p>
      </a>
    </div>
    <div class="service">
      <a href="epicerie.php">
        <img src="assets/images/epicerie.jpg" alt="Épicerie">
        <p>« ÉPICERIE SOLIDAIRE »</p>
      </a>
    </div>
  </div>
</section>

<!-- SECTION : ACTUALITÉS -->
<section class="actualites container">
  <h2 class="text-center">« NOS ACTUALITÉS »</h2>
  <div class="actualites-grid">
    <a href="documents/actu1.pdf" class="actualite">
      <img src="assets/images/actu1.jpg" alt="Actu 1">
      <h3>« LES ACTIVITÉS »</h3>
      <p>« Lorem ipsum dolor sit amet consectetur adipisicing elit... »</p>
    </a>
    <a href="documents/festival.pdf" class="actualite">
      <img src="assets/images/festival.jpg" alt="Festival">
      <h3>« FESTIVAL EUROPALIA »</h3>
      <p>« Les activités durant ce festival... avec des expositions. »</p>
    </a>
    <a href="documents/parade.pdf" class="actualite">
      <img src="assets/images/parade.jpg" alt="Parade">
      <h3>« PARADE NIGÉRIENNE »</h3>
      <p>« Tous les deux ans... pour libérer l’Empire lointain. »</p>
    </a>
  </div>
</section>

<!-- SECTION : TOUTES NOS ACTUALITÉS -->
<section class="actualites-toutes">
  <h3 class="text-center bg-dark text-white">TOUTES NOS ACTUALITÉS</h3>
</section>

<!-- SECTION : #PERCHE TENDUE -->
<section class="perche-section container">
  <h2 class="text-center text-blue">« #PERCHE TENDUE »</h2>
  <div class="perche-grid">
    <div class="perche-item">
      <img src="assets/images/perche1.jpg" alt="Perche 1">
      <p>« 2022-09-01 »</p>
      <a class="btn btn-primary" href="documents/perche1.pdf">Télécharge</a>
    </div>
    <div class="perche-item">
      <img src="assets/images/perche2.jpg" alt="Perche 2">
      <p>« 2022-09-07 »</p>
      <a class="btn btn-primary" href="documents/perche2.pdf">Télécharge</a>
    </div>
    <div class="perche-item">
      <img src="assets/images/perche3.jpg" alt="Perche 3">
      <p>« 2022-10-01 »</p>
      <a class="btn btn-primary" href="documents/perche3.pdf">Télécharge</a>
    </div>
  </div>
</section>

<!-- STYLE SPÉCIFIQUE -->
<style>
  /* Zoom au survol des images */
  .actualite img:hover,
  .perche-item img:hover,
  .services-grid .service img:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
  }
</style>

<?php include_once '../includes/footer.php'; ?>
