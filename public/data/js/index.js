$(document).ready(function(){
  // Add smooth scrolling to all links
  $(".toggleSection").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
    
  });
});


$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});



$(window).scroll(function(){
  if ($(window).scrollTop() >= 70) {
      $('.moviesNav').addClass('sticky-top');
  }
  else {
      $('.moviesNav').removeClass('sticky-top');
  }
});

$('.navbar-nav>li>a').on('click', function(){
  $('.navbar-collapse').collapse('hide');
});


var owl = $('.owl-carousel');
owl.owlCarousel({
    mouseDrag: false,
    loop:false,
    nav:false,
    dots: false,
    margin:10,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },            
        960:{
            items:3
        },
        1200:{
            items:4
        }
    }
});
// owl.on('mousewheel', '.owl-stage', function (e) {
//     if (e.deltaY>0) {
//         owl.trigger('next.owl', [3000]);
//     } else {
//         owl.trigger('prev.owl', [3000]);
//     }
//     e.preventDefault();
// });

$('.owl-next').click(function() {
    owl.trigger('next.owl.carousel');
})
// Go to the previous item
$('.owl-prev').click(function() {
    // With optional speed parameter
    // Parameters has to be in square bracket '[]'
    owl.trigger('prev.owl.carousel', [300]);
})

  $(document).ready(function(){
    // Add smooth scrolling to all links
    $("moviesNav a.nav-link").on('click', function(event) {

      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 500, function(){

          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
    });
  });

