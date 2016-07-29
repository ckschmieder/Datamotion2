

//------------------------------------------

// Youtube Player API

 // 2. This code loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.
  var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '100%',
      width: '100%',
      videoId: 'MP24gyjVuuM',
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      },
      playerVars: { 
       'autoplay': 0,
       'controls': 1, 
       'rel' : 0,
       'showinfo': 0
      }
    });
  }

  // 4. The API will call this function when the video player is ready.
  function onPlayerReady(event) {

  }

  // 5. The API calls this function when the player's state changes.
  //    The function indicates that when playing a video (state=1),
  //    the player should play for six seconds and then stop.
  var done = false;
  function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
      // setTimeout(stopVideo, 6000);
      done = true;
    }
  }
  function stopVideo() {
    player.stopVideo();
  }

// Initialize wow.js
jQuery(document).ready(function(){

var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       20,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);
wow.init();

});

// Remove animation from mobile menu buttons
$( ".mob-menu li" ).removeClass( "animated" );

// Set section width using jQuery

    /*jQuery( window ).load(function($) { 
    // jQuery(document).ready(function($) {

      var wide = ($("#main").width());
      jQuery(".home-section").height(wide * .44);

      jQuery(window).resize(function() {
        var wide = ($("#main").width());
        $(".home-section").height(wide * .44);
      });

    }); */

    // Enable tootips via bootstrap
      /*$(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });*/


  // Slick Carousel Settings
$('.gallery-responsive').slick({
  dots: false,
  accessibility: true,
  autoplay: true,
  infinite: true,
  speed: 500,
  arrows: false,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 920,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        arrows: false
      }
    },
    {
      breakpoint: 720,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        accessibility: true
      }
    },
    {
      breakpoint: 460,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: true
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});


// Typed.js settings

$(function() {
  $("#typed").typed({
    strings: ["reputation","bottom line","workflows"],
    typeSpeed: 90,
    backDelay: 2000,
    loop: true,
    callback: function(){}
  });
});
  