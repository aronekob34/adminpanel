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
                            <p>Hello, <?php echo $user['user_first_name']; ?></p>

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

                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-users"></i> <span>Users</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="ion ion-cube"></i> <span>Products</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="ion ion-person-stalker"></i> <span>Patients</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-money"></i> <span>Interventions</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-plus-square"></i> <span>Pharmacies</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-medkit"></i> <span>Bandagisteries</span>
                            </a>
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
								<b>
                                    <?php 
                                        $msg = "";
                                        switch($response['result']) {
                                            case 0:
                                                $msg = config_item('msg_canceled');
                                                break;
                                            case 1:
                                                $msg = config_item('msg_success');
                                                break;
                                            case 2:
                                                $msg = config_item('msg_fill_form');
                                                break;
                                            default:
                                                $msg = config_item('msg_failed');
                                        }
                                        
                                        echo $msg; 
                                    ?>
                                </b> 
								<?php if(isset($response['report']['msg'])) echo $response['report']['msg']; ?>
							</div>
						</div>
					</div>
				<?php } ?>
