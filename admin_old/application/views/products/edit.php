	<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$product = $this->be_model->get_product($data['edit_id']);
		?>
		
		
		<div class="row">
			<form action="" method="post" id="be-products-form" enctype="multipart/form-data">
			<div class="col-md-8">
	        <div class="box box-primary">
	        
	            <div class="box-header">
					<h3 class="box-title">Input Fields</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="be-input-product-title">Product Title</label>
						<input type="text" name="title" class="form-control" id="be-input-product-title" placeholder="Enter Product Title" value="<?php
							if(isset($response) && $response['result'] == 0 && isset($_POST['title']))
								echo $_POST['title'];
							else
								echo $product['title'];
						?>">
					</div>
					<div class="form-group">
						<label for="be-input-product-category-id">Category</label>
						<select name="category_id" id="be-input-product-category-id" class="form-control">
						<?php 
							foreach($data['categories'] as $category) {
								echo '<option value="' . $category['id'] . '"';
								if(isset($response) && $response['result'] == 0 && isset($_POST['category_id'])) {
									echo (($_POST['category_id'] == $category['id']) ? ' selected' : '');
								} else {
									echo (($product['category_id'] == $category['id']) ? ' selected' : '');
								}
								echo '>' . $category['title'] . '</option>';
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label for="be-input-product-content">Content</label>
						<textarea id="editor_content" name="content" rows="10" cols="80" placeholder="Enter Product Content"><?php
							if(isset($response) && $response['result'] == 0 && isset($_POST['content']))
								echo $_POST['content'];
							else
								echo $product['content'];
						?></textarea>
					</div>
					
					<div class="form-group">
						<label for="be-input-product-title">Product Information</label>
						<ul class="tabs3">
						<?php
						foreach(config_item('product_details') as $field => $field_title) {
							echo '
							<li><a href="#be-product-detail-tab-' . $field . '">' . $field_title . '</a></li>
							';
						}
						?>
				        </ul>
				        <div class="tabs-content3 two">
				        <?php
						foreach(config_item('product_details') as $field => $field_title) {
							echo '
							<div id="be-product-detail-tab-' . $field . '" class="tabs-panel3">
                                <div class="box-body pad">
									<textarea id="editor_' . $field . '" name="' . $field . '" rows="10" cols="80" placeholder="Enter the Product Information for ' . $field_title . '">';
									if(isset($response) && $response['result'] == 0 && isset($_POST[$field]))
										echo $_POST[$field];
									else
										echo $product[$field];
									echo '</textarea>
                                </div>
                            </div>
							';
						}
						?>
				        </div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			
			</div>
			</div>
			<div class="col-md-4">
	        <div class="box box-primary">
	            <div class="box-header">
					<h3 class="box-title">Input Files</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Upload Product Images</label>
						<br>
						<div class="form-group be-product-edit-old-image-item">
							<div class="checkbox">
							<?php
							$i = 0;
							foreach($product['images'] as $image) {
								echo '
								<div style="margin-bottom:10px;">
								<label title="Uncheck to remove image">
									<input type="checkbox" checked="checked" name="image_ids[]" value="' . $image['id'] . '"> <img src="' . $site_info['front_url'] . config_item('path_products_thumb') . $image['image'] . '">
								</label>
								</div>
								';
								$i++;
								//if($i % 4 == 0) echo '<br><br>';
							}
							?>
								<br>
								<label onclick="be_product_toggle_add_new_images();">
									<input type="checkbox" name="add_new_image" id="be-product-edit-upload-new-image">&nbsp;&nbsp;Upload New Images
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			
				<input id="be-file-upload-count" name="be_file_upload_count" type="hidden" value="<?php
					if(isset($response) && $response['result'] == 0 && isset($_POST['be_file_upload_count']))
						echo $_POST['be_file_upload_count'];
					else
						echo 0;
					?>">
				
				<input id="be-file-upload-name" name="be_file_upload_name" type="hidden" value="<?php
					if(isset($response) && $response['result'] == 0 && isset($_POST['be_file_upload_name']))
						echo $_POST['be_file_upload_name'];
					else
						echo '';
					?>">
				
				<input id="be-file-upload-count-general" name="be_file_upload_count_general" type="hidden" value="<?php
					if(isset($response) && $response['result'] == 0 && isset($_POST['be_file_upload_count_general']))
						echo $_POST['be_file_upload_count_general'];
					else
						echo 0;
					?>">
					
				<input type="hidden" name="tag" value="edit">
				<input type="hidden" id="be-file-upload-max-limit" name="max_limit" value="10">
			
			</form>
			<div class="col-md-4">
		        <div class="box" id="be-product-add-new-images"<?php if(!(isset($_POST['add_new_image']) && $_POST['add_new_image'] == 'on')) echo 'style="display:none;"'; ?>>
					<div class="form-group">
						<form id="be-file-upload" method="post" action="<?php echo base_url(); ?>file_upload/" enctype="multipart/form-data">
							<div id="drop">
								Drop Here
								<br>
								<a>Browse</a>
								<input type="file" name="upl" multiple />
							</div>
							<ul>
								<!-- The file uploads will be shown here -->
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php } ?>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Products List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-products-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product No.</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	foreach($data['products'] as $item) {
                                        		$i++;
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>' . $item['title'] . '</td>
                                        			<td>' . $item['category_title'] . '</td>
                                        			<td align="center">
                                        				&nbsp;&nbsp;<a href="' . base_url() . $page . '/' . $item['id'] . '" class="btn btn-info be-edit-btn" title="Edit"><i class="fa fa-edit"></i> Edit</a>&nbsp;
                                        				&nbsp;<a class="btn btn-danger be-remove-btn" title="Remove" onclick="be_open_remove_form_modal(' . $item['id'] . ');"><i class="fa fa-trash-o"></i> Remove</a>&nbsp;
                                        			</td>
                                        		</tr>
                                        		';
                                        	}
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Product No.</th>
                                                <th>Title</th>
                                                <th>Category</th>
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
		            	<h4>Do you really confirm to remove the item?</h4>
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