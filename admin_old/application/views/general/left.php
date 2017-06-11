<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>assets/images/logo/logo_thumb.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $user['first_name']; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Pet Owners</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                	<a href="<?php echo base_url(); ?>users/users_edit"><i class="fa fa-list"></i> Users</a>
                                </li>
                                <li>
                                	<a href="<?php echo base_url(); ?>users/suspended_users"><i class="fa fa-lock"></i> Suspended Users</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Groups</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                	<a href="<?php echo base_url(); ?>groups/groups_edit"><i class="fa fa-refresh"></i> Active Groups</a>
                                </li>
                                <li>
                                	<a href="<?php echo base_url(); ?>groups/closed_groups"><i class="fa fa-times"></i> Closed Groups</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-file-text-o"></i>
                                <span>Requests</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li>
                                	<a href="<?php echo base_url(); ?>requests/all"><i class="fa fa-eye"></i> View All</a>
                                </li>
                                <li>
                                	<a href="<?php echo base_url(); ?>requests/pending"><i class="fa fa-step-forward"></i> Pending Requests</a>
                                </li>
                                <li>
                                	<a href="<?php echo base_url(); ?>requests/ongoing"><i class="fa fa-play"></i> Accepted Requests</a>
                                </li>
                                <li>
                                	<a href="<?php echo base_url(); ?>requests/cancelled"><i class="fa fa-eject"></i> Rejected Requests</a>
                                </li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>site_info/">
                                <i class="fa fa-info-circle"></i> <span>Company Information</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
			<aside class="right-side">
				<!-- Content Header (Page header) -->
			 	<section class="content-header">
					<h1><?php echo $page_title; ?></h1>
					<?php echo $breadcrumb; ?>
				</section>
				<section class="content">
				<?php if(isset($response)) { ?>
					<div class="row col-md-12">
						<div class="box-body">
							<div class="alert <?php echo ($response['result'] == 1 ? 'alert-success' : 'alert-danger'); ?> alert-dismissable">
								<i class="fa <?php echo ($response['result'] == 1 ? 'fa-check' : 'fa-ban'); ?>"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<b><?php echo ($response['result'] == 1 ? config_item('msg_success') : config_item('msg_failed')); ?></b> 
								<?php if(isset($response['report']['msg'])) echo $response['report']['msg']; ?>
							</div>
						</div>
					</div>
				<?php } ?>
