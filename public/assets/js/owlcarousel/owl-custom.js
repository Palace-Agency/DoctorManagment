/**=====================
    Owl-carousel js Start
==========================**/

(function ($) {
  "use strict";
  var owl_carousel_custom = {
    init: function () {
      var owl = $("#owl-carousel-13");
      owl.owlCarousel({
        items: 5,
        loop: false,
        margin: 10,
        autoplay: false,
        nav: true,
        dots : false,
        
      }),
        $(".play").on("click", function () {
          owl.trigger("play.owl.autoplay", [1000]);
        }),
        $(".stop").on("click", function () {
          owl.trigger("stop.owl.autoplay");
        }),
        $("#owl-carousel-14").owlCarousel({
          items: 1,
          margin: 10,
          autoHeight: true,
          nav: false,
        });
      var owl = $("#owl-carousel-15");
      owl.owlCarousel({
        loop: true,
        nav: false,
        margin: 10,
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 3,
          },
          960: {
            items: 5,
          },
          1200: {
            items: 5,
          },
        },
      }),
        owl.on("mousewheel", ".owl-stage", function (e) {
          if (e.deltaY > 0) {
            owl.trigger("next.owl");
          } else {
            owl.trigger("prev.owl");
          }
          e.preventDefault();
        });
    },
  };

  owl_carousel_custom.init();
})(jQuery);

/**=====================
  Owl-carousel Ends
==========================**/
