jQuery(function () {
  //	'use strict';

  // DOM ready, take it away
  if (typeof macaroon_fadeout_time == "undefined") {
    macaroon_fadeout_time = 10000;
  }

  var $macaroon = jQuery(".macaron");
  setTimeout(() => {
    $macaroon.animate({ opacity: 0 }, 1000, () => {
      $macaroon.hide();
    });
  }, macaroon_fadeout_time);

  var $window = jQuery(window);

  var $window_width = $window.width();
  var $window_height = $window.height();
  var $mobile_width = 768; // #BOOTSTRAP MOBILE WIDTH

  jQuery(".plus").on("click", function () {
    var $myClass = jQuery(this).attr("class").split(" ")[1];
    $tdmycl = jQuery("td#" + $myClass);
    var $shouldHide = $tdmycl.is(":visible");

    jQuery(".desc_td").hide();

    if (!$shouldHide) {
      $tdmycl.show();
    }
  });

  function resizeEverything() {
    jQuery(".slidepart").matchHeight();
  }

  function sectionheight($height) {
    var $tabheight = jQuery(".maps_tabs").height();
    var $layernavheight = jQuery(".map_layers_nav").height();

    var $stackheight = jQuery("img.layer_null").height();
    // var $stackheight = 100;
    // console.log($stackheight);
    // jQuery('#cartes').css({
    // 	'height': $stackheight + $tabheight + $layernavheight
    // })
    jQuery(".map_layers").css({
      height: $stackheight,
    });
    jQuery("#map").css({
      height: $stackheight,
    });

    // jQuery('section').css({
    // 	'min-height': $height
    // });
    // jQuery('.fullimg').css({
    // 	'min-height': $height
    // });
    // jQuery('.left_slidies').css({
    // 	'min-height': $height
    // });
    // jQuery('.bx-viewport').css({
    // 	'min-height': $height
    // });

    // jQuery('.titlesection').css({
    // 	'min-height': $height - 120
    // });

    // var $mapheights = $height - jQuery('.maps_tabs').outerHeight();

    // jQuery('.layers_stack').css({
    // 	'height': $mapheights
    // });
    // jQuery('.map_layers').css({
    // 	'height': $mapheights
    // });
    // jQuery('#map').css({
    // 	'height': $mapheights
    // });
  }
  sectionheight();

  function left_slidies() {
    jQuery(".left_slidies").each(function () {
      var $this = jQuery(this);
      var $indent = -$this.outerWidth();
      $this.children(".left_slidies_arrow").on("click", function () {
        if ($this.hasClass("open")) {
          $this.animate({ left: $indent }, 600);
          $this.removeClass("open");
        } else {
          $this.animate({ left: 0 }, 600);
          $this.addClass("open");
        }
      });
    });
  }

  left_slidies();

  // function left_slidies(){
  // 	jQuery('.left_slidies_arrow').on('click', function(){
  // 	var $this = jQuery(this).parent();
  // 	var $indent = -$this.outerWidth();
  // 		if($this.hasClass('open')){
  // 	   		$this.animate({'left' : $indent }, 600);
  // 	   		$this.removeClass('open');
  // 	   	}
  // 	   	else {
  // 	   		$this.animate({'left' : 0}, 600);
  // 		   	$this.addClass('open');
  // 	   	}
  // 	})

  // }

  // jQuery(window).on('resize', function(){
  // 	var $window = jQuery(window);
  // 	var $window_height = $window.height();
  //     sectionheight($window_height);
  // });

  function resizecolumns() {
    jQuery(".two_columns").each(function () {
      jQuery(".col_match").matchHeight();
    });
  }
  resizecolumns();
  jQuery(window).on("resize", function () {
    resizecolumns();
  });

  function makeSliders() {
    jQuery(".bxslider").each(function () {
      var $this = jQuery(this);
      var slider_has_many_children =
        $this.children("li").length > 1 ? true : false;

      var adaptiveheight = true;
      if ($this.data("adaptiveheight") == false) {
        adaptiveheight = false;
      }
      var slider = $this.bxSlider({
        auto: slider_has_many_children,
        pager: false,
        controls: slider_has_many_children,
        mode: "fade",
        autoHover: false,
        adaptiveHeight: adaptiveheight,
        speed: "2000",

        onSlideAfter: function ($slideElement, oldIndex, newIndex) {
          jQuery(".active-slide", $this).removeClass("active-slide");
          $slideElement.addClass("active-slide");
        },
        onSliderLoad: function () {
          jQuery(".bxslider > li").eq(1).addClass("active-slide");
        },
      });
      // var $bxcount = jQuery(".bx-pager").children().length;
      // 	if ($bxcount == 1) {jQuery('.bx-pager-item').hide();};
    });
  }

  function minHeightForSection() {
    jQuery("section").addClass("min_heightvh");
  }

  // SHOW WELCOME SCREEN
  jQuery("html, body").css({
    overflow: "hidden",
    height: "100%",
  });

  setTimeout(init, 200);

  setTimeout(function () {
    jQuery("html, body").css({
      overflow: "auto",
      height: "auto",
    });
    jQuery(".loader").hide();
  }, 3000);

  if ($window_width > $mobile_width) {
  }

  function init() {
    console.log("init");

    //if( $window_width < $mobile_width   ){
    // }

    // used to be for just desktop users, but now everyone gets video
    setVideo();

    if (typeof window.orientation !== "undefined") {
      /// THIS IS FOR MOBILE USERS
      //jQuery('.situation_maps').hide();
      jQuery("#amenities_map_layers").hide();
      jQuery("#globalmap").click();
      jQuery(".maps_tabs").hide();
      jQuery(".map_layers_nav").hide();
      jQuery("section.fullimg.titlesection").css({
        "background-attachment": "scroll",
      });
    } else {
      // THIS IS FOR DESKTOP USERS
      setAmenitiesMap();
      makeSliders();
      minHeightForSection();
      jQuery(".globalmap").addClass("invisible");

      // if no amenities map, show google mao
      if (jQuery("#amenites").length == 0) {
        jQuery("#globalmap").click();
      }
    }

    // var $window = jQuery(window);
    // var $window_width = $window.width();
    // sectionheight($window_height);
  }

  jQuery("#show_nav_button").on("click", function (e) {
    e.preventDefault();
    jQuery("header nav ul").toggleClass("navVisible");
  });

  // resizeEverything()
  // jQuery('.slidepart').matchHeight();

  jQuery(".partnerlogos").on("click", function (e) {
    e.preventDefault();
    var $this = jQuery(this);
    var $href = $this.attr("href");
    jQuery(".partnerdescription").hide();
    jQuery($href).show();
    jQuery(".partnerlogos").removeClass("visible_partner");
    $this.addClass("visible_partner");
  });

  // animate sliding down page to furniture section
  // $furniture_containers.on('click', function(e){
  jQuery("nav ul a, .rdv").on("click", function (e) {
    e.preventDefault();

    var $this = jQuery(this);
    var $href = $this.attr("href");
    var $hash = $href.split("#")[1];
    jQuery("header nav ul").removeClass("navVisible");

    if (typeof $hash !== "undefined") {
      var $location = jQuery("#" + $hash);
      if ($location.length > 0) {
        jQuery("html, body").animate(
          { scrollTop: $location.offset().top - 80 },
          1000
        );
      } else {
        window.location.href = $href;
      }
    } else {
      window.location.href = $href;
    }
  });

  jQuery(".person_chooser").on("click", function (e) {
    e.preventDefault();
    var $this = jQuery(this);
    var $person = $this.data("person");

    jQuery("#person_type").val($person);

    jQuery(".person_chooser").removeClass("selected_person");
    $this.addClass("selected_person");

    if ($person == "acheteur") {
      jQuery(".group_for_acheteur").show();
      jQuery(".group_for_courtier").hide();
    } else {
      jQuery(".group_for_acheteur").hide();
      jQuery(".group_for_courtier").show();
    }
  });

  // var $next_thing_after_nav = jQuery('#next_thing_after_nav');

  //  var $head_height = $header.outerHeight();
  // // 	 var $head_y_pos = $header.offset().top;
  //  var $head_y_pos = $window_height  - $head_height;
  //  var $head_fixed = false;

  var $header = jQuery("#header");
  var scroll_pos_prev = -1;
  // var $navigation_cont = jQuery('header .navigation');

  $window.on("scroll", function () {
    var scroll_pos = $window.scrollTop();

    // if ( (scroll_pos > ($window_height + 100) )  && (scroll_pos < scroll_pos_prev)  ) {
    if (scroll_pos > $window_height + 100) {
      $header.addClass("fixed");
    } else {
      $header.removeClass("fixed");
    }

    scroll_pos_prev = scroll_pos;

    // if (  scroll_pos >= $head_y_pos  && $head_fixed == false    ) {
    // 	$header.addClass('fixed');
    // 	$next_thing_after_nav.css({'margin-top' : $head_height  });
    // 	$head_fixed = true;
    // }

    // if (  scroll_pos < $head_y_pos  &&    $head_fixed == true        )  {
    // 	$header.removeClass('fixed');
    // 	$next_thing_after_nav.css({'margin-top' :  0  });
    // 	$head_fixed = false;

    // 	// recalculate headypost
    // 	 $window_height = $window.height();
    // 	 $head_height = $header.outerHeight();
    // 	 $head_y_pos = $window_height  - $head_height;
    // }
  });

  jQuery(".nav_button").on("click", function () {
    var $this = jQuery(this);
    var $id = $this.attr("id");
    // $this.toggleClass('active');
    jQuery("." + $id).toggle();
  });

  jQuery(".map_layers_nav span").on("click", function () {
    jQuery(this).toggleClass("active");
  });

  //jQuery('.map_layers_nav').matchHeight();

  jQuery("#amenites").on("click", function () {
    jQuery(this).addClass("active");
    jQuery("#globalmap").removeClass("active");
    jQuery(".amenites").removeClass("invisible");
    jQuery(".globalmap").addClass("invisible");
    jQuery(".mapsidebar").hide();
  });
  jQuery("#globalmap").on("click", function () {
    jQuery(this).addClass("active");
    jQuery("#amenites").removeClass("active");
    jQuery(".globalmap").removeClass("invisible");
    jQuery(".amenites").addClass("invisible");

    initMap();
  });

  jQuery("#courtier").on("click", function () {
    jQuery(".courtier").show();
    jQuery(".acheteur").hide();
    jQuery("#courtier").addClass("active");
    jQuery("#acheteur").removeClass("active");
  });
  jQuery("#acheteur").on("click", function () {
    jQuery(".acheteur").show();
    jQuery(".courtier").hide();
    jQuery("#acheteur").addClass("active");
    jQuery("#courtier").removeClass("active");
  });
});

var map;
var markers = [];

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 13,
    scrollwheel: false,
    draggable: !("ontouchend" in document),
    styles: [
      {
        featureType: "all",
        stylers: [{ saturation: -80 }],
      },
      {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [{ hue: "#00ffee" }, { saturation: 50 }],
      },
      {
        featureType: "road.arterial",
        elementType: "labels",
        stylers: [{ visibility: "off" }],
      },
      {
        featureType: "road.highway",
        elementType: "labels",
        stylers: [{ visibility: "off" }],
      },
      {
        featureType: "poi.business",
        elementType: "labels",
        stylers: [{ visibility: "off" }],
      },
    ],
  });

  map.addListener("click", function () {
    jQuery(".mapsidebar").hide();
  });

  var iconBase =
    "https://praemium-re.com//wp-content/themes/praemium_mini/img/icons/";
  var icons = {
    bibliotheque: {
      icon: {
        url: iconBase + "icone_bibliotheque_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    centreloisirs: {
      icon: {
        url: iconBase + "icone_centreloisirs_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    commerce: {
      icon: {
        url: iconBase + "icone_commerce_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    ecole: {
      icon: {
        url: iconBase + "icone_ecole_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    parc: {
      icon: {
        url: iconBase + "icone_jardin_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    parking: {
      icon: {
        url: iconBase + "icone_parking_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    pharmacie: {
      icon: {
        url: iconBase + "icone_pharmacie_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    sport: {
      icon: {
        url: iconBase + "icone_sport_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    transport: {
      icon: {
        url: iconBase + "icone_transport_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    projet: {
      icon: {
        url: iconBase + "icone_projet_etoile.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    yellow_circle: {
      icon: {
        url: iconBase + "icone_jeune.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    blue_circle: {
      icon: {
        url: iconBase + "icone_bleu.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    green_circle: {
      icon: {
        url: iconBase + "icone_vert.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
    red_circle: {
      icon: {
        url: iconBase + "icone_rouge.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(15, 15), // anchor
      },
    },
  };

  var infowindow = new google.maps.InfoWindow();

  var all_loc_cats = locations.map((l) => l[3]);
  var loc_cats = [];
  all_loc_cats.forEach((lc) => {
    if (!loc_cats.includes(lc)) {
      loc_cats.push(lc);
    }
  });

  var $loc_cats_container = $("#loc_cats_container");
  $loc_cats_container.empty();
  loc_cats.forEach((lc) => {
    const node = document.createElement("SPAN");
    node.classList.add("active");
    node.innerHTML = translateCategory(lc);
    node.addEventListener("click", (e) => {
      toggleCategory(lc);
    });
    $loc_cats_container.append(node);
  });

  var marker, i;

  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
      category: locations[i][3],
      icon: icons[locations[i][3]].icon,
      content: locations[i][0],
    });
    google.maps.event.addListener(
      marker,
      "click",
      (function (marker, i) {
        return function () {
          // infowindow.setContent(locations[i][0]);
          // infowindow.setOptions({maxWidth:300});
          // infowindow.open(map, marker);
          jQuery("#markercontent").html(marker.content);
          jQuery(".mapsidebar").show();
        };
      })(marker, i)
    );

    markers.push(marker);
  }
}

function toggleCategory(category) {
  for (var i = 0; i < markers.length; i++) {
    marker = markers[i];
    if (marker.category == category) {
      marker.setVisible(!marker.visible); // if visible hide, if hidden show.
    }
  }
}

function translateCategory(cat) {
  if (cat == "transport") {
    return `Transports`;
  } else if (cat == "ecole") {
    return `Ecoles`;
  } else if (cat == "parc") {
    return `Parcs`;
  } else if (cat == "commerce") {
    return `Commerces`;
  } else if (cat == "parking") {
    return `Parkings`;
  } else if (cat == "sport") {
    return `Centre Sportif`;
  } else if (cat == "centreloisirs") {
    return `Centre de Loisirs`;
  } else if (cat == "bibliotheque") {
    return `Bibliothèques`;
  } else if (cat == "pharmacie") {
    return `Pharmacies`;
  } else {
    return cat;
  }
}

function setVideo() {
  var $video = jQuery("#vidbg");
  var $mobile_vidbg = jQuery("#mobile_vidbg");

  if (typeof video_mp4 != "undefined" && video_mp4 != "") {
    $video.append('<source src="' + video_mp4 + '" />');
    $mobile_vidbg.append('<source src="' + video_mp4 + '" />');
  }
  if (typeof video_ogv != "undefined" && video_ogv != "") {
    $video.append('<source src="' + video_ogv + '" />');
    $mobile_vidbg.append('<source src="' + video_ogv + '" />');
  }

  var video = document.querySelector("video");
  video.play();
}

// // get the video
// var video = document.querySelector('video');
// // use the whole window and a *named function*
// window.addEventListener('touchstart', function videoStart() {
//   video.play();
//   console.log('first touch');
//   // remove from the window and call the function we are removing
//   this.removeEventListener('touchstart', videoStart);
// });
function setmapsectionheight() {
  var idealheight = jQuery("img.layer_null").height();
  console.log(idealheight);
}

function setAmenitiesMap() {
  if (typeof $amenities_layers != "undefined") {
    $map_layers = jQuery("#amenities_map_layers");
    for (var i = 0; i < $amenities_layers.length; i++) {
      var layer = $amenities_layers[i];
      var img =
        '<img class="layers_stack layer_' +
        layer.label +
        '" src="' +
        layer.src +
        '" style="position:absolute; left:0;width:100%; height:auto;" />';
      $map_layers.append(img);

      setmapsectionheight();
    }
  }
}
