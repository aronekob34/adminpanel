<body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo $site_info['site_name']; ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="">
                            <a href="<?php echo $site_info['front_url']; ?>" target="_blank">
                                <i class="fa fa-external-link"></i> Visit Front-end Site
                            </a>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $user['user_first_name'] . ' ' . $user['user_last_name']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url(); ?>assets/images/logo/logo_thumb.png" class="img-circle" alt="User Image" />
                                    <p>
                                    	<?php echo element('title', element($user['user_role'], config_item('user_role'))); ?>
                                    	<br>
                                    	<?php echo $site_info['site_name']; ?> - Dashboard
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo base_url(); ?>user/logout/" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <input type="hidden" id="be-admin-user-id" name="be_admin_user_id" value="<?php echo $user['id']; ?>">
       		<input type="hidden" id="be-home-url" name="be_home_url" value="<?php echo base_url(); ?>">
       		<input type="hidden" id="be-file-upload-imagename-separator" value="<?php echo config_item('file_upload_imagename_separator') ?>">
        </header>