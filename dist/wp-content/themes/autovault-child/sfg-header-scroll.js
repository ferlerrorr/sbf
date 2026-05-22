(function () {
    var header = document.getElementById('reactheme-header');
    if (!header) return;

    var scrolled = false;
    var threshold = 40;

    function setHeaderHeight() {
        document.documentElement.style.setProperty('--sfg-header-h', header.offsetHeight + 'px');
    }

    function update() {
        var y = window.scrollY || window.pageYOffset;
        var shouldScroll = y > threshold;
        if (shouldScroll !== scrolled) {
            scrolled = shouldScroll;
            header.classList.toggle('sfg-header-scrolled', scrolled);
        }
    }

    // Re-measure after collapse/expand animation finishes
    header.addEventListener('transitionend', function (e) {
        if (e.target.classList.contains('sfg-topbar-row') || e.target.classList.contains('sfg-header-divider')) {
            setHeaderHeight();
        }
    }, { passive: true });

    setHeaderHeight();
    window.addEventListener('resize', setHeaderHeight, { passive: true });
    window.addEventListener('scroll', update, { passive: true });
    update();
})();
