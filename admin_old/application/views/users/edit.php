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
		                    <p>
		                    	<b>User Name</b> : <?php echo $current_item['user_name']; ?>
		                    </p>
		                    <?php
		                    if($current_item['user_full_name'] != '') {
		                    	echo '
		                    <p>
		                    	<b>Full Name</b> : ' . $current_item['user_full_name'] . '
		                    </p>';
							}
							?>
		                    <p>
		                    	<b>Bio</b> : <?php echo ($current_item['user_bio'] == '') ? 'No bio inputted yet' : $current_item['user_bio']; ?>
		                    </p>
		                    
		                    <p class="be-margin-top-25">
		                    	<p><b>Last Updated Date</b> : <?php echo $current_item['user_last_updated_date']; ?></p>
		                    	<p><b>Signup Date</b> : <?php echo $current_item['user_signup_date']; ?></p>
		                    </p>
		                    
		                    <p class="be-margin-top-25">
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
	                    </div>
	                    <div class="be-clear"></div>
					</div>
					<div class="col-md-6 col-xs-12">
	                    <p class="">
	                    	<b>Posts</b> : <?php echo $current_item['user_posts_count']; ?>
	                    </p>
	                    <p>
	                    	<b>Followers</b> : <?php echo $current_item['user_followers_count']; ?>
	                    </p>
	                    <p>
	                    	<b>Following</b> : <?php echo $current_item['user_following_count']; ?>
	                    </p>
	                    <p class="be-margin-top-25">
	                    	<b><span class="be-font-red">Reported</span></b> : <?php echo $current_item['user_reported_count']; ?>
	                    	
	                    	
	                    	<?php if($current_item['user_reported_count'] > 0) { ?>
	                    	<br>
	                    	<button type="button" class="be-margin-top-25 be-reports-content-toggle-btn btn btn-danger" data-toggle="collapse" data-target="#be-reports-content">
								<span class="glyphicon glyphicon-collapse-down"></span> Show Reports List
							</button>
							<div id="be-reports-content" class="collapse">
								<?php
								$i = 0;
								foreach($current_item['reports'] as $report) {
									if($i > 0) echo '<div class="be-clear"></div><div class="be-separator-grey"></div>';
									echo '
									<div class="be-reports-content">
										<p>
					                    	<b>Issued Date</b> : ' . $report['report_date'] . '
					                    </p>
										<p>
					                    	<b>Reported User</b> :
					                    	<a href="' . base_url() . 'users/edit/' . $report['user_id'] . '" target="_blank" title="Click to see details of this user information">
					                    	' . $report['user_name'] . '
					                    	</a>
					                    </p>
					                    <p>
					                    	<b>Content</b> : ' . $report['report_content'] . '
					                    </p>
									</div>
									';
									$i++;
								} 
								?>
							</div>
							<script>
								$(document).ready(function(){
									$("#be-reports-content").on("hide.bs.collapse", function(){
										$(".be-reports-content-toggle-btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Show Reports List');
									});
									$("#be-reports-content").on("show.bs.collapse", function(){
										$(".be-reports-content-toggle-btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Hide Reports List');
									});
								});
							</script>
	                    	<?php } ?>
	                    	
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
                                                <th>Photo</th>
                                                <th>User Name</th>
                                                <th>Full Name</th>
                                                <th>Bio</th>
                                                <th>Reported</th>
                                                <th></th>
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
                                        			<td><img src="' . $user_photo_url . '" width="40" height="40" alt=""></td>
                                        			<td>' . $item['user_name'] . '</td>
                                        			<td>' . $item['user_full_name'] . '</td>
                                        			<td>' . character_limiter($item['user_bio'], 40) . '</td>
                                        			<td>' . $item['user_reported_count'] . '</td>
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['user_id'] . '" class="btn btn-info be-edit-btn" title="Detail"><i class="fa fa-user"></i>&nbsp;&nbsp;View Detail</a>&nbsp;
                                        				&nbsp;<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(' . $item['user_id'] . ');"><i class="fa fa-trash-o"></i> Remove</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Photo</th>
                                                <th>User Name</th>
                                                <th>Full Name</th>
                                                <th>Bio</th>
                                                <th>Reported</th>
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
		            	<h4>All the workouts posted by this user would also be removed.<br><br>
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