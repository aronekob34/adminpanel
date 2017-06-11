	<!-- Main content -->
		<div class="row">
			<div class="col-md-12">
	        <div class="box box-primary">
	            <div class="box-header">
					<h3 class="box-title">Input Fields</h3>
				</div>
				<form role="form" action="" method="post">
					<div class="box-body">
					<?php
					$fields = array();
					for($i = 1; $i <= config_item('home_videos_count'); $i++) {
						$fields[] = array('field_id' => $i, 'field_name' => 'video' . $i, 'field_title' => 'Video ' . $i);
					}
					foreach($fields as $item) {
					?>
						<div class="form-group">
							<label for="be-input-product-category-title"><?php echo $item['field_title']; ?></label>
							<input type="text" name="<?php echo $item['field_name']; ?>" class="form-control" placeholder="Enter <?php echo $item['field_title']; ?>" value="<?php if(isset($_REQUEST[$item['field_name']])) echo $_REQUEST[$item['field_name']]; else echo $home_page_settings['videos'][$item['field_id']]; ?>">
						</div>
					<?php } ?>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					<input type="hidden" name="tag" value="edit">
				</form>
			</div>
			</div>
		</div><!-- /.row (main row) -->
		
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>