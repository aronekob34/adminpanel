	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$current_item = $this->be_model->get_user($data['edit_id']);
		?>
		<div class="row">
			
			<div class="col-md-12 col-xs-12">
			
	        <div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">User Detail</h3>
				</div>
				<div class="box-body">
					<div class="col-md-6 col-xs-12 be-div-border-right">
						<div class="pull-left col-md-7">
						
							<p class="be-margin-top-10">
								<b>Personal Information</b>
			                    <p>
			                    	Full Name : <?php echo $current_item['user_full_name']; ?>
			                    </p>
			                    <p>
			                    	User Type : <?php echo $current_item['user_type'] == 'customer' ? 'Customer' : 'Müver'; ?>
			                    </p>
								<p>
			                    	Email : <a href="mailto:<?php echo $current_item['user_email']; ?>"><?php echo $current_item['user_email']; ?></a>
			                    </p>
			                    <p>
			                    	Phone Number : <?php echo ($current_item['user_phone_number'] == '' ? 'Not inputted yet' : $current_item['user_phone_number']); ?>
			                    </p>
			                    <p>
			                    	Payment Verified : <?php echo ($current_item['user_bt_payment_verified'] == 1 ? 'Yes' : 'No'); ?>
			                    </p>
			                    <p>
			                    	Register Type : <?php echo ($current_item['user_facebook_id'] == '') ? 'Manual' : 'Facebook'; ?>
			                    </p>
			                </p>
			                
		                    <p class="be-margin-top-25">
		                    	<b>Müvets Information</b>
		                    	<p>
			                    	Total Müvets Count : <?php echo $current_item['user_muvets_total_count']; ?>
			                    </p>
			                    <p>
			                    	Pending Müvets Count : <?php echo $current_item['user_muvets_pending_count']; ?>
			                    </p>
			                    <p>
			                    	Ongoing Müvets Count : <?php echo $current_item['user_muvets_ongoing_count']; ?>
			                    </p>
			                    <p>
			                    	Finished Müvets Count : <?php echo $current_item['user_muvets_finished_count']; ?>
			                    </p>
			                    <p>
			                    	Cancelled Müvets Count : <?php echo $current_item['user_muvets_cancelled_count']; ?>
			                    </p>
		                    </p>
	                    
		                    <p class="be-margin-top-25">
		                    	<b>User Settings</b>
		                    	<p>Searching Distance : <?php echo $current_item['user_settings_distance']; ?> miles</p>
		                    	<p>Push Notification : <?php echo $current_item['user_settings_disable_push_notification'] == 0 ? 'Enabled' : 'Disabled'; ?></p>
		                    </p>
		                    
		                    <p class="be-margin-top-25">
		                    	<p>Last Updated Date : <?php echo $current_item['user_last_updated_date']; ?></p>
		                    	<p>Signup Date : <?php echo $current_item['user_signup_date']; ?></p>
		                    </p>
		                    
		                    
		                    <p class="be-margin-top-25">
		                    	<a class="btn btn-success be-remove-btn" title="Approve" onclick="be_open_suspend_form_modal(<?php echo $current_item['user_id']; ?>);"><i class="fa fa-check-circle"></i> Approve this user</a>
		                    	&nbsp;&nbsp;&nbsp;
		                    	<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(<?php echo $current_item['user_id']; ?>);"><i class="fa fa-trash-o"></i> Remove this user</a>
		                    </p>
	                    </div>
	                    <div class="pull-right col-md-5">
	                    	
		                    <?php
		                    $user_photo_url = '';
		                    $prefix_length = strlen(config_item('media_user_self_domain_prefix'));
		                    if(substr($current_item['user_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
		                    	$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($current_item['user_photo_url'], $prefix_length);
		                    } else {
		                    	$user_photo_url = $current_item['user_photo_url'];
		                    }
		                    echo '<img src="' . $user_photo_url . '" class="pull-right be-image-bordered be-margin-10" width="160" height="160" alt="">';
		                    ?>
		                    
		                    <p class="be-margin-top-25 pull-right be-margin-10">
		                    	<input type="text" class="rating pull-right" data-size="xs" data-display-only="true"
                                   value="<?php echo ($current_item['user_rating_avg_value']); ?>" title="">
                   				<?php
                   				if((float)$current_item['user_rating_avg_value'] > 0) {
                   					echo '<span class="be-font-dark-grey">Avg ' . (number_format((float)$current_item['user_rating_avg_value'], 1, '.', '')) . ' stars out of ' . $current_item['user_rating_count'] . ' reviews</span>';
                   				} else {
                   					echo '<span class="be-font-dark-grey">No rating yet</span>';
                   				}
                   				?>
		                    </p>
		                    
	                    </div>
	                    <div class="be-clear"></div>
					</div>
					<div class="col-md-6 col-xs-12">
	                    <p class="be-margin-top-10">
	                    	<b>Current Location</b>
	                    	<p>Address : <?php echo $current_item['user_location_address']; ?></p>
	                    	<p>Coordinate : <?php echo $current_item['user_location_latitude'] . ' , ' . $current_item['user_location_latitude']; ?></p>
	                    </p>
	                    
	                    <p class="be-margin-top-25">
	                    	<div class="be-image-bordered" style="height:500px;width:100%;max-width:100%;list-style:none; transition: none;overflow:hidden;">
		                    	<div id="gmap_display" style="height:100%; width:100%;max-width:100%;">
			                    	<iframe style="height:100%;width:100%;border:0;" frameborder="0"
			                    		src="https://www.google.com/maps/embed/v1/place?q=<?php echo $current_item['user_location_address']; ?>&key=<?php echo config_item('google_api_key_server'); ?>">
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
					<h3 class="box-title">Users List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>User Type</th>
                                                <th width="70px">Photo</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Current Location</th>
                                                <th>Payment Verified</th>
                                                <th width="108px">Rating</th>
                                                <th width="120px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	foreach($data['users'] as $item) {
                                        		$i++;
                                        		
                                        		$user_photo_url = '';
                                        		$prefix_length = strlen(config_item('media_user_self_domain_prefix'));
                                        		if(substr($item['user_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
                                        			$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($item['user_photo_url'], $prefix_length);
                                        		} else {
                                        			$user_photo_url = $item['user_photo_url'];
                                        		}
                                        		
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td><i class="be-font-s26 fa ' . ($item['user_type'] == 'customer' ? 'fa-briefcase' : 'fa-truck') . '" title="' . $item['user_type'] . '"></i></td>
                                        			<td><img src="' . $user_photo_url . '" width="64" height="64" alt=""></td>
                                        			<td>' . $item['user_full_name'] . '</td>
                                        			<td>' . $item['user_email'] . '</td>
                                        			<td>' . $item['user_phone_number'] . '</td>
                                        			<td>' . character_limiter($item['user_location_address'], 120) . '</td>
                                        			<td>
                                        				<i class="fa fa-dollar ' . ($item['user_bt_payment_verified'] == 1 ? 'be-payment-verified' : 'be-payment-unverified') . '"></i>
                                        				<span class="be-font-s12 ' . ($item['user_bt_payment_verified'] == 1 ? 'be-font-main' : 'be-font-light-grey') . '">&nbsp;&nbsp;&nbsp;&nbsp;' . ($item['user_bt_payment_verified'] == 1 ? 'Verified' : 'Not verified') . '</span>
                                        			</td>
                                        			<td>
                                        				<input type="text" class="rating" data-size="xs" data-display-only="true"
                                        				value="' . ($item['user_rating_avg_value']) . '"
                                        				title="">
                                        				<br>
                                        				<span class="' . ((float)$item['user_rating_avg_value'] > 0 ? 'be-font-main' : 'be-font-light-grey') . '">' . (number_format((float)$item['user_rating_avg_value'], 1, '.', '')) . '</span>
                                        			</td>
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['user_id'] . '" class="btn btn-info be-edit-btn" title="Detail"><i class="fa fa-user"></i>&nbsp;View Detail</a>&nbsp;
                                        				<!--&nbsp;<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(' . $item['user_id'] . ');"><i class="fa fa-trash-o"></i> Remove</a>&nbsp;-->
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>User Type</th>
                                                <th>Photo</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Current Location</th>
                                                <th>Payment Verified</th>
                                                <th>Rating</th>
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
		            	<h4>Are you sure to remove this user?</h4>
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
		
		<div class="modal fade be-suspend-form-modal">
		    <div class="modal-dialog">
		    	<form role="form" action="<?php echo base_url() . $page; ?>" method="post" id="be-suspend-form">
		        <div class="modal-content">
			        <!-- <div class="modal-header">
		                <h4>Result</h4>
		            </div> -->
		            <div class="modal-body">
		            	<h4>Are you sure to approve this user?</h4>
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
		                <button type="submit" class="btn btn-success">Approve</button>
		            </div>
		        </div>
		        <input type="hidden" name="tag" value="approve">
		        <input type="hidden" name="approve_id" id="be-suspend-id" value="0">
		        </form>
		    </div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>