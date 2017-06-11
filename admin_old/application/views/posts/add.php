	<!-- Main content -->
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
							<input type="text" name="title" class="form-control" id="be-input-product-category-title" placeholder="Enter New Category Title" value="<?php if(isset($response) && $response['result'] == 0 && isset($_POST['title'])) echo $_POST['title']; ?>">
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					<input type="hidden" name="tag" value="add">
				</form>
			</div>
			</div>
		</div><!-- /.row (main row) -->
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	$i = 0;
                                        	foreach($data['categories'] as $category) {
                                        		$i++;
                                        		echo '
                                        		<tr>
                                        			<td>' . $i . '</td>
                                        			<td>' . $category['title'] . '</td>
                                        		</tr>
                                        		';
                                        	} 
                                        	?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Category No.</th>
                                                <th>Title</th>
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