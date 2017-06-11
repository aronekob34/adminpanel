	<!-- Main content -->
		<div class="row">
		
		<?php
			if(!isset($response)) $response = array();
			$request_fields = array('bg1', 'bg2', 'bg3', 's1_delay', 's2_delay', 's3_delay', 's1_p1', 's1_p2', 's2_p1', 's2_p2',
				's1_t1', 's1_t2', 's1_t3', 's2_t1', 's2_t2', 's3_t1', 's3_t2', 's3_t3');
			$path = $site_info['front_url'] . config_item('path_home_slider');
			
			function get_admin_home_slider_field_img($field, $title, $w, $h, $home_slider, $path, $response = array()) {
				$post_checked = !!((isset($response['result']) && $response['result'] != 1) && isset($_POST[$field . '_check']) && $_POST[$field . '_check'] == 'on');
				$str = '
				<div class="form-group">
					<label for="be-input-product-category-title">' . $title . ' (' . $w . '*' . $h . ')</label>
					<br>
					<img src="' . $path . $home_slider[$field] . '" style="width:' .(($w >= 720) ? (int)(100 / 1920 * $w) : (int)(100 / 1600 * $w))  . '%;">
					<input type="hidden" name="' . $field . '" value="' . $home_slider[$field] . '" />
				</div>
				<div class="form-group1">
					<input type="checkbox" id="be-hsid-new-img-' . $field . '-check" name="' . $field . '_check"' . (($post_checked) ? ' checked="checked"' : '') . '>
					<label for="be-hsid-new-img-' . $field . '-check" id="be-hsid-new-img-' . $field . '" class="be-hsid-new-img"> Change Image</label>
					<div id="be-hsid-new-img-' . $field . '-add" style="margin-top:12px; margin-bottom:12px;' . ((!$post_checked) ? ' display:none;' : '') . '">
						<input type="file" name="' . $field . '_file"> Upload JPG/PNG Files of <b>' . $w . 'px * ' . $h . 'px</b>
					</div>
				</div>
				';
				return $str;
			}
			function get_separator() {
				return '<div style="width:100%; height:1px; margin:15px 0 15px 0; background:#999;"></div>';
			}
			function get_admin_home_slider_field_text($field, $title, $h, $home_slider, $response = array()) {
				
				$str = '
				<div class="form-group">
 					<label for="be-input-product-category-title">' . $title . '</label>
 					<textarea class="form-control" name="' . $field . '" rows="' . $h . '" placeholder="Enter ' . $title . '">' . ((isset($_REQUEST[$field])) ? $_REQUEST[$field] : $home_slider[$field]) . '</textarea>
 				</div>
				';
				return $str;
			}
		?>
		<form role="form" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="tag" value="edit">
			
			<div class="col-md-6">
	        <div class="box box-primary">
	            <div class="box-header">
					<h3 class="box-title">Slider 1</h3>
				</div>
				<div class="box-body">
				<?php
				echo get_admin_home_slider_field_img('bg1', 'Background', 1920, 580, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s1_delay', 'Animation Delay (in seconds)', 1, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_img('s1_p1', 'Photo 1', 384, 490, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_img('s1_p2', 'Photo 2', 266, 250, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s1_t1', 'Text 1', 3, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s1_t2', 'Text 2', 3, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s1_t3', 'Text 3', 3, $home_slider, $response);
				?>
				</div>
			</div>
			</div>
			
			
			<div class="col-md-6">
	        <div class="box box-primary">
	            <div class="box-header">
					<h3 class="box-title">Slider 2</h3>
				</div>
				<div class="box-body">
				<?php
				echo get_admin_home_slider_field_img('bg2', 'Background', 1920, 580, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s2_delay', 'Animation Delay (in seconds)', 1, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_img('s2_p1', 'Photo 1', 500, 550, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_img('s2_p2', 'Photo 2', 233, 380, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s2_t1', 'Text 1', 3, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s2_t2', 'Text 2', 3, $home_slider, $response);
				?>
				</div>
			</div>
			</div>
			
			
			<div class="col-md-6">
	        <div class="box box-primary">
	            <div class="box-header">
					<h3 class="box-title">Slider 3</h3>
				</div>
				<div class="box-body">
				<?php
				echo get_admin_home_slider_field_img('bg3', 'Background', 1920, 580, $home_slider, $path, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s3_delay', 'Animation Delay (in seconds)', 1, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s3_t1', 'Text 1', 3, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s3_t2', 'Text 2', 3, $home_slider, $response);
				echo get_separator();
				echo get_admin_home_slider_field_text('s3_t3', 'Text 2', 3, $home_slider, $response);
				?>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
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
		
	</section><!-- /.content -->
</aside><!-- /.right-side -->
</div>