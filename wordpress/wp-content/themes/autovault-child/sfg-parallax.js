/* SFG Jarallax init — runs on every page load and after Elementor frontend init */
(function () {
  function initSfgParallax() {
    if (typeof jarallax === 'undefined') return;

    /* Any element carrying data-sfg-parallax gets jarallax treatment */
    document.querySelectorAll('[data-sfg-parallax]').forEach(function (el) {
      var speed  = parseFloat(el.getAttribute('data-sfg-speed') || '0.4');
      var imgUrl = el.getAttribute('data-sfg-parallax');

      /* Set the background so Elementor doesn't clobber it */
      if (imgUrl) {
        el.style.backgroundImage = 'url(' + imgUrl + ')';
        el.style.backgroundSize  = 'cover';
      }

      jarallax(el, { speed: speed, imgElement: false });
    });
  }

  /* Standard page load */
  document.addEventListener('DOMContentLoaded', initSfgParallax);

  /* Elementor frontend (for editor preview reload) */
  if (window.elementorFrontend) {
    window.elementorFrontend.hooks.addAction('frontend/element_ready/global', initSfgParallax);
  }
})();
