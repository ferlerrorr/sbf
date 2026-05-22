(function ($) {
    "use strict";

    $('#de-loader ').prepend($('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'));
    $(window).on('load', function () {
        setTimeout(function () {
            $('#de-loader').fadeOut(300);
        }, 100);
    });
    $(document).ready(function () {
        $(".menu-button, .close-button").on('click', function () {
            event.preventDefault();
            $(".nav-toggle, .menu-ofcn, .close-button, body").toggleClass("off-open");
        });
        $("ul.children").addClass("sub-menu");

        // top to bottom 
        var totop = $('#rt-top-to-bottom');
        function handleScroll(scrollValue) {
            if (scrollValue > 150) {
                totop.fadeIn();
                $('.rts_header__switch').addClass('btt__enable');
                $('#rt-top-to-bottom').addClass('scroll_visible');
            } else {
                totop.fadeOut(400);
                $('.rts_header__switch').removeClass('btt__enable');
                $('#rt-top-to-bottom').removeClass('scroll_visible');
            }
        }
        if (typeof lenis !== 'undefined') {
            lenis.on('scroll', (e) => {
                handleScroll(e.animatedScroll);
            });
        } else {
            $(window).on('scroll', function () {
                handleScroll($(window).scrollTop());
            });
        }
        totop.on('click', function (e) {
            e.preventDefault();
            if (typeof lenis !== 'undefined') {
                lenis.scrollTo(0, { duration: 1.2 });
            } else {
                $("html, body").animate({ scrollTop: 0 }, 500);

            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const offcanMenu = document.querySelector('.menu-area-addon-offcan');
        if (!offcanMenu) return;

        // Add arrow span to parent menu items
        const menuItems = offcanMenu.querySelectorAll('.menu-item-has-children');
        menuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && !item.querySelector('.rtd-arrow')) {
                const arrow = document.createElement('span');
                arrow.classList.add('rtd-arrow');
                arrow.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z"></path></svg>';
                link.appendChild(arrow);

                // toggle submenu on arrow click
                arrow.addEventListener('click', function (e) {
                    e.preventDefault();
                    const subMenu = item.querySelector('.sub-menu');
                    if (subMenu) {
                        if (subMenu.classList.contains('sub-open')) {
                            subMenu.style.maxHeight = null;
                            subMenu.style.opacity = '0';
                            link.classList.remove('rt-open');
                            subMenu.classList.remove('sub-open');
                        } else {
                            subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
                            subMenu.style.opacity = '1';
                            link.classList.add('rt-open');
                            subMenu.classList.add('sub-open');
                        }
                    }
                });
            }
        });
    });

    // Canvas Menu Js
    $(".nav-link-container > a").off("click").on("click", function (event) {
        event.preventDefault();
        $(".nav-link-container").toggleClass("nav-inactive-menu-link-container");
        $(".mobile-menus").toggleClass("nav-active-menu-container");
    });

    $(".nav-close-menu-li > a").on('click', function (event) {
        $(".mobile-menus").toggleClass("nav-active-menu-container");
        $(".content").toggleClass("inactive-body");
    });

})(jQuery);