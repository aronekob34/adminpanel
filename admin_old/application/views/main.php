<body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><img src="<?php echo base_url() ; ?>assets/images/logo/logo_login_top.png"></div>
            <form action="<?php echo base_url(); ?>user/login/" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo (isset($_REQUEST['email'])) ? $_REQUEST['email'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="">
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-navy btn-block">Sign me in</button>  
                </div>
                <input type="hidden" name="tag" value="login">
            </form>
        </div>