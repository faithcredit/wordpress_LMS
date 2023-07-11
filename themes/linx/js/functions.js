var body = jQuery('body');
var st = 0;
var navText = ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'];

window.lazySizesConfig = window.lazySizesConfig || {};
window.lazySizesConfig.loadHidden = false;

jQuery(function() {
  'use strict';

  retinaLogo();
  hero();
  featuredPosts();
  categoryBoxes();
  offCanvas();
  megaMenu();
  instagramSlider();
  gallery();
  explore();
  picks();
  fitVids();
  search();
  stickySidebar();
  like();
  bookmark();
  share();
  layout();
});

document.addEventListener('lazyloaded', function(e) {
  if (jQuery(e.target).parents('.hero').length || jQuery(e.target).hasClass('hero') || jQuery(e.target).hasClass('featured-wrapper')) {
    jQuery(e.target).jarallax({
      disableParallax: /iPad|iPhone|iPod|Android/,
      disableVideo: /iPad|iPhone|iPod|Android/,
      speed: 0.1,
    });
  }

  if (jQuery(e.target).parents('.entry-gallery').length) {
    jQuery(e.target).parents('.entry-gallery').trigger('refresh.owl.carousel');
  }
});

jQuery(window).on('load', function() {
  if (body.hasClass('with-masonry')) {
    jQuery('.posts-wrapper').masonry('layout');
  }
});

jQuery(window).on('scroll', function() {
  'use strict';

  if (body.hasClass('navbar-sticky') || body.hasClass('navbar-sticky_transparent')) {
    window.requestAnimationFrame(navbar);
  }

  window.requestAnimationFrame(heroContent);
});

function retinaLogo() {
  'use strict';

  var logoRegular = jQuery('.logo.regular');
  var logoContrary = jQuery('.logo.contrary');
  var mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';

  if (linxParams.logo_regular != '' && (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia(mediaQuery).matches))) {
    logoRegular.each(function(i, v) {
      jQuery(v).imagesLoaded(function() {
        jQuery(v).prop('width', jQuery(v).width());
        jQuery(v).prop('height', jQuery(v).height());
        jQuery(v).attr('src', linxParams.logo_regular);
      });
    });
  }

  if (linxParams.logo_contrary != '' && (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia(mediaQuery).matches))) {
    logoContrary.imagesLoaded(function() {
      logoContrary.prop('width', logoContrary.width());
      logoContrary.prop('height', logoContrary.height());
      logoContrary.attr('src', linxParams.logo_contrary);
    });
  }
}

function navbar() {
  'use strict';

  st = jQuery(window).scrollTop();
  var adHeight = jQuery('.ads.before_header').outerHeight() || 0;
  var stickyTransparent = jQuery('.navbar-sticky_transparent.with-hero, .navbar-sticky_transparent.with-featured-wrapper');
  var adsBeforeHeader = jQuery('.navbar-sticky.ads-before-header, .navbar-sticky_transparent.ads-before-header');

  if (st > 80 + adHeight) {
    stickyTransparent.addClass('navbar-translucent');
  } else {
    stickyTransparent.removeClass('navbar-translucent');
  }

  if (st > adHeight) {
    adsBeforeHeader.addClass('stick-now');
  } else {
    adsBeforeHeader.removeClass('stick-now');
  }
}

function hero() {
  'use strict';

  if (body.hasClass('with-hero')) {
    jQuery('.hero-full .hero').height(jQuery(window).height() - jQuery('.header-gap').height() - jQuery('#wpadminbar').height());

    if (jQuery('.hero-gallery .hero').length) {
      var galleryHero = jQuery('.hero-gallery .hero');
      galleryHero.imagesLoaded({ background: '.slider-item' }, function() {
        jQuery('.hero-slider').owlCarousel({
          animateOut: 'fadeOut',
          dots: false,
          items: 1,
          mouseDrag: false,
          nav: true,
          navText: navText,
          onInitialized: function(e) {
            jQuery('.hero-slider').find('.owl-item:nth-child(' + (e.item.index + 1) + ')').addClass('finished');
          },
          onTranslated: function(e) {
            jQuery('.hero-slider').find('.owl-item').removeClass('finished');
            jQuery('.hero-slider').find('.owl-item:nth-child(' + (e.item.index + 1) + ')').addClass('finished');
          },
          touchDrag: false,
        });
      });
    }
  }
}

function heroContent() {
  'use strict';

  st = jQuery(window).scrollTop();
  var element = jQuery('.hero-content');

  if (st <= 200) {
    element.each(function(i, v) {
      v.style.setProperty('--opacity', (200 - st) / 200);
      v.style.setProperty('--y', (st / 20) + 'px');   
    });
  } else {
    element.each(function(i, v) {
      v.style.setProperty('--opacity', 0);
      v.style.setProperty('--y', '10px');   
    });
  }
}

function featuredPosts() {
  'use strict';

  jQuery('.featured-posts.v1').owlCarousel({
    dots: false,
    items: 1,
    nav: true,
    navSpeed: 500,
    navText: navText,
  });

  jQuery('.featured-posts.v2').owlCarousel({
    autoHeight: true,
    dots: false,
    margin: 30,
    nav: true,
    navSpeed: 500,
    navText: navText,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      }
    },
  });

  jQuery('.featured-posts.v3').owlCarousel({
    dots: false,
    margin: 30,
    nav: true,
    navSpeed: 500,
    navText: navText,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });
}

function categoryBoxes() {
  'use strict';

  jQuery('.category-boxes').owlCarousel({
    dots: false,
    margin: 30,
    nav: true,
    navSpeed: 500,
    navText: navText,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });
}

function offCanvas() {
  'use strict';

  var hamburger = jQuery('.hamburger');
  var offCanvas = jQuery('.off-canvas');
  var close = offCanvas.find('.close');

  jQuery('.main-menu .nav-list').slicknav({
    label: '',
    prependTo: '.mobile-menu',
  });

  // jQuery('.site-content').find('.widget-area').clone().appendTo(offCanvas);

  var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
  if (isMobile) {
    jQuery('.site-content').find('.widget-area').appendTo(offCanvas);	
  }

  hamburger.on('click', function() {
    body.addClass('canvas-open');
  });

  close.on('click', function() {
    body.removeClass('canvas-open');
  });

  jQuery(document).keyup(function(e) {
    if (e.keyCode == 27 && body.hasClass('canvas-open')) {
      body.removeClass('canvas-open');
    }
  });

  jQuery(document).mouseup(function(e) {
    if (!offCanvas.is(e.target) && offCanvas.has(e.target).length === 0 && !hamburger.is(e.target) && hamburger.has(e.target).length === 0 && body.hasClass('canvas-open')) {
      body.removeClass('canvas-open');
    }
  });
}

function megaMenu() {
  'use strict';

  var options = {
    dots: false,
    items: 5,
    margin: 20,
    nav: true,
    navSpeed: 500,
    navText: navText,
    stagePadding: 20,
  };

  if (jQuery('.site-header').children('.container').length) {
    options.items = 4;
  }

  jQuery('.menu-posts').not('.owl-loaded').owlCarousel(options);
}

function instagramSlider() {
  'use strict';

  jQuery('.instagram-slider').find('.instagram-pics').not('.owl-loaded').addClass('owl-carousel').owlCarousel({
    dots: false,
    margin: 20,
    nav: true,
    navSpeed: 500,
    navText: navText,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 5,
      }
    },
    stagePadding: 20,
  });
}

function gallery() {
  'use strict';

  jQuery('.entry-gallery').not('.owl-loaded').owlCarousel({
    autoHeight: true,
    dots: false,
    items: 1,
    nav: true,
    navSpeed: 500,
    navText: navText,
  });
}

function explore() {
  'use strict';

  jQuery('.explore-posts').not('.owl-loaded').owlCarousel({
    dots: false,
    margin: 20,
    nav: true,
    navSpeed: 500,
    navText: navText,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      },
    },
  });
}

function picks() {
  'use strict';

  jQuery('.picked-posts').not('.owl-loaded').owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    autoplaySpeed: 500,
    autoplayTimeout: 3000,
    items: 1,
    loop: true,
  });
}

function fitVids() {
  'use strict';

  body.fitVids();
}

function search() {
  'use strict';

  var searchContainer = jQuery('.main-search');
  var searchField = searchContainer.find('.search-field');

  jQuery('.search-open').on('click', function() {
    body.addClass('search-open');
    searchField.focus();
  });

  jQuery(document).keyup(function(e) {
    if (e.keyCode == 27 && body.hasClass('search-open')) {
      body.removeClass('search-open');
    }
  });

  jQuery('.search-close').on('click', function() {
    if (body.hasClass('search-open')) {
      body.removeClass('search-open');
    }
  });

  jQuery(document).mouseup(function(e) {
    if (!searchContainer.is(e.target) && searchContainer.has(e.target).length === 0 && body.hasClass('search-open')) {
      body.removeClass('search-open');
    }
  });
}

function stickySidebar() {
  'use strict';

  var marginTop = 30;

  if (body.hasClass('navbar-sticky_transparent') || body.hasClass('navbar-sticky')) {
    marginTop += 70;
  }

  if (jQuery('#wpadminbar').length) {
    marginTop += 32;
  }

  jQuery('.site-content > .row > .col-lg-3').theiaStickySidebar({
    additionalMarginTop: marginTop,
    additionalMarginBottom: 30,
  });
}

function like() {
  'use strict';

  var postID, clickedElement;
  var element = jQuery('.like');

  jQuery.each(element, function(index, value) {
    if (Cookies.get('linx-like-' + jQuery(value).attr('data-id')) == '1') {
      jQuery(this).addClass('liked');
      jQuery(this).attr('title', linxParams.unlike_title);
    }
  });

  jQuery('.site-main').on('click', '.like', function(e) {
    e.preventDefault();
    postID = jQuery(this).attr('data-id');
    clickedElement = jQuery(this);

    clickedElement.addClass('liking');

    if (Cookies.get('linx-like-' + postID) == '1') {
      jQuery.ajax({
        type: 'POST',
        url: linxParams.admin_url,
        data: {
          action: 'linx_unlike',
          post_id: postID,
          nonce: linxParams.unlike_nonce
        },
        success: function(result) {
          Cookies.remove('linx-like-' + postID, { path: '/' });
          clickedElement.find('.count').text(result);
          clickedElement.removeClass('liking liked');
          clickedElement.attr('title', linxParams.like_title);
        }
      });
    } else {
      jQuery.ajax({
        type: 'POST',
        url: linxParams.admin_url,
        data: {
          action: 'linx_like',
          post_id: postID,
          nonce: linxParams.like_nonce
        },
        success: function(result) {
          Cookies.set('linx-like-' + postID, '1', { expires: 365, path: '/' });
          clickedElement.find('.count').text(result);
          clickedElement.removeClass('liking').addClass('liked');
          clickedElement.attr('title', linxParams.unlike_title);
        }
      });
    }
  });
}

function bookmark() {
  'use strict';

  jQuery('.site-content').on('click', '.bookmark', function(e) {
    e.preventDefault();
    popup(jQuery(this).attr('data-url'));
  });
}

function share() {
  'use strict';

  var modal = jQuery('.modal');
  var dimmer = jQuery('.dimmer');
  var modalThumbnail = modal.find('.modal-thumbnail').find('img');
  var modalTitle = modal.find('.modal-title');
  var modalFacebook = modal.find('.facebook');
  var modalTwitter = modal.find('.twitter');
  var modalPinterest = modal.find('.pinterest');
  var modalGoogle = modal.find('.google');
  var modalLinkedIn = modal.find('.linkedin');
  var modalReddit = modal.find('.reddit');
  var modalTumblr = modal.find('.tumblr');
  var modalVK = modal.find('.vk');
  var modalEmail = modal.find('.email');
  var modalPermalink = modal.find('.modal-permalink');
  var modalButton = modal.find('button');
  var modalIcon = modalButton.find('.mdi');
  var clickedElement;

  jQuery('.site-content').on('click', '.share', function(e) {
    e.preventDefault();
    clickedElement = jQuery(this);
    modalThumbnail.removeClass('lazyloaded').addClass('lazyload').attr('data-src', clickedElement.attr('data-thumbnail'));
    modalTitle.text(clickedElement.attr('data-title'));
    modalFacebook.attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(clickedElement.attr('data-url')));
    modalTwitter.attr('href', 'https://twitter.com/intent/tweet?text=' + escape(clickedElement.attr('data-title')) + '&url=' + encodeURIComponent(clickedElement.attr('data-url')));
    modalPinterest.attr('href', 'https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(clickedElement.attr('data-url')) + '&media=' + encodeURIComponent(clickedElement.attr('data-image')) + '&description=' + escape(clickedElement.attr('data-title')));
    modalGoogle.attr('href', 'https://plus.google.com/share?url=' + encodeURIComponent(clickedElement.attr('data-url')) + '&text=' + escape(clickedElement.attr('data-title')));
    modalLinkedIn.attr('href', 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(clickedElement.attr('data-url')) + '&title=' + escape(clickedElement.attr('data-title')));
    modalReddit.attr('href', 'https://reddit.com/submit?url=' + encodeURIComponent(clickedElement.attr('data-url')) + '&title=' + escape(clickedElement.attr('data-title')));
    modalTumblr.attr('href', 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' + encodeURIComponent(clickedElement.attr('data-url')) + '&title=' + escape(clickedElement.attr('data-title')));
    modalVK.attr('href', 'http://vk.com/share.php?url=' + encodeURIComponent(clickedElement.attr('data-url')) + '&title=' + escape(clickedElement.attr('data-title')));
    modalEmail.attr('href', 'mailto:?subject=' + escape(clickedElement.attr('data-title')) + '&body=' + encodeURIComponent(clickedElement.attr('data-url')));
    modalPermalink.val(clickedElement.attr('data-url'));
    modalButton.attr('data-clipboard-text', clickedElement.attr('data-url'));
    modalIcon.removeClass('mdi-check').addClass('mdi-content-copy');
    modal.fadeIn('fast');
    dimmer.fadeIn('fast');
  });

  modalButton.on('click', function(e) {
    e.preventDefault();
    new ClipboardJS('.modal button');
    modalIcon.removeClass('mdi-content-copy').addClass('mdi-check');
  });

  dimmer.on('click', function() {
    modal.fadeOut(0);
    dimmer.fadeOut(0);
  });
}

function layout() {
  'use strict';

  var grid = jQuery('.posts-wrapper');
  var button = jQuery('.infinite-scroll-button');
  var options = {
    append: '.posts-wrapper > *',
    debug: false,
    hideNav: '.posts-navigation',
    history: false,
    path: '.posts-navigation .nav-previous a',
    prefill: true,
    status: '.infinite-scroll-status',
  };

  if (body.hasClass('with-masonry')) {
    grid = grid.masonry({
      columnWidth: '.grid-sizer',
      hiddenStyle: { opacity: 0, transform: 'translateY(20px)' },
      initLayout: false,
      itemSelector: '.grid-item',
      percentPosition: true,
      visibleStyle: { opacity: 1, transform: 'translateY(0)' },
    });
  
    grid.on('layoutComplete', function(event, laidOutItems) {
      jQuery(this).addClass('initialized');
    });

    grid.masonry();
    options.outlayer = grid.data('masonry');
  }

  if (body.hasClass('pagination-infinite_button')) {
    options.button = '.infinite-scroll-button';
    options.prefill = false;
    options.scrollThreshold = false;

    grid.on('request.infiniteScroll', function(event, path) {
      button.text(linxParams.infinite_loading);
    });

    grid.on('load.infiniteScroll', function(event, response, path) {
      button.text(linxParams.infinite_load);
    });
  }

  if ((body.hasClass('pagination-infinite_button') || body.hasClass('pagination-infinite_scroll')) && body.hasClass('paged-next') ) {
    grid.infiniteScroll(options);

    if (body.hasClass('layout-one')) {
      grid.on('append.infiniteScroll', function(event, response, path, items) {
        gallery();
        fitVids();
      });
    }
  }
}

function popup(url, title, w, h) {
  'use strict';

  title = title || '';
  w = w || 500;
  h = h || 300;

  var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
  var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

  var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
  var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

  var left = ((width / 2) - (w / 2)) + dualScreenLeft;
  var top = ((height / 2) - (h / 2)) + dualScreenTop;
  var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

  if (window.focus) {
    newWindow.focus();
  }
}