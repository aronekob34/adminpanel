	<div class="container be-container-signup">
		<div class="col-xs-12">
			<div class="be-font-s36 margin-top-20">
          		Please fill the form below
			</div>
			<div class="be-home-signup-form margin-top-30">
				<form action="<?php echo base_url(); ?>user/login" id="be-home-login-form" method="post" class="form-horizontal">
		          	<div class="form-group margin-top-50">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
			                <input type="email" name="email" class="form-control be-form-input be-form-input-grey" placeholder="Email" value="<?php echo (isset($_REQUEST['email'])) ? $_REQUEST['email'] : ''; ?>">
			              </div><!-- end controls-->
		            </div><!-- end form-group -->
		            
		            <div class="form-group margin-top-30">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
			                <input type="password" name="password" class="form-control be-form-input be-form-input-grey" placeholder="Password" value="<?php echo (isset($_REQUEST['password'])) ? $_REQUEST['password'] : ''; ?>">
			              </div><!-- end controls-->
		            </div><!-- end form-group -->
		            <div class="form-group margin-top-40">
			              <div class="controls col-xs-12 col-md-6 col-md-offset-3">
		            			<input class="btn btn-orange submit-btn be-form-input width-100pc" type="submit" value="Sign In">
	              		  </div>
	                </div>
		          	<input type="hidden" name="tag" value="login">
				</form>
			</div>
        </div>
		<div class="clear"></div>
	</div>