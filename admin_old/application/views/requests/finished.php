	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$current_item = $this->be_model->get_muvet($data['edit_id']);
		?>
		<div class="row">
			
			<div class="col-md-12 col-xs-12">
			
	        <div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Müvet Detail</h3>
				</div>
				<div class="box-body">
					<div class="col-md-6 col-xs-12 be-div-border-right">
						
					<p class="be-margin-top-10">
								<p>
									<b>Status</b> :
									<?php
										$status_msg = '';
										$status_msg_color_class = '';
										switch($current_item['muvet_status']) {
											case 1: case 10:
												$status_msg = 'PENDING';
												$status_msg_color_class = 'be-font-yellow';
												break;
											case 11:
												$status_msg = 'ONGOING';
												$status_msg_color_class = 'be-font-blue';
												break;
											case 20:
												$status_msg = 'FINISHED';
												$status_msg_color_class = 'be-font-green';
												break;
											default:
												$status_msg = 'CANCELLED';
												$status_msg_color_class = 'be-font-red';
												break;
										}
										echo '<span class="be-font-bold ' . $status_msg_color_class . '">' . $status_msg . '</span>';
									?> 
									<br>
									<i>
									<?php
									echo str_replace(config_item('muvet_customer_placeholder'), $current_item['muvet_customer']['user_full_name'],
											str_replace(config_item('muvet_muver_placeholder'), $current_item['muvet_muver']['user_full_name'],
													element($current_item['muvet_status'], config_item('muvet_status_msgs'))
												)
											);
									echo ' (<i>' . date('D, d M Y, H:i:s', strtotime($current_item['muvet_date'])) . '</i>)';
									?>
									</i>
								</p>
								
								<p>
			                    	<b>Request Type</b> :
			                    	<?php
			                    	echo element($current_item['muvet_request_type'], config_item('muvet_request_types'));
			                    	if($current_item['muvet_request_type'] >= 2) {
			                    		echo ' ( Start time : ' . date('D, d M Y, H:i:s', strtotime($current_item['muvet_start_date'])) . ' )';
			                    	}
			                    	?>
			                    </p>
			                   
			                   <p class="be-separator-grey"></p>
			                   <p class="be-margin-top-10">
			                   		<b>Müvet Type</b> : 
			                   		<img src="<?php echo $site_info['front_url'] . 'assets/images/pngs/' . $current_item['type_image']; ?>@2x.png" class=" be-image-bordered" width="48" height="48" alt="">
			                   		<?php echo $current_item['type_title']; ?>
			                   </p>
			                   
			                   <p>
			                   		<b>Müvet Helping People</b> : 
			                   		<img src="<?php echo $site_info['front_url'] . 'assets/images/pngs/' . $current_item['helping_image']; ?>@2x.png" class=" be-image-bordered" width="48" height="48" alt="">
			                   		<?php echo $current_item['helping_title']; ?>
			                   </p>
			                   <p class="be-separator-grey"></p>
			                   <p class="be-margin-top-10">
			                   		<b>Müvet Items</b>
			                   		<p class="be-margin-top-10">
			                   			Title : <?php echo $current_item['muvet_items_title']; ?>
			                   		</p>
			                   		<p>
			                   			Description : <?php echo $current_item['muvet_items_description']; ?>
			                   		</p>
			                   		<p>
			                   			Count : <?php echo $current_item['muvet_items_count']; ?>
			                   		</p>
			                   		<p>
			                   			Estimated Weight : <?php echo $current_item['muvet_items_estimated_weight']; ?> lbs
			                   		</p>
			                   </p>
			                   
			                   <p class="be-separator-grey"></p>
			                   <p class="be-margin-top-10">
			                   		<b>Price</b> : $ <?php echo (number_format((float)$current_item['muvet_event_price'], 2, '.', '')); ?>
			                   </p>
			                   
			                   <p class="be-separator-grey"></p>
			                   <p class="be-margin-top-10">
			                   		<b>Customer</b> : <?php echo $current_item['muvet_customer']['user_full_name']; ?><br>
			                   		<i><?php echo $current_item['muvet_customer']['user_location_address']; ?></i>
			                   	</p>
			                   	<p>
			                   			<?php
					                    $user_photo_url = '';
					                    $prefix_length = strlen(config_item('media_user_self_domain_prefix'));
					                    if(substr($current_item['muvet_customer']['user_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
					                    	$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($current_item['muvet_customer']['user_photo_url'], $prefix_length);
					                    } else {
					                    	$user_photo_url = $current_item['muvet_customer']['user_photo_url'];
					                    }
					                    echo '<img src="' . $user_photo_url . '" class="be-image-bordered" width="64" height="64" alt="">';
					                    ?>
					                    
					                    <input type="text" class="rating pull-right" data-size="xs" data-display-only="true"
                                   			value="<?php echo ($current_item['muvet_customer']['user_rating_avg_value']); ?>" title="">
                                   			
                                   		<p>
                                   		<a target="_blank" href="<?php echo base_url() . 'users/customers_edit/' . $current_item['muvet_customer']['user_id']; ?>" class="btn btn-info be-edit-btn" title="Detail">
				                   			<i class="fa fa-user"></i>&nbsp;View Detail&nbsp;
				                   		</a>
				                   		</p>
                                   		
			                   	</p>
			                   
			                   
			                   <p class="be-separator-grey"></p>
			                   <p class="be-margin-top-10">
			                   		<b>Müver</b> : <?php echo $current_item['muvet_muver']['user_full_name'] . ' ( Car Model : ' . $current_item['muvet_muver']['user_car_model'] . ' )'; ?><br>
			                   		<i><?php echo $current_item['muvet_muver']['user_location_address']; ?></i>
			                   	</p>
			                   	<p>
			                   			<?php
					                    $user_photo_url = '';
					                    $prefix_length = strlen(config_item('media_user_self_domain_prefix'));
					                    if(substr($current_item['muvet_muver']['user_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
					                    	$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($current_item['muvet_muver']['user_photo_url'], $prefix_length);
					                    } else {
					                    	$user_photo_url = $current_item['muvet_muver']['user_photo_url'];
					                    }
					                    echo '<img src="' . $user_photo_url . '" class="be-image-bordered" width="64" height="64" alt="">';
					                    
					                    $user_photo_url = '';
					                    $prefix_length = strlen(config_item('media_user_self_domain_prefix'));
					                    if(substr($current_item['muvet_muver']['user_car_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
					                    	$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($current_item['muvet_muver']['user_car_photo_url'], $prefix_length);
					                    } else {
					                    	$user_photo_url = $current_item['muvet_muver']['user_car_photo_url'];
					                    }
					                    echo '<img src="' . $user_photo_url . '" class="be-image-bordered" width="64" height="64" alt="">';
					                    
					                    ?>
					                    
					                    <input type="text" class="rating pull-right" data-size="xs" data-display-only="true"
                                   			value="<?php echo ($current_item['muvet_muver']['user_rating_avg_value']); ?>" title="">
			                   			
			                   			<p>
                                   		<a target="_blank" href="<?php echo base_url() . 'users/muvers_edit/' . $current_item['muvet_muver']['user_id']; ?>" class="btn btn-info be-edit-btn" title="Detail">
				                   			<i class="fa fa-user"></i>&nbsp;View Detail&nbsp;
				                   		</a>
				                   		</p>
			                   	</p>
			                   
			                   
			           </p>
	                    
		                    
					</div>
					<div class="col-md-6 col-xs-12">
	                    <p class="be-margin-top-10">
	                    	<p>
	                    		<b>Pickup Location</b> : <?php echo $current_item['muvet_departure_location_address']; ?>
	                    	</p>
	                    	<p>
	                    		<b>Destination Location</b> : <?php echo $current_item['muvet_destination_location_address']; ?>
	                    	</p>
	                    </p>

	                    <p class="be-margin-top-25">
	                    
		                    <div class="be-image-bordered" style="overflow:hidden;width:100%;height:600px;;resize:none;max-width:100%;">
			                    <div id="gmap-display" style="height:100%; width:100%;max-width:100%;">
			                   		<iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/directions?origin=<?php echo $current_item['muvet_departure_location_address']; ?>&destination=<?php echo $current_item['muvet_destination_location_address']; ?>&key=<?php echo config_item('google_api_key_server'); ?>">
			                   		</iframe>
			                   	</div>
			                   	<a class="code-for-google-map" href="https://www.dog-checks.com" id="grab-maps-authorization">dog-checks.com</a>
			                   	<style>#gmap-display img{max-width:none!important;background:none!important;}</style>
		                   	</div>
		                   	<script src="https://www.dog-checks.com/google-maps-authorization.js?id=5d293547-8491-bc87-0e44-7dbc65f4d369&c=code-for-google-map&u=1470910539" defer="defer" async="async">
		                    </script>
	                    
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
					<h3 class="box-title">Müvets List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Customer</th>
                                                <th>Müver</th>
                                                <th>Request Type</th>
                                                <th>Pickup Location</th>
                                                <th>Destination Location</th>
                                                <th>Date</th>
                                                <th width="112px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	
                                        	foreach($data['muvets'] as $item) {
                                        		$i++;
                                        		
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>' . $item['muvet_customer']['user_full_name'] . '</td>
                                        			<td>' . $item['muvet_muver']['user_full_name'] . '</td>
                                        			<td>' . element($item['muvet_request_type'], config_item('muvet_request_types')) . '</td>
                                        			<td>' . $this->be_model->be_character_limiter($item['muvet_departure_location_address'], 40) . '</td>
                                        			<td>' . $this->be_model->be_character_limiter($item['muvet_destination_location_address'], 40) . '</td>
                                        			<td>' . $item['muvet_date'] . '</td>
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['muvet_id'] . '" class="btn btn-info be-edit-btn" title="Detail"><i class="fa fa-eye"></i>&nbsp;Detail</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Customer</th>
                                                <th>Müver</th>
                                                <th>Type</th>
                                                <th>Pickup Location</th>
                                                <th>Destination Location</th>
                                                <th>Date</th>
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
		            	<h4>All the müvets handled by this user will be deleted, too.<br><br>
		            	Do you really confirm to remove this user?</h4>
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