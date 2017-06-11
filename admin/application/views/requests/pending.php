	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$current_item = $this->be_model->get_request($data['edit_id']);
		?>
		<div class="row">
			
			<div class="col-md-12 col-xs-12">
			
	        <div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Request Detail</h3>
				</div>
				<div class="box-body">
					<div class="col-md-6 col-xs-12 be-div-border-right">
						
					<p class="be-margin-top-10">
								<p>
									<b>Status</b> :
									<?php
										$status_msg = '';
										$status_msg_color_class = '';
										switch($current_item['request_status']) {
											case 0:
												$status_msg = 'PENDING';
												$status_msg_color_class = 'be-font-yellow';
												break;
											case 1:
												$status_msg = 'ACCEPTED';
												$status_msg_color_class = 'be-font-blue';
												break;
											case 10:
												$status_msg = 'FINISHED';
												$status_msg_color_class = 'be-font-green';
												break;
											case 2:
												$status_msg = 'REJECTED';
												$status_msg_color_class = 'be-font-red';
												break;
											default:
												break;
										}
										
										echo '<span class="be-font-bold ' . $status_msg_color_class . '">' . $status_msg . '</span>';
									?> 
									<br>
									<i>
									<?php
									echo ' (<i>Created at : ' . date('D, d M Y, H:i:s', strtotime($current_item['request_created_date'])) . '</i>)';
									?>
									</i>
								</p>
								
								<p class="be-separator-grey"></p>
								
								<p class="be-margin-top-10">
			                   		<b>Request User</b> : <?php echo $current_item['request_user']['user_full_name']; ?><br>
			                   	</p>
			                   	<p>
			                   			<?php
					                    $user_photo_url = '';
					                    $prefix_length = strlen(config_item('media_user_self_domain_prefix'));
					                    if(substr($current_item['request_user']['user_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
					                    	$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($current_item['request_user']['user_photo_url'], $prefix_length);
					                    } else {
					                    	$user_photo_url = $current_item['request_user']['user_photo_url'];
					                    }
					                    echo '<img src="' . $user_photo_url . '" class="be-image-bordered" width="96" height="96" alt="">';
					                    ?>
					                    
					                    <p>
                                   		<a target="_blank" href="<?php echo base_url() . 'users/users_edit/' . $current_item['request_user']['user_id']; ?>" class="btn btn-info be-edit-btn" title="Detail">
				                   			<i class="fa fa-user"></i>&nbsp;View Detail&nbsp;
				                   		</a>
				                   		</p>
                                   		
			                   	</p>
			                   
			                   <p class="be-separator-grey"></p>
			                   	
								<p class="be-margin-top-10">
			                    	<b>Request Target Groups</b> :
			                    	<p>
			                    	<?php
			                    	$request_group_names_arr = explode(',', substr($current_item['request_group_names'], 1, strlen($current_item['request_group_names']) - 2));
			                    	$i = 0;
			                    	foreach($request_group_names_arr as $request_group_name_item) {
			                    		if($i > 0) echo ', ';
										$request_group_name_item_arr = explodE(';', $request_group_name_item);
										echo $request_group_name_item_arr[1];
										$i++;
			                    	}
			                    	?>
			                    	</p>
			                    </p>
			                   
			                   
			           </p>
	                    
		                    
					</div>
					<div class="col-md-6 col-xs-12">
	                    
								<p class="be-margin-top-10">
			                   		<b>Request Information</b>
			                   		<p class="be-separator-grey"></p>
			                   		<p class="be-margin-top-10">
			                   			<b>Dates</b> : <?php echo $current_item['request_date_from'] . ' to ' . $current_item['request_date_to']; ?>
			                   		</p>
			                   		<p>
			                   			<b>Care Type</b> : <?php echo element($current_item['request_care_type_id'], config_item('request_care_types')); ?>
			                   		</p>
			                   		<p>
			                   			<b>Note</b> : <br><?php echo $current_item['request_note']; ?>
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
					<h3 class="box-title">Requests List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>User</th>
                                                <th>Dates</th>
                                                <th>Care Type</th>
                                                <th width="112px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	
                                        	foreach($data['requests'] as $item) {
                                        		$i++;
                                        		
                                        		$item_status_msg = '';
                                        		$item_status_msg_color_class = '';
                                        		switch($item['request_status']) {
                                        			case 0:
                                        				$item_status_msg = 'PENDING';
                                        				$item_status_msg_color_class = 'be-font-yellow';
                                        				break;
                                        			case 1:
                                        				$item_status_msg = 'ACCEPTED';
                                        				$item_status_msg_color_class = 'be-font-blue';
                                        				break;
                                        			case 10:
                                        				$item_status_msg = 'FINISHED';
                                        				$item_status_msg_color_class = 'be-font-green';
                                        				break;
                                        			case 2:
                                        				$item_status_msg = 'REJECTED';
                                        				$item_status_msg_color_class = 'be-font-red';
                                        				break;
                                        			default:
                                        				break;
                                        		}
                                        		
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<!--<td>' . '<span class="be-font-bold ' . $item_status_msg_color_class . '">' . $item_status_msg . '</span>' . '</td>-->
                                        			<td>' . $item['request_user']['user_full_name'] . '</td>
                                        			<td>' . $item['request_date_from'] . ' to ' . $item['request_date_to'] . '</td>
                                        			<td>' . element($item['request_care_type_id'], config_item('request_care_types')) . '</td>
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['request_id'] . '" class="btn btn-info be-edit-btn" title="Detail"><i class="fa fa-eye"></i>&nbsp;Detail</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>User</th>
                                                <th>Dates</th>
                                                <th>Care Type</th>
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
		            	<h4>All the requests handled by this user will be deleted, too.<br><br>
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