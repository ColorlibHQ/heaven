/**
 * Heaven front-end behaviour, without jQuery.
 *
 * The plugin calls keep the options they always had; ColorlibUI provides
 * drop-in versions of Owl Carousel, Slick, Magnific Popup, Masonry and
 * AjaxChimp that build the same markup, so the theme's stylesheets apply
 * unchanged. The map (gmap3 before) is drawn with the Google Maps API itself.
 */
(function () {
  'use strict';

  var UI = window.ColorlibUI;
  if (!UI) return;

  // niceSelect js code
  UI.enhanceSelects('select');

  UI.magnific('.popup-youtube, .popup-vimeo', {
    // disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });

  UI.slick('.banner_text', {
    vertical: true,
    verticalSwiping: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    arrows: true,
    autoplaySpeed: 3000,
    pauseOnHover: true,
    touchMove: true,
    prevArrow: '.prev',
    nextArrow: '.next'
  });

  // service_slider js code
  UI.owl('.service_slider', {
    items: 1,
    loop: true,
    dots: false,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    nav: true,
    smartSpeed: 2000,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>'
    ],
    responsive: {
      0: { nav: false },
      768: { nav: true },
      992: { nav: true }
    }
  });

  // project_slider js code
  UI.owl('.project_slider', {
    items: 1,
    loop: true,
    dots: false,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    nav: true,
    smartSpeed: 2000,
    navText: [
      '<i class="flaticon-left-arrow"></i>',
      '<i class="flaticon-right-arrow"></i>'
    ],
    responsive: {
      0: { nav: false },
      768: { nav: true },
      992: { nav: true }
    }
  });

  // blog_slider js code
  UI.owl('.single_page_special_item', {
    items: 4,
    loop: true,
    dots: false,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    nav: true,
    smartSpeed: 2000,
    navText: [
      '<i class="flaticon-left-arrow"></i>',
      '<i class="flaticon-right-arrow"></i>'
    ],
    responsive: {
      0: { nav: false, items: 1 },
      576: { items: 1 },
      768: { nav: true, items: 2 },
      992: { nav: true, items: 3 },
      1200: { nav: true, items: 3 }
    }
  });

  // The blog post slider shows "current/total".
  UI.ready(function () {
    function showCount(e) {
      var carousel = e.detail.relatedTarget;
      UI.toElements('.slider-counter').forEach(function (counter) {
        counter.textContent = carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length;
      });
    }
    UI.toElements('.blog_post_slider').forEach(function (el) {
      el.addEventListener('initialized.owl.carousel', showCount);
      el.addEventListener('changed.owl.carousel', showCount);
    });
    UI.owl('.blog_post_slider', {
      items: 1,
      loop: true,
      dots: false,
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      nav: true,
      smartSpeed: 2000,
      navText: [
        '',
        'NEXT'
      ]
    });
  });

  // map js code: the same map gmap3 drew, when the page has loaded the Maps API.
  UI.ready(function () {
    if (!window.google || !google.maps) return;
    UI.toElements('.map').forEach(function (el) {
      new google.maps.Map(el, {
        center: new google.maps.LatLng(40.740, -74.18),
        zoom: 12
      });
    });
  });

  // menu fixed js code
  window.addEventListener('scroll', function () {
    var fixed = window.pageYOffset + 1 > 50;
    UI.toElements('.main_menu').forEach(function (menu) {
      menu.classList.toggle('menu_fixed', fixed);
      menu.classList.toggle('animated', fixed);
      menu.classList.toggle('fadeInDown', fixed);
    });
  }, { passive: true });

  UI.ready(function () {
    // Search Toggle
    var box = document.getElementById('search_input_box');
    var open = document.getElementById('search_1');
    var close = document.getElementById('close_search');
    if (box) {
      box.style.display = 'none';
      if (open) {
        open.addEventListener('click', function () {
          UI.slide(box, 'toggle');
          var input = document.getElementById('search_input');
          if (input) input.focus();
        });
      }
      if (close) {
        close.addEventListener('click', function () {
          UI.slide(box, 'up', 500);
        });
      }
    }

    //memnu js
    function setMenu(open) {
      UI.toElements('.off-canven-menu, .offcanvas-overlay').forEach(function (el) {
        el.classList.toggle('active', open);
      });
    }
    UI.toElements('.menu-trigger').forEach(function (trigger) {
      trigger.addEventListener('click', function () { setMenu(true); });
    });
    UI.toElements('.close-icon i, .offcanvas-overlay').forEach(function (closer) {
      closer.addEventListener('click', function () { setMenu(false); });
    });
  });

  //gallery js
  UI.masonry('.grid', {
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });

  // Each .gallery is its own lightbox group.
  UI.ready(function () {
    UI.toElements('.gallery').forEach(function (gallery) {
      UI.magnific(gallery, {
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled: true
        }
      });
    });
  });

  //------- Mailchimp js --------//
  UI.ajaxChimp('#mc_embed_signup form');
}());
