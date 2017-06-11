	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<div class="container">
			<form class="form-horizontal">
				<div class="row">
					<div class="box box-primary">
						<h3 class="text-primary text-center">Business Information</h3>

						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="bizname">Business name:</label>
							
							<div class="col-md-8 col-xs-8">
								<input type="text" class="form-control" id="bizname" placeholder="Enter Business name">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="category">Business Category:</label>
							
							<div class="col-md-8 col-xs-8">
								<select class="form-control" id="category">
									<?php
										foreach($data['categories'] as $item) {
											echo '<option value="' . $item['category_name'] . '">' . $item['category_name'] . '</option>
											';
										}
									?>
								</select>
								<!--<input type="text" class="form-control" id="lastname" placeholder="Enter lastname">-->
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="description">Description:</label>
							
							<div class="col-md-8 col-xs-8">
								<textarea class="form-control" rows="5" id="description"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="phone">Phone number:</label>
							
							<div class="col-md-8 col-xs-8">
								<input type="tel" class="form-control" id="phone" placeholder="Enter phone number">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="weburl">Website URL:</label>
							
							<div class="col-md-8 col-xs-8">
								<input type="url" class="form-control" id="weburl" placeholder="Enter website url">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="upload">Business Logo:</label>
							
							<div class="col-md-4 col-xs-4">
								<form class="form-control" id="upload" action="upload.php" enctype="multipart/form-data" method="post">
									<img id="bizlogo" src="#" alt="Business Logo">
									<input type="file" accept="image/*" onchange="previewFile(this);"/>
									
								</form>
							</div>

							<script>
								function previewFile(input) {
									if (input.files && input.files[0]) {
										var reader = new FileReader();

										reader.onload = function (e) {
											$('#bizlogo')
											.attr('src', e.target.result)
										};

										reader.readAsDataURL(input.files[0]);
									}									
								}
							</script>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2 col-xs-2" for="weburl">Address:</label>
							
							<div class="col-md-8 col-xs-8" id="map" style="height:400px">
								<script>
									var map;
									var marker=null;
									function initMap() {
										var pos = {lat: 3.146770, lng: 101.696467};
										map = new google.maps.Map(document.getElementById('map'), {
											zoom: 15,
											center: pos
										});

										map.addListener('click', function(e) {
											if (marker != null) {
												marker.setMap(null);
											}

											marker = new google.maps.Marker({
												position: e.latLng,
												map: map
											});
											map.panTo(e.latLng);
										});

										if (navigator.geolocation) {
											navigator.geolocation.getCurrentPosition(function(position) {
												var pos = {
													lat: position.coords.latitude,
													lng: position.coords.longitude
												};
												
												map.setCenter(pos);
											});
										}
									}
								</script>
								<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrIqwPxTThkgimZJDHRg_eaXp9FpOiKvc&callback=initMap"
									async defer>
								</script>
								
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-10" align="center">
								<button type="submit" class="btn btn-default">Save</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>