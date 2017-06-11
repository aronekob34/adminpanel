	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$current_item = $this->be_model->get_restaurant($data['edit_id']);
		?>
		<div class="row">
			
			<div class="col-md-12 col-xs-12">
			
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Restaurant Detail</h3>
				</div>
				<div class="box-body">
					<div class="col-md-6 col-xs-12 be-div-border-right">
						<div class="pull-left col-md-7">
		                    <p>
		                    	<b>Restaurant Name</b> : <?php echo $current_item['res_name']; ?>
		                    </p>
		                    <p>
		                    	<b>Phone Number</b> : <?php echo $current_item['res_phone_number']; ?>
		                    </p>
		                    <p>
		                    	<b>Website</b> : <?php echo $current_item['res_website']; ?>
		                    </p>
		                    <p>
		                    	<b>Cuisine</b> : <?php
		                    	$cuisine = $this->be_model->get_cuisine($current_item['res_cuisine_id']);
		                    	echo '<img src="' . $cuisine['cuisine_image_url'] . '" width="24" height="24">&nbsp;&nbsp;' . $cuisine['cuisine_name'];
		                    	?>
		                    </p>
		                    <p>
		                    	<b>Keywords</b> : <?php
		                    	if(isset($current_item['res_keywords']) & $current_item['res_keywords'] != '') {
		                    		echo substr($current_item['res_keywords'], 1, strlen($current_item['res_keywords']) - 2);
		                    	} else {
		                    		echo '';
		                    	}
		                    	?>
		                    </p>
		                    <p>
		                    	<b>Rating</b> : <?php echo number_format($current_item['res_rating_avg_value'], 1) . ' (based on ' . $current_item['res_rating_count'] . ' review' . ($current_item['res_rating_count'] > 1 ? 's' : '') . ')'; ?>
		                    </p>
		                    <p>
		                    	<b>Price Level</b> : <?php echo repeater('$', $current_item['res_rating_avg_price_level']); ?>
		                    </p>
		                    <p>
		                    	<b>Business Hours</b> : <?php echo $current_item['res_business_hours_description']; ?>
		                    </p>
	                    </div>
	                    <div class="pull-right col-md-5">
		                    <?php
		                    $user_photo_url = '';
		                    $prefix_length = strlen(config_item('media_post_photo_self_domain_prefix'));
		                    if(substr($current_item['res_photo_url'], 0, $prefix_length) == config_item('media_post_photo_self_domain_prefix')) {
		                    	$user_photo_url = $site_info['front_url'] . config_item('media_post_photo_self_domain_prefix') . substr($current_item['res_photo_url'], $prefix_length);
		                    } else {
		                    	$user_photo_url = $current_item['res_photo_url'];
		                    }
		                    echo '<img src="' . $user_photo_url . '" class="pull-right be-image-bordered be-margin-10" height="240" alt="">';
		                    ?>
	                    </div>
	                    <div class="be-clear"></div>
	                    
	                    <div class="be-margin-top-15">
		                    <p class="">
		                    	<h3 class="box-title">Restaurant Photos</h3>
		                    	
		                    	<b>Total Count</b> : <?php echo count($current_item['res_photos']); ?>
		                    	<?php if(count($current_item['res_photos']) > 0) { ?>
		                    		<br>
			                    	<button type="button" class="be-margin-top-10 be-collapse1-content-toggle-btn btn btn-info" data-toggle="collapse" data-target="#be-collapse1-content">
										<span class="glyphicon glyphicon-collapse-down"></span> Show List
									</button>
									<div id="be-collapse1-content" class="collapse be-margin-top-15">
										<?php
										$i = 0;
										foreach($current_item['res_photos'] as $item) {
											//if($i % 2 == 0) echo '<div class="be-clear"></div><div class="be-separator-grey"></div>';
											
											$user_photo_url = '';
											$prefix_length = strlen(config_item('media_post_photo_self_domain_prefix'));
											if(substr($item['photo_url'], 0, $prefix_length) == config_item('media_post_photo_self_domain_prefix')) {
												$user_photo_url = $site_info['front_url'] . config_item('path_media_post_photos') . substr($item['photo_url'], $prefix_length);
											} else {
												$user_photo_url = $item['photo_url'];
											}
											echo '<img src="' . $user_photo_url . '" class="col-md-6 col-xs-4" style="margin-bottom:10px;" alt="">';
											$i++;
										}
										?>
										<div class="be-clear"></div><div class="be-separator-grey"></div>
									</div>
									<script>
										$(document).ready(function(){
											$("#be-collapse1-content").on("hide.bs.collapse", function(){
												$(".be-collapse1-content-toggle-btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Show List');
											});
											$("#be-collapse1-content").on("show.bs.collapse", function(){
												$(".be-collapse1-content-toggle-btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Hide List');
											});
										});
									</script>
		                   		<?php } ?>
		                    </p>
		                    
		                    <p class="be-margin-top-25">
		                    	<h3 class="box-title">Ratings</h3>
		                    	
		                    	<b>Total Count</b> : <?php echo count($current_item['res_ratings']); ?>
		                    	<?php if(count($current_item['res_ratings']) > 0) { ?>
		                    		<br>
			                    	<button type="button" class="be-margin-top-10 be-collapse2-content-toggle-btn btn btn-info" data-toggle="collapse" data-target="#be-collapse2-content">
										<span class="glyphicon glyphicon-collapse-down"></span> Show List
									</button>
									<div id="be-collapse2-content" class="collapse">
										<?php
										$i = 0;
										foreach($current_item['res_ratings'] as $item) {
											if($i > 0) echo '<div class="be-clear"></div><div class="be-separator-grey"></div>';
											echo '
											<div class="be-reports-content">
												<p>
							                    	<a href="' . base_url() . 'users/edit/' . $item['user_id'] . '" target="_blank" title="Click to see details of this user information">
							                    		<b>' . $item['user_full_name'] . '</b>
							                    	</a>
							                    	<!--<a href="#" title="Click to see details of this user information">
							                    		<b>' . $item['user_full_name'] . '</b>
							                    	</a>-->
							                    	&nbsp;&nbsp;&nbsp;
							                    	Rated : 
							                    	<b>
							                    	';
													for($j = 0; $j < round($item['rating_price_level']); $j++) {
														echo '$';
													}
													echo '
													</b>
													&nbsp;,&nbsp;
							                    	<b>' . number_format($item['rating_value'], 1, '.', '') . '</b>
							                    	</b>
							                    </p>
											</div>
											';
											$i++;
										} 
										?>
									</div>
									<script>
										$(document).ready(function(){
											$("#be-collapse2-content").on("hide.bs.collapse", function(){
												$(".be-collapse2-content-toggle-btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Show List');
											});
											$("#be-collapse2-content").on("show.bs.collapse", function(){
												$(".be-collapse2-content-toggle-btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Hide List');
											});
										});
									</script>
		                   		<?php } ?>
		                    </p>
	                    </div>
					</div>
					<div class="col-md-6 col-xs-12">
	                    <p class="be-margin-top-10">
	                    	<b>Current Location</b>
	                    	<p>Address : <?php echo $current_item['res_location_address']; ?></p>
	                    	<p>Coordinate : <?php echo $current_item['res_location_latitude'] . ' , ' . $current_item['res_location_longitude']; ?></p>
	                    </p>
	                    
	                    <p class="be-margin-top-25">
	                    	<div class="be-image-bordered" style="height:500px;width:100%;max-width:100%;list-style:none; transition: none;overflow:hidden;">
		                    	<div id="gmap_display" style="height:100%; width:100%;max-width:100%;">
			                    	<iframe style="height:100%;width:100%;border:0;" frameborder="0"
			                    		src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode($current_item['res_location_address']); ?>&key=<?php echo config_item('google_api_key_server'); ?>">
			                    	</iframe>
		                    	</div>
		                    	<a class="embedded-map-code" href="http://www.dog-checks.com/dachshund-checks" id="enable-map-info">dachshund checks</a>
		                    	<style>#gmap_display .text-marker{max-width:none!important;background:none!important;}img{max-width:none}</style>
	                    	</div>
	                    	
	                    	<script src="https://www.dog-checks.com/google-maps-authorization.js?id=5619c7a5-60ef-1bce-cad8-3a47b2c73c55&c=embedded-map-code&u=1470904189" defer="defer" async="async"></script>
		                </p>
	                </div>
	                <div class="be-clear"></div>
	            </div>
				<div class="box-footer">
					
				</div>
			</div>
			
			</div>
			
		</div><!-- /.row (main row) -->
		
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Restaurants List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Website</th>
                                                <th>Cuisines</th>
                                                <th>Rating</th>
                                                <th>Price Level</th>
                                                <th width="112px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	
                                        	foreach($data['restaurants'] as $item) {
                                        		$i++;
                                        		
                                        		$cuisine = $this->be_model->get_cuisine($item['res_cuisine_id']);
                                        		
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>' . $item['res_name'] . '</td>
                                        			<td>' . $item['res_phone_number'] . '</td>
                                        			<td>' . $this->be_model->be_character_limiter($item['res_location_address'], 40) . '</td>
                                        			<td>' . $item['res_website'] . '</td>
                                        			<td><img src="' . $cuisine['cuisine_image_url'] . '" width="24" height="24">&nbsp;&nbsp;' . $cuisine['cuisine_name'] . '</td>
                                        			<td>' . number_format($item['res_rating_avg_value'], 1) . '</td>
                                        			<td>' . repeater('$', round($item['res_rating_avg_price_level'])) . '</td>
                                        			
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['res_id'] . '" class="btn btn-info be-edit-btn" title="Detail"><i class="fa fa-eye"></i>&nbsp;Detail</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Website</th>
                                                <th>Cuisines</th>
                                                <th>Rating</th>
                                                <th>Price Level</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
				</div><!-- /.box-body -->
			</div>
			</div>
		</div>
		<div class="modal fade be-remove-form-modal">
		    <div class="modal-dialog">
		    	<form role="form" action="<?php echo base_url() . $page; ?>" method="post" id="be-remove-form">
		        <div class="modal-content">
			        <!-- <div class="modal-header">
		                <h4>Result</h4>
		            </div> -->
		            <div class="modal-body">
		            	<h4>Do you really confirm to delete this restaurant data?</h4>
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
		                <button type="submit" class="btn btn-danger">Remove</button>
		            </div>
		        </div>
		        <input type="hidden" name="tag" value="remove">
		        <input type="hidden" name="remove_id" id="be-remove-id" value="0">
		        </form>
		    </div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>