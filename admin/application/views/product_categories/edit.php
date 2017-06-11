	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) { ?>
		<div class="row">
			<div class="col-md-6">
	        <div class="box box-primary">
	            <div class="box-header">
					<h3 class="box-title">Input Fields</h3>
				</div>
				<form role="form" action="" method="post">
					<div class="box-body">
						<div class="form-group">
							<label for="be-input-product-category-title">Category Title</label>
							<input type="text" name="title" class="form-control" id="be-input-product-category-title" placeholder="Enter New Category Title" value="<?php
							if(isset($response) && $response['result'] == 0 && isset($_POST['title']))
								echo $_POST['title'];
							else
								echo element('title', $this->be_model->get_category($data['edit_id']));
							?>">
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					<input type="hidden" name="tag" value="edit">
				</form>
			</div>
			</div>
		</div><!-- /.row (main row) -->
		
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Categories List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-product-categories-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Category No.</th>
                                                <th>Title</th>
                                                <th></th>
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
                                        			<td>' . $item['title'] . '</td>
                                        			<td align="center">
                                        				&nbsp;<a href="' . base_url() . $page . '/' . $item['id'] . '" class="btn btn-info be-edit-btn" title="Edit"><i class="fa fa-edit"></i> Edit</a>&nbsp;
                                        				&nbsp;<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(' . $item['id'] . ');"><i class="fa fa-trash-o"></i> Remove</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	} 
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Category No.</th>
                                                <th>Title</th>
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
		            	<h4>All the products in this category should also be removed.<br><br>
		            	Do you really confirm to remove the item?</h4>
		            </div>
		            <div class="modal-footer">
		            	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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