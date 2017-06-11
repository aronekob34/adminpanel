		<!-- Main content -->
		<div id="be-edit-form-position"></div>
		
		<?php
		if(isset($data['edit_id']) && (!isset($response) || (isset($response) && $response['result'] != 1))) {
			$news = $this->be_model->get_news($data['edit_id']);
			$path = $site_info['front_url'] . config_item('path_newsroom');
			$field = 'image';
			$post_checked = !!((isset($response['result']) && $response['result'] != 1) && isset($_POST[$field . '_check']) && $_POST[$field . '_check'] == 'on');
		?>
		<!-- Main content -->
		<div class="row">
		<form role="form" action="" method="post" enctype="multipart/form-data">
			<div class="col-md-9">
		        <div class="box box-primary">
		            <div class="box-header">
						<h3 class="box-title">Input Fields</h3>
					</div>
				
					<div class="box-body">
						<div class="form-group">
							<label for="be-input-product-category-title">Title *</label>
							<input type="text" name="title" class="form-control" id="be-input-product-category-title" placeholder="Enter News Title" value="<?php if(isset($response) && $response['result'] == 0 && isset($_POST['title'])) echo $_POST['title']; else echo $news['title']; ?>">
						</div>
						<div class="form-group">
							<label>Upload Image *</label>
							<br>
							<img src="<?php echo $path . $news['image']; ?>">
							<input type="hidden" name="image" value="<?php echo $news['image']; ?>">
						</div>
						<div class="form-group">
							<input type="checkbox" id="be-hsid-new-img-check" name="image_check"<?php if($post_checked) echo ' checked="checked"'; ?>>
							<label for="be-hsid-new-img-check" id="be-hsid-new-img" class="be-hsid-new-img"> Change Image</label>
							
							<div id="be-hsid-new-img-add" style="margin-top:12px; margin-bottom:12px;<?php if(!$post_checked) echo ' display:none;'; ?>">
								<input type="file" name="image_file">
							</div>
						</div>
						<div class="form-group">
							<label for="be-input-product-content">Content *</label>
							<textarea id="editor_content" name="content" rows="10" cols="40" placeholder="Enter News Content"><?php if(isset($response) && $response['result'] == 0 && isset($_POST['content'])) echo $_POST['content']; else echo $news['content']; ?></textarea>
						</div>
					</div>
					
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<input type="hidden" name="tag" value="edit">
					</div>
				</div>
			</div>
		</form>
		</div><!-- /.row (main row) -->
		<script type="text/javascript">
			$('label.be-hsid-new-img').click(function() {
				$('#' + $(this).attr('id') + '-add').toggle($('#' + $(this).attr('id') + '-check:checked').length == 0);
			});
		</script>
		
		<?php } ?>
		
		<div class="row">
			<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">News List</h3>
				</div>
				<div class="box-body table-responsive">
                                    <table id="be-table-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>News No.</th>
                                                <th>Title</th>
                                                <th>Publish Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	foreach($data['news'] as $item) {
                                        		$i++;
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>' . character_limiter($item['title'], 120) . '</td>
                                        			<td>' . date("F j, Y, g:i A", strtotime($item['date_created'])) . '</td>
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
                                                <th>News No.</th>
                                                <th>Title</th>
                                                <th>Publish Date</th>
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