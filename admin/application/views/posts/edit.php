	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$current_item = $this->be_model->get_post($data['edit_id']);
			
			$post_video_url = '';
			$prefix_length = strlen(config_item('media_post_self_domain_prefix'));
			if(substr($current_item['post_video_url'], 0, $prefix_length) == config_item('media_post_self_domain_prefix')) {
				$post_video_url = $site_info['front_url'] . config_item('path_media_posts') . substr($current_item['post_video_url'], $prefix_length);
			} else {
				$post_video_url = $current_item['post_video_url'];
			}
			
		?>
		<div class="row">
			
			<div class="col-md-12 col-xs-12">
			
	        <div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Workout Detail</h3>
				</div>
				<div class="box-body">
					<div class="col-md-6 col-xs-12 be-div-border-right">
						<p>
							<video style="width:100%; height: auto;" class="be-border-grey" autoplay controls>
								<source src="<?php echo $post_video_url; ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</p>
						<p class="be-margin-top-25">
	                    	<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(<?php echo $current_item['post_id']; ?>);"><i class="fa fa-trash-o"></i> Remove this Workout</a>
	                    </p>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="be-border-bottom be-margin-10">
							<p>
		                    	<b>Category</b> : <?php echo $current_item['category_name']; ?>
		                    </p>
		                    <p>
		                    	<b>Caption</b> : <?php echo ($current_item['post_caption'] == '') ? 'No caption inputted yet' : $current_item['post_caption']; ?>
		                    </p>
							<p class="be-margin-top-25">
		                    	<b>Likes</b> : <?php echo $current_item['post_liked_count']; ?>
		                    </p>
		                    <p>
		                    	<b>Comments</b> : <?php echo $current_item['post_commented_count']; ?>
		                    </p>
		                    <p>
		                    	<b><span class="be-font-red">Reported</span></b> : <?php echo $current_item['post_reported_count']; ?>
		                    	
		                    	
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
						<p class="be-center be-margin-top-25">
							<b>Posted User's Information</b>
						</p>
						<div class="be-clear"></div>
						<div class="pull-left col-md-7">
		                    <p>
		                    	<b>User Name</b> :
		                    	<a href="<?php echo base_url() . 'users/edit/' . $current_item['user_id']; ?>" target="_blank" title="Click to see details of this user information">
		                    		<?php echo $current_item['user_name']; ?>
		                    	</a>
		                    </p>
		                    <b>Reported User</b> :
					                    	
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
		                    	<b>Posts</b> : <?php echo $current_item['user_posts_count']; ?>
		                    </p>
		                    <p>
		                    	<b>Followers</b> : <?php echo $current_item['user_followers_count']; ?>
		                    </p>
		                    <p>
		                    	<b>Following</b> : <?php echo $current_item['user_following_count']; ?>
		                    </p>
		                    <p class="">
		                    	<b><span class="be-font-red">Reported</span></b> : <?php echo $current_item['user_reported_count']; ?>
		                    </p>
		                    
	                    
		                    <p class="be-margin-top-25">
		                    	<p><b>Last Updated Date</b> : <?php echo $current_item['user_last_updated_date']; ?></p>
		                    	<p><b>Signup Date</b> : <?php echo $current_item['user_signup_date']; ?></p>
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
					<h3 class="box-title">Workouts List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-main" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Video Thumb</th>
                                                <th>Category</th>
                                                <th>Posted Date</th>
                                                <th>Caption</th>
                                                <th>User Name</th>
                                                <th>User Photo</th>
                                                <th>Reported</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	foreach($data['posts'] as $item) {
                                        		$i++;
                                        		
                                        		
                                        		$post_thumb_photo_url = '';
                                        		$prefix_length = strlen(config_item('media_post_thumb_self_domain_prefix'));
                                        		if(substr($item['post_thumb_url'], 0, $prefix_length) == config_item('media_post_thumb_self_domain_prefix')) {
                                        			$post_thumb_photo_url = $site_info['front_url'] . config_item('path_media_post_thumbs') . substr($item['post_thumb_url'], $prefix_length);
                                        		} else {
                                        			$post_thumb_photo_url = $item['post_thumb_url'];
                                        		}
                                        		
                                        		$user_photo_url = '';
                                        		$prefix_length = strlen(config_item('media_user_self_domain_prefix'));
                                        		if(substr($item['post_user_photo_url'], 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
                                        			$user_photo_url = $site_info['front_url'] . config_item('path_media_users') . substr($item['post_user_photo_url'], $prefix_length);
                                        		} else {
                                        			$user_photo_url = $item['post_user_photo_url'];
                                        		}
                                        		
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td><img src="' . $post_thumb_photo_url . '" width="100" height="100" alt=""></td>
                                        			<td>' . $item['category_name'] . '</td>
                                        			<td>' . $item['post_date'] . '</td>
                                        			<td>' . character_limiter($item['post_caption'], 40) . '</td>
                                        			<td>' . $item['post_user_name'] . '</td>
                                        			<td><img src="' . $user_photo_url . '" width="60" height="60" alt=""></td>
                                        			<td>' . $item['post_reported_count'] . '</td>
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['post_id'] . '" class="btn btn-info be-edit-btn" title="Detail"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Detail</a>&nbsp;
                                        				&nbsp;<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(' . $item['post_id'] . ');"><i class="fa fa-trash-o"></i> Remove</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Video Thumb</th>
                                                <th>Category</th>
                                                <th>Posted Date</th>
                                                <th>Caption</th>
                                                <th>User Name</th>
                                                <th>User Photo</th>
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
		            	<h4>Do you really confirm to remove this workout?</h4>
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