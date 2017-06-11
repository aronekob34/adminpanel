	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
			if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
				$current_item = $this->be_model->get_business($data['edit_id']);
		?>

		<div class="row">			
			<div class="col-md-12 col-xs-12">			
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Business Detail</h3>
					</div>

					<div class="box-body row">
						<div class="col-md-4 col-xs-12 be-div-border-right" style="height:400px">							
							<?php								
								$biz_logo_url = $site_info['front_url'] . config_item('path_media_businesses') . $current_item['biz_logo_url'];									
								echo '<img src="' . $biz_logo_url . '" class="be-image-bordered" alt="">';
							?>							
						</div>

						<div class="col-md-4 col-xs-12 be-div-border-right" style="height:400px">
							<h1 align="center">
								<b><?php echo $current_item['biz_name']; ?></b>
							</h1>

							<h3 align="center">
								<?php echo '(' . $current_item['category_name'] . ')'; ?>
							</h3>

							<h5 align="center">
								<?php echo $current_item['biz_description']; ?>
							</h5>

							<h3 align="center">
								<?php echo 'Website : <a href=http://www.' . $current_item['biz_website'] . ' target="_blank">' . $current_item['biz_website'] . '</a>'; ?>
							</h3>

							<h3 align="center">
								<?php echo 'Phone Number : ' . $current_item['biz_phone_number']; ?>
							</h3>
						</div>

						<div class="col-md-4 col-xs-12" id="map" style="height:400px">
						</div>

						<script>
							function initMap() {
								var biz_location = {lat: <?php echo $current_item['biz_location_latitude']; ?>, lng: <?php echo $current_item['biz_location_longitude']; ?>};
								var map = new google.maps.Map(document.getElementById('map'), {
									zoom: 20,
									center: biz_location
								});
								var marker = new google.maps.Marker({
									position: biz_location,
									map: map
								});
							}
						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrIqwPxTThkgimZJDHRg_eaXp9FpOiKvc&callback=initMap"
							async defer>
						</script>
					</div>

					<div class="box-footer">		
					</div>
				</div>			
			</div>			
		</div><!-- /.row (main row) -->		
		<?php } ?>

		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Categories List</h3>
					</div>

					<?php 
						echo'<a href="' . base_url()  . 'businessTypes/add/ " style="float: right;" class="btn btn-info be-edit-btn"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Category</a>';
					?>

					<div class="box-body table-responsive">
						<table id="be-table-main" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No.</th>
                                    <th>Name</th>
									<th>Related Businesses</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
                                	$i = 0;
									foreach($data['categories'] as $item) {
                                    	$i++;
                                        echo '
											<tr>
												<td>' . $i . '</td>
                                        		<td>' . $item['category_name'] . '</td>                                        			
                                        	</tr>
                                        ';
                                    }
                                ?>
                            </tbody>
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
							<h4>All activities of this user will be restricted.<br><br>
								Are you sure to suspend this user?
							</h4>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-warning">Suspend</button>
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