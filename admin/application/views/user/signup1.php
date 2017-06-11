	<div class="container be-container-signup">
		<div class="col-xs-12">
			<div class="be-font-s36 margin-top-20">
          		SIGN UP NOW! AND START SHARING
			</div>
			<div class="be-home-signup-form margin-top-30">
				<form action="<?php echo base_url(); ?>user/signup" id="be-home-signup-form1" method="post" class="form-horizontal">
		          	<div class="form-group margin-top-50">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
			                <input type="text" name="bio" class="form-control be-form-input be-form-input-grey" placeholder="Bio" value="<?php echo (isset($_REQUEST['bio'])) ? $_REQUEST['bio'] : ''; ?>">
			              </div><!-- end controls-->
		            </div><!-- end form-group -->
		            
		            <div class="form-group margin-top-30">
			              <div class="controls col-xs-12 col-md-3 col-md-offset-3 be-home-signup-form-select">
			               <select name="country" title="Country" class="form-control be-form-input be-form-input-grey be-form-input-country">
			               	<option value="">- Select Country -</option>
			              	<?php
			              		$countries = $this->be_model->get_countries_list();
			              		foreach($countries as $country) {
			              			echo '<option value="' . $country . '"';
			              			if(isset($_REQUEST['country']) && ($_REQUEST['country'] == $country)) echo ' selected="selected"';
			              			echo '>' . $country . '</option>';
			              		}
			              	?>
			              	</select>
			              </div><!-- end controls-->
			              <div class="controls col-xs-12 col-md-3">
			               		<input type="text" name="zip" class="form-control be-form-input be-form-input-grey be-form-input-zip" maxlength="6" placeholder="Zip Code" value="<?php echo (isset($_REQUEST['zip'])) ? $_REQUEST['zip'] : ''; ?>">
			              </div><!-- end controls-->
		            </div><!-- end form-group -->
		            
		            <div class="form-group margin-top-30">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
			                <input type="text" name="city" class="form-control be-form-input be-form-input-grey be-form-input-city" placeholder="City" value="<?php echo (isset($_REQUEST['city'])) ? $_REQUEST['city'] : ''; ?>">
			              </div><!-- end controls-->
		            </div><!-- end form-group -->
		            
		            <div class="form-group margin-top-30">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
			                <input type="text" name="genre" class="form-control be-form-input be-form-input-grey be-form-input-genre" placeholder="Genres" value="<?php echo (isset($_REQUEST['genre'])) ? $_REQUEST['genre'] : ''; ?>">
			              </div><!-- end controls-->
		            </div><!-- end form-group -->
		            <div class="form-group margin-top-40">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
		            			<input class="btn btn-orange submit-btn be-form-input width-100pc" type="submit" value="Go to Next Step">
	              		  </div>
	                </div>
		          	<input type="hidden" name="tag" value="signup2">
		          	<?php if(isset($requests)) $this->be_model->set_hidden_tags($requests);	?>
				</form>
			</div>
        </div>
		<div class="clear"></div>
	</div>