/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  $.ajaxSetup({
    crossDomain: true,
    xhrFields: {
      withCredentials: true
    },
  });

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      finalize: function() {
        // Mobile menu listen
        $('#mobile-toggle').click(function(){
          $('body').toggleClass('blur menu-open');
        });
        if ($(window).width() < 700){
          $('.main-menu').on('click', 'a', function(){
            $('body').removeClass('blur menu-open');
          });
        }
        // Init accordions
        $('.accordion').on('click', '.trigger, h2', function(){
          $(this).parents('.section').toggleClass('open');
        });
        // Sign up form
        var $signupForm = $('#signup-modal');
        window.openSignup = function(e){
          if (e) e.stopPropagation();
          // FB tracking
          fbq('track', 'Lead', {value: '0.01', currency: 'CAD'});
          // Opening
          $('body').removeClass('blur menu-open');
          $signupForm.fadeIn('slow');
          $('html, body').animate({
            'scrollTop': 0
          });
        };
        window.closeSignup = function(e){
          var hash = window.location.hash.substring(1);
          if (e) e.stopPropagation();
          $signupForm.fadeOut('slow');
          if (hash === 'signup'){
            window.location.hash = '';
          }
        };
        $('.sign-up-trigger').on('click', window.openSignup);
        $signupForm.on('click', '.trigger', window.closeSignup);
        $('.modal').click(function(event){
          event.stopPropagation();
        });
        // Append indicators to sign up form
        $('#contact-form')
          .ajaxForm({
            target: '#contact-form-results',
          })
          .find('.contact-form-row')
          .append('<span class="indicator" />')
          .on('change input', 'input, select', function(e){
            var $sibling = $(this).next();
            if (this.type === 'email'){
              var isEmail = !! this.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
              $sibling.toggleClass('on', isEmail);
            } else {
              var isEmpty = this.value.length <= 0;
              $sibling.toggleClass('on', ! isEmpty);
            }
          });

        if(window.location.hash) {
          var hash = window.location.hash.substring(1);
          if (hash === 'signup'){
            window.openSignup();
          }
        }
      }
    },
    // Home page
    'home': {
      init: function() {
        var vimeoPlayers = $('#home-slider').find('iframe'), player;

        for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
            player = vimeoPlayers[i];
            $f(player).addEvent('ready', ready);

            var sliderHeight = $('#home-slider').height();
            $(player).height(sliderHeight);
        }

        function addEvent(element, eventName, callback) {
            if (element.addEventListener) {
              element.addEventListener(eventName, callback, false);
            } else {
              element.attachEvent(eventName, callback, false);
            }
          }

          function ready(player_id) {
            var froogaloop = $f(player_id);
            froogaloop.addEvent('play', function(data) {
              $('.flexslider').flexslider("pause");
            });
            froogaloop.addEvent('pause', function(data) {
              $('.flexslider').flexslider("play");
            });

          }

        $("#home-slider")
          .flexslider({
            slideshow: false,
            animation: "slide",
            useCSS: false,
            animationLoop: true,
            smoothHeight: true,
            controlNav: false,
            directionNav: true,
            prevText: "&lsaquo;",
            slideshowSpeed: 100000,
            nextText: "&rsaquo;",
            pauseOnHover: true,
            video: true,
            before: function(slider){
              if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0){
                $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
              }
            },
            after: function(slider){
              if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0){
                $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('play');
                $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('setVolume', 0);
              }

              $('.flex-active-slide').on('click', function(){
                if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0)
                  $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');
              });
            }
          });

        var $teamModal = $('#team-member-modal');
        $teamModal.on('click', '.trigger', function(){
          $teamModal.addClass('fade-out');
        });
        $('.team-member').on('click', function(){
          var data = $(this).data();
          $teamModal.removeClass('fade-out');
          $('#team-member-modal-name').html(data.name);
          $('#team-member-modal-desc').html(data.desc);
        });

        var $emailModal = $('#email-modal');
        if ($emailModal.length < 1) { return false; }
        // Short circuit if not exists
        setTimeout(function(){
          if (! $.cookie('bang_closed_modal')){
            $emailModal.removeClass('fade-out');
          }
        }, 3000);
        $emailModal
          .one('click', '.trigger', function(){
            $emailModal.addClass('fade-out');
            $.cookie('bang_closed_modal', 'true', { expires: 7 });
          });

      },
      finalize: function() {
      }
    },
    // About us page, note the change from about-us to about_us.
    'contact': {
      finalize: function() {
        var styles = [
          {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#fec10d"
              },
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "administrative",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "administrative.locality",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
              {
                "color": "#fec10d"
              }
            ]
          },
          {
            "featureType": "landscape",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "color": "#ce9f12"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "on"
              },
              {
                "color": "#fec10d"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "off"
              },
              {
                "color": "#feea0a"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
              {
                "saturation": -100
              },
              {
                "lightness": 45
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#353230"
              },
              {
                "weight": "7.23"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#fec10d"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
              {
                "color": "#917001"
              },
              {
                "visibility": "on"
              }
            ]
          }
        ];
        var locations = [
          ['Show Group', 'undefined', 'undefined', 'undefined', 'undefined', 43.647579, -79.405900]
        ];
        var mapOptions = {
          center: new google.maps.LatLng(locations[0][5], locations[0][6]),
          zoom: 16,
          zoomControl: false,
          disableDefaultUI: true,
          disableDoubleClickZoom: true,
          mapTypeControl: false,
          scrollwheel: false,
          panControl: false,
          streetViewControl: false,
          scaleControl: false,
          draggable: true,
          overviewMapControl: false,
          zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT,
          },
          mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
          },
          overviewMapControlOptions: {
            opened: false,
          },
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        };
        var map = new google.maps.Map($('#contact-map')[0], mapOptions);
        // JavaScript to be fired on the about us page
        var markerImage = {};
        var markerImageUrl = '/wp-content/themes/bangfitness/dist/images/mappointer.png';
        var markerImageSize = new google.maps.Size(36, 41);
        if (window.devicePixelRatio > 1){
          markerImageUrl = '/wp-content/themes/bangfitness/dist/images/mappointer@2x.png';
          markerImageSize = new google.maps.Size(72, 82);
        }
        markerImage = {
          url: markerImageUrl,
          size: markerImageSize,
          scaledSize: new google.maps.Size(36, 41),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 10)
         };
        var marker = new google.maps.Marker({
          icon: markerImage,
          position: new google.maps.LatLng(locations[0][5], locations[0][6]),
          map: map,
          title: locations[0][0],
          desc: '',
          tel: '',
          email: '',
          web: ''
        });
        map.setOptions({styles: styles});
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.