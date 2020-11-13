require('jquery.scrollex');
var app = {

  init: function () {
    console.log('init');

    // Scrollex
    app.$body = $('body');
    app.$carousel = $('.carou');
    app.$topmenu = $('.top__menu');
    app.enableScrollex();


    /* Lazyloading
    $('.slideshow').each(function(){
      var slideshow=$(this);
      var images=slideshow.find('.image').not('.is-loaded');
      images.on('loaded',function(){
        var image=$(this);
        var slide=image.closest('.slide');
        slide.addClass('is-loaded');
      });
    */

    // counter 
    var counted = 0;
    $(window).scroll(function () {

      var oTop = $('#counter').offset().top - window.innerHeight;
      if (counted == 0 && $(window).scrollTop() > oTop) {
        $('.count').each(function () {
          var $this = $(this),
            countTo = $this.attr('data-count');
          $({
            countNum: $this.text()
          }).animate({
              countNum: countTo
            },

            {

              duration: 2000,
              easing: 'swing',
              step: function () {
                $this.text(Math.floor(this.countNum));
              },
              complete: function () {
                $this.text(this.countNum);
                //alert('finished');
              }

            });
        });
        counted = 1;
      }

    });



    // smooth script 
    // Select all links with hashes
    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function (event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function () {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });

    // Mobile
    let openMenu = document.querySelector(".menu");
    let closeMenu = document.querySelector(".close");
    let overlay = document.querySelector(".overlay");

    openMenu.addEventListener("click", () => {
      overlay.classList.add("overlay--active");
    });

    closeMenu.addEventListener("click", () => {
      overlay.classList.remove("overlay--active");
    });



  },

  enableScrollex: function () {
    app.$carousel.scrollex({
      leave: app.setHeaderFixed,
      enter: app.setHeaderUnfixed
    })
  },

  setHeaderFixed: function () {
    console.log('fixe le carousel (ajout de la classe "fixed" sur le menu)');
    app.$topmenu.addClass('fixed');
  },

  setHeaderUnfixed: function () {
    console.log('défixe le carousel (on retire la classe "fixed" du menu');
    app.$topmenu.removeClass('fixed');
  }



};

$(app.init);