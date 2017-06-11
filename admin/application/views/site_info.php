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
					$fields = array(
							array('field_name' => 'site_title', 'field_title' => 'Site Title', 'field_mandatory' => true),
							array('field_name' => 'site_name', 'field_title' => 'Site Name', 'field_mandatory' => true),
							array('field_name' => 'meta_keywords', 'field_title' => 'Meta Keywords'),
							array('field_name' => 'meta_description', 'field_title' => 'Meta Description'),
							array('field_name' => 'owner_phone', 'field_title' => 'Owner Phone'),
							array('field_name' => 'owner_fax', 'field_title' => 'Owner Fax'),
							array('field_name' => 'owner_email', 'field_title' => 'Owner Email', 'field_mandatory' => true),
							array('field_name' => 'owner_address', 'field_title' => 'Owner Address'),
							array('field_name' => 'owner_visit_address', 'field_title' => 'Owner Visit Address'),
							array('field_name' => 'owner_site', 'field_title' => 'Owner Site', 'field_mandatory' => true),
							array('field_name' => 'site_url_name', 'field_title' => 'Site URL', 'field_mandatory' => true),
							array('field_name' => 'from_email', 'field_title' => 'From Email', 'field_mandatory' => true)
						);
					foreach($fields as $item) {
					?>
						<div class="form-group">
							<label for="be-input-product-category-title"><?php echo $item['field_title']; ?><?php if(isset($item['field_mandatory']) && $item['field_mandatory']) echo ' *'; ?></label>
							<input type="text" name="<?php echo $item['field_name']; ?>" class="form-control" placeholder="Enter <?php echo $item['field_title']; ?>" value="<?php if(isset($_REQUEST[$item['field_name']])) echo $_REQUEST[$item['field_name']]; else echo $site_info[$item['field_name']]; ?>">
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