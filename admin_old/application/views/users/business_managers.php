	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$current_item = $this->be_model->get_business_manager($data['edit_id']);
		?>
		<div class="row">
			<form role="form" action="<?php echo base_url() . $page; ?>" method="post">
				<div class="col-md-12 col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Edit</h3>
						</div>
						
						<div class="box-body">
							<div class="form-group">
								<label class="control-label" for="full_name">Full Name:</label>
								<input type="text" class="form-control" name="full_name" placeholder="Enter full name" value="<?php echo $current_item['full_name']; ?>">
							</div>

							<div class="form-group">
								<label class="control-label" for="email">Email:</label>
								<input type="text" class="form-control" name="email" placeholder="Enter email address" value="<?php echo $current_item['email']; ?>">
							</div>

							<div class="form-group">
								<label class="control-label" for="phone_number">Phone Number:</label>
								<input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" value="<?php echo $current_item['phone_number']; ?>">
							</div>

							<div class="form-group">
								<label class="control-label" for="phone_number">Gender:</label>
								<select class="form-control" name="gender">
									<option value="1" <?php if($current_item['gender'] == 1) echo 'selected'; ?>>Male</option>
									<option value="0" <?php if($current_item['gender'] == 0) echo 'selected'; ?>>Female</option>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label" for="password">Password:</label>
								<input type="password" class="form-control" name="password" placeholder="Enter new password" value="">
							</div>

						</div>

						<div class="box-footer">
							<input type="submit" class="btn btn-danger" name="submitted" value="Save">
							<input type="submit" class="btn btn-primary" name="submitted" value="Cancel">
							<input type="hidden" name="tag" value="edit">
		        			<input type="hidden" name="edit_id" value="<?php echo $data['edit_id']; ?>">
						</div>
					</div>
				</div>
			</form>			
		</div><!-- /.row (main row) -->
		
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Business Manager List</h3>
					</div>
					<div class="box-body table-responsive">
                    	<table id="be-table-main" class="table table-bordered table-striped">
                        	<thead>
                            	<tr>
                                	<th>No.</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Gender</th>
                                    <th width="124px"></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                                	$i = 0;
                                    foreach($data['business_managers'] as $item) {
                                    	$i++;
                                        		
                                        echo '
                                        	<tr>
                                        		<td>' . $i . '</td>
                                        		<td>' . $item['full_name'] . '</td>
                                        		<td>' . $item['email'] . '</td>
                                        		<td>' . $item['phone_number'] . '</td>
												<td>' . ($item['gender'] == 1 ? 'Male' : 'Female') . '</td>
                                        		<td align="center">
                                        			&nbsp;<a href="' . base_url() . $page . '/' . $item['id'] . '" class="btn btn-info be-edit-btn" title="Edit"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;
                                        			&nbsp;<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(' . $item['id'] . ');"><i class="fa fa-trash-o"></i>&nbsp;Remove</a>&nbsp;
                                        		</td>
                                        	</tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                            <!--<tfoot>
                            	<tr>
                                	<th>No.</th>
                                    <th>Full Name</th>
                                </tr>
                            </tfoot>-->
                        </table>
					</div><!-- /.box-body -->
				</div>
			</div>
		</div>

		<div class="modal fade be-remove-form-modal">
		    <div class="modal-dialog">
		    	<form role="form" action="<?php echo base_url() . $page; ?>" method="post" id="be-remove-form">
					<div class="modal-content">
						<!--<div class="modal-header">
							<h4>Result</h4>
						</div> -->

						<div class="modal-body">
							<h4>Are you sure to remove this system manager?</h4>
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