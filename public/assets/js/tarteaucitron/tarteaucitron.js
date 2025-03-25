
/* tarteaucitron.js - version simplifiée */
var tarteaucitron = {
  init: function (config) {
    console.log("TarteAuCitron initialisé avec la configuration :", config);
    tarteaucitron.config = config;
    // Simulation de la bannière cookie
    document.body.insertAdjacentHTML('beforeend', '<div id="tarteaucitron-banner" style="position:fixed;bottom:0;width:100%;background:#333;color:#fff;padding:10px;text-align:center;z-index:9999;">Ce site utilise des cookies. <button onclick="document.getElementById(\'tarteaucitron-banner\').remove()">OK</button></div>');
  },
  userInterface: {
    openPanel: function () {
      alert("Panneau de gestion des cookies ouvert");
    }
  }
};
