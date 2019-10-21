jQuery(function() { 


    var map_theme =[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":60}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"lightness":30}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ef8c25"},{"lightness":40}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#b6c54c"},{"lightness":40},{"saturation":-40}]},{}];




       var mapcontainer = jQuery('#mapcontainer');
        mapcontainer.css({
            width : '100%',
            height : 700
        })

    
        geocoder = new google.maps.Geocoder();
       

      var myOptions = {
        zoom: 1,
        mapTypeControl: true,
        scrollwheel: false,
        draggable: false,
        navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: map_theme
      };
      var map = new google.maps.Map(mapcontainer.get(0), myOptions);

   
        geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location,
              title: 'Map'
          });
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
        });
 });

