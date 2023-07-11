jQuery(function ($) {
  /* -----------------------------------------
    Preloader
    ----------------------------------------- */
  $("#preloader").delay(1000).fadeOut();
  $("#loader").delay(1000).fadeOut("slow");

  /* -----------------------------------------
    rtl
    ----------------------------------------- */
  var isRTL = $('html').attr('dir') === 'rtl';

  /* -----------------------------------------
    Main Slider
    ----------------------------------------- */
  $(".banner-style-1 .banner-slider").slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    fade: true,
    rtl: isRTL,
    cssEase: "linear",
    prevArrow: "<button class='fa fa-chevron-left'</button>",
    nextArrow: "<button class='fa fa-chevron-right'</button>",
  });


  /* -----------------------------------------
    widget recent carousel
    ----------------------------------------- */
  $(".trending-post-carousel").slick({
    dots: false,
    vertical: true,
    verticalSwiping: true,
    speed: 1000,
    autoplay: 100,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    infinite: true,
  });

  /* -----------------------------------------
  toggle-button
  ----------------------------------------- */
  $(".menu-toggle").click(function () {
    $(this).toggleClass("show");
  });

  /* -----------------------------------------
  Keyboard Navigation
  ----------------------------------------- */
  $(window).on("load resize", function () {
    if ($(window).width() < 992 && $(window).width() >= 991) {
      $(".main-navigation").find("a").unbind("keydown");
      $(".main-navigation")
        .find("li")
        .last()
        .bind("keydown", function (e) {
          if (e.which === 9) {
            e.preventDefault();
            $("#masthead").find(".menu-toggle").focus();
          }
        });
    } else if ($(window).width() < 992) {
      $(".main-navigation").find("li").unbind("keydown");
      $(".main-navigation")
        .find("a")
        .last()
        .bind("keydown", function (e) {
          if (e.which === 9) {
            e.preventDefault();
            $("#masthead").find(".menu-toggle").focus();
          }
        });
    } else {
      $(".main-navigation").find("li").unbind("keydown");
      $(".main-navigation").find("a").unbind("keydown");
    }
  });

  var primary_menu_toggle = $("#masthead .menu-toggle");
  primary_menu_toggle.on("keydown", function (e) {
    var tabKey = e.keyCode === 9;
    var shiftKey = e.shiftKey;

    if (primary_menu_toggle.hasClass("show")) {
      if (shiftKey && tabKey) {
        e.preventDefault();
        $(".main-navigation").toggleClass("toggled");
        primary_menu_toggle.removeClass("show");
      }
    }
  });

  $(".header-search-wrap")
    .find(".search-submit")
    .bind("keydown", function (e) {
      var tabKey = e.keyCode === 9;
      if (tabKey) {
        e.preventDefault();
        $(".search-icon").focus();
      }
    });

  $(".search-icon").on("keydown", function (e) {
    var tabKey = e.keyCode === 9;
    var shiftKey = e.shiftKey;
    if ($(".header-search-wrap").hasClass("show")) {
      if (shiftKey && tabKey) {
        e.preventDefault();
        $(".header-search-wrap").removeClass("show");
        $(".search-icon").focus();
      }
    }
  });

  /* -----------------------------------------
header-search-bar
----------------------------------------- */
  var searchWrap = $(".header-search-wrap");
  $(".search-icon").click(function (e) {
    e.preventDefault();
    searchWrap.toggleClass("show");
    searchWrap.find("input.search-field").focus();
  });
  $(document).click(function (e) {
    if (!searchWrap.is(e.target) && !searchWrap.has(e.target).length) {
      $(".header-search-wrap").removeClass("show");
    }
  });

  /* -----------------------------------------
elite-blog-scroll-to-top-button
----------------------------------------- */

  var elite_blog_scroll_btn = $(".scroll-to-top");

  $(window).scroll(function () {
    if ($(window).scrollTop() > 400) {
      elite_blog_scroll_btn.addClass("show");
    } else {
      elite_blog_scroll_btn.removeClass("show");
    }
  });

  elite_blog_scroll_btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      "300"
    );
  });
});
