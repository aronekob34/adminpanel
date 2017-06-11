	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
			$center_coord_arr = $this->be_model->get_center_coord_users($data['users']);
		?>
		<div id="map" style="width:800px; height: 400px;"></div>
   <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script>
    // Define your locations: HTML content for the info window, latitude, longitude
    var locations = [
      <?php
      $i = 0;
      foreach($data['users'] as $item) {
      	if($i > 0) echo ',';
      	
      	echo '[\'<h4>' . $item['user_full_name'] . '</h4>\', ' . $item['user_location_latitude'] . ', ' . $item['user_location_longitude'] . ']';
      	$i++;
      }
      ?>
      //['<h4>Bondi Beach</h4>', -33.890542, 151.274856],

    ];
    
    // Setup the different icons and shadows
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
      iconURLPrefix + 'red-dot.png',
      iconURLPrefix + 'green-dot.png',
      iconURLPrefix + 'blue-dot.png',
      iconURLPrefix + 'orange-dot.png',
      iconURLPrefix + 'purple-dot.png',
      iconURLPrefix + 'pink-dot.png',      
      iconURLPrefix + 'yellow-dot.png'
    ]
    var iconsLength = icons.length;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom : 30,
      center: new google.maps.LatLng(<?php echo $center_coord_arr[0]; ?>, <?php echo $center_coord_arr[1]; ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 160
    });

    var markers = new Array();
    
    var iconCounter = 0;
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: icons[iconCounter]
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      // We only have a limited number of possible icon colors, so we may have to restart the counter
      if(iconCounter >= iconsLength) {
      	iconCounter = 0;
      }
    }

    function autoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      for (var i = 0; i < markers.length; i++) {  
				bounds.extend(markers[i].position);
      }
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
    autoCenter();
  </script>

	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>