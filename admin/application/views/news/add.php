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
							<input type="text" name="title" class="form-control" id="be-input-product-category-title" placeholder="Enter News Title" value="<?php if(isset($response) && $response['result'] == 0 && isset($_POST['title'])) echo $_POST['title']; ?>">
						</div>
						<div class="form-group">
							<label>Upload Image *</label>
							<br>
							<div>
								<input type="file" name="image_file">
							</div>
						</div>
						<div class="form-group">
							<label for="be-input-product-content">Content *</label>
							<textarea id="editor_content" name="content" rows="10" cols="50" placeholder="Enter News Content"><?php if(isset($response) && $response['result'] == 0 && isset($_POST['content'])) echo $_POST['content']; ?></textarea>
						</div>
					</div>
					
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<input type="hidden" name="tag" value="add">
					</div>
				</div>
			</div>
		</form>
		</div><!-- /.row (main row) -->
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
                                            </tr>
                                        </tfoot>
                                    </table>
				</div><!-- /.box-body -->
			</div>
			</div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>