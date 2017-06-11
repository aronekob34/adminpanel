	
	
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
			                    	Email : <a href="mailto:<?php echo $current_item['user_email']; ?>"><?php echo $current_item['user_email']; ?></a>
			                    </p>
			                    <p>
			                    	Phone Number : <?php echo ($current_item['user_phone_number'] == '' ? 'Not inputted yet' : $current_item['user_phone_number']); ?>
			                    </p>
			                </p>
			                
			                <p class="be-margin-top-25">
		                    	<b>User Settings</b>
		                    	<p>Push Notification : <?php echo $current_item['user_settings_disable_push_notification'] == 0 ? 'Enabled' : 'Disabled'; ?></p>
		                    </p>
	                    
		                    <p class="be-margin-top-25">
		                    	<p>Last Updated Date : <?php echo $current_item['user_last_updated_date']; ?></p>
		                    	<p>Signup Date : <?php echo $current_item['user_signup_date']; ?></p>
		                    </p>
		                    
		                    
		                    <p class="be-margin-top-25">
		                    	<b>Requests Information</b>
		                    	<p>
			                    	Total Requests Count : <?php echo $current_item['user_requests_total_count']; ?>
			                    </p>
			                    <p>
			                    	Pending Requests Count : <?php echo $current_item['user_requests_pending_count']; ?>
			                    </p>
			                    <p>
			                    	Accepted Requests Count : <?php echo $current_item['user_requests_ongoing_count']; ?>
			                    </p>
			                    <p>
			                    	Rejected Requests Count : <?php echo $current_item['user_requests_cancelled_count']; ?>
			                    </p>
		                    </p>
		                    
		                    
		                    <p class="be-margin-top-25">
		                    	<b>Groups</b>
		                    	<p>
		                    	<?php
		                    	if(count($current_item['user_groups']) > 0) {
			                    	$i = 0;
			                    	foreach($current_item['user_groups'] as $group) {
			                    		if($i > 0) echo ',&nbsp;&nbsp;&nbsp;';
			                    		echo '<span>' . $group['group_name'] . '</span>';
			                    		$i++;
			                    	}
		                    	} else {
		                    		echo 'Not created yet..';
		                    	}
		                    	?>
		                    	</p>
		                    </p>
		                    
		                    
		                    <p class="be-margin-top-25">
		                    	<a class="btn btn-success be-remove-btn" title="Reactivate" onclick="be_open_suspend_form_modal(<?php echo $current_item['user_id']; ?>);"><i class="fa fa-unlock"></i> Reactivate this user</a>
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
		                    echo '<img src="' . $user_photo_url . '" class="pull-right be-image-bordered be-margin-10" width="180" height="180" alt="">';
		                    ?>
		                    
	                    </div>
	                    <div class="be-clear"></div>
					</div>
					<div class="col-md-6 col-xs-12">
	                    <p class="be-margin-top-10">
							<b>Pets</b> (Total Count : <?php echo count($current_item['user_pets']); ?>)
							<p class="be-margin-top-10">
								<?php
								if(count($current_item['user_pets']) > 0) {
									$i = 0;
									foreach($current_item['user_pets'] as $item) {
										//if($i > 0) echo '<div class="be-clear"></div><div class="be-separator-grey"></div>';
										echo '
										<div class="be-reports-content">
										<p class="be-margin-top-10">
											<div class="pull-left col-md-8">
												<b>' . ($i + 1) . '. ' . $item['pet_name'] . ' - ' . $item['pet_breed'] . '</b><br>
												<p class="be-margin-top-10">
												Gender : ' . ($item['pet_gender'] == 1 ? 'Male' : 'Female') . '<br>
												Neutered / Spayed : ' . ($item['pet_neutered'] == 1 ? 'Yes' : 'No') . '<br> 
												House Trained : ' . ($item['pet_trained'] == 1 ? 'Yes' : 'No') . '<br>
												Feeding : ' . $item['pet_feeding_notes'] . ' - ' . $item['pet_feeding_frequency'] . ' time' . ($item['pet_feeding_frequency'] > 1 ? 's' : '')  . ' a day<br>
												Notes :<br>' . $item['pet_notes'] . '
												</p>
											</div>
											<div class="pull-right col-md-4">
												';
										
										$user_photo_url = '';
										$prefix_length = strlen(config_item('media_pet_self_domain_prefix'));
										if(substr($item['pet_photo_url'], 0, $prefix_length) == config_item('media_pet_self_domain_prefix')) {
											$user_photo_url = $site_info['front_url'] . config_item('path_media_pets') . substr($item['pet_photo_url'], $prefix_length);
										} else {
											$user_photo_url = $current_item['pet_photo_url'];
										}
										echo '<img src="' . $user_photo_url . '" class="pull-right be-image-bordered be-margin-10" width="120" height="120" alt="">';
										
										echo '
											</div>
											<div class="be-clear"></div>
											<div class="be-separator-grey be-margin-top-15"></div>
										</p>
										</div>
										';
										$i++;
									}
								}
								?>
			                </p>
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
                                                <th width="70px">Photo</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Pets</th>
                                                <th>Groups</th>
                                                <th>Requests</th>
                                                <th width="124px"></th>
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
                                        			<td><img src="' . $user_photo_url . '" width="64" height="64" alt=""></td>
                                        			<td>' . $item['user_full_name'] . '</td>
                                        			<td>' . $item['user_email'] . '</td>
                                        			<td>' . $item['user_phone_number'] . '</td>
                                        			<td>' . $item['user_pets_count'] . '</td>
                                        			<td>' . $item['user_groups_count'] . '</td>
                                        			<td>' . $item['user_requests_count'] . '</td>
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
                                                <th width="70px">Photo</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Pets</th>
                                                <th>Groups</th>
                                                <th>Requests</th>
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
		            	<h4>All the pets/groups/requests related to this user will be deleted, too.<br><br>
		            	Are you sure to remove this user?</h4>
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
		            	<h4>Are you sure to re-activate this user?</h4>
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
		                <button type="submit" class="btn btn-success">Reactivate</button>
		            </div>
		        </div>
		        <input type="hidden" name="tag" value="suspend">
		        <input type="hidden" name="suspend_id" id="be-suspend-id" value="0">
		        </form>
		    </div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>