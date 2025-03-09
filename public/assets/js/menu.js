document.addEventListener("DOMContentLoaded", function () {
    var toggler = document.querySelector(".navbar-toggler");
    var navbarCollapse = document.querySelector(".navbar-collapse");

    toggler.addEventListener("click", function () {
        if (navbarCollapse.classList.contains("show")) {
            navbarCollapse.style.display = "none";
        } else {
            navbarCollapse.style.display = "block";
        }
    });
});
