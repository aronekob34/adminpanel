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

                        <li class="treeview <?php echo ($data['class'] == 'users') ? 'active' : ''; ?>" >
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-users"></i> <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo ($data['class'] == 'users' && $$data['method'] == 'addnew') ? 'active' : ''; ?>"><a href="<?php echo base_url("users/addnew"); ?>"><i class="fa fa-circle-o text-red"></i> Create new user</a></li>
                                <li class="<?php echo ($data['class'] == 'users' && $$data['method'] == 'viewall') ? 'active' : ''; ?>"><a href="<?php echo base_url("users/index"); ?>"><i class="fa fa-circle-o text-blue"></i> View All</a></li>
                            </ul>
                        </li>
                       
                        <li class="treeview <?php echo ($class == 'products') ? 'active' : ''; ?>" >
                            <a href="<?php echo base_url(); ?>">
                                <i class="ion ion-cube"></i> <span>Products</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo ($class == 'products' && $method == 'addnew') ? 'active' : ''; ?>"><a href="<?php echo base_url("product/addnew"); ?>"><i class="fa fa-circle-o text-red"></i> Add new</a></li>
                                <li class="<?php echo ($class == 'products' && $method == 'viewall') ? 'active' : ''; ?>"><a href="<?php echo base_url("product/viewall"); ?>"><i class="fa fa-circle-o text-blue"></i> View All</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo ($data['class'] == 'patients') ? 'active' : ''; ?>" >
                            <a href="<?php echo base_url(); ?>">
                                <i class="ion ion-person-stalker"></i> <span>Patients</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo ($data['class'] == 'users' && $$data['method'] == 'addnew') ? 'active' : ''; ?>"><a href="<?php echo base_url("patients/addnew"); ?>"><i class="fa fa-circle-o text-red"></i> Add new</a></li>
                                <li class="<?php echo ($data['class'] == 'users' && $$data['method'] == 'viewall') ? 'active' : ''; ?>"><a href="<?php echo base_url("patients/index"); ?>"><i class="fa fa-circle-o text-blue"></i> View All</a></li>

                            </ul>
                        </li>

                        <li class="treeview <?php echo ($data['class'] == 'interventions') ? 'active' : ''; ?>" >
                            <a href="<?php echo base_url('interventions/addnew'); ?>">
                                <i class="fa fa-money"></i> <span>Interventions</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo ($data['class'] == 'interventions' && $data['method'] == 'addnew') ? 'active' : ''; ?>"><a href="<?php echo base_url("interventions/addnew"); ?>"><i class="fa fa-circle-o text-red"></i> Add new</a></li>
                                <li class="<?php echo ($data['class'] == 'interventions' && $data['method'] == 'viewall') ? 'active' : ''; ?>"><a href="<?php echo base_url("interventions/index"); ?>"><i class="fa fa-circle-o text-blue"></i> View All</a></li>
                            </ul>
                        </li>

                        
                        <li class="treeview <?php echo ($data['class'] == 'pharmacies') ? 'active' : ''; ?>" >
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-plus-square"></i> <span>Pharmacies</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                 <li class="<?php echo ($data['class'] == 'pharmacies' && $data['method'] == 'addnew') ? 'active' : ''; ?>"><a href="<?php echo base_url("pharmacies/addnew"); ?>"><i class="fa fa-circle-o text-red"></i> Add new</a></li>
                                 <li class="<?php echo ($data['class'] == 'pharmacies' && $data['method'] == 'viewall') ? 'active' : ''; ?>"><a href="<?php echo base_url("pharmacies/index"); ?>"><i class="fa fa-circle-o text-blue"></i> View All</a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo ($data['class'] == 'bandagisteries') ? 'active' : ''; ?>" >
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-medkit"></i> <span>Bandagisteries</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo ($data['class'] == 'bandagisteries' && $data['method'] == 'addnew') ? 'active' : ''; ?>"><a href="<?php echo base_url("bandagisteries/addnew"); ?>"><i class="fa fa-circle-o text-red"></i> Add new</a></li>
                                <li class="<?php echo ($data['class'] == 'bandagisteries' && $data['method'] == 'viewall') ? 'active' : ''; ?>"><a href="<?php echo base_url("bandagisteries/index"); ?>"><i class="fa fa-circle-o text-blue"></i> View All</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="<?php echo base_url(); ?>site_info/">
                                <i class="fa fa-info-circle"></i> <span>Company Information</span>
                            </a>
                        </li>
                        <li class="treeview <?php echo ($class == 'Settings') ? 'active' : ''; ?>">

                        <a href="#">

                            <i class="fa fa-cog"></i>

                            <span>Settings</span>

                            <i class="fa fa-angle-left pull-right"></i>

                        </a>
                        <ul class="treeview-menu">

                            <li class="<?php echo ($class == 'Settings' && $method == 'category' || $method == 'editcat') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url(); ?>">
                                    <i class="fa fa-circle-o text-red"></i> Category
                                </a>
                            </li>
                            <li class="<?php echo ($class == 'Settings' && $method == 'colorcode') ? 'active' : ''; ?>">

                                <a href="<?php echo base_url(); ?>">
                                    <i class="fa fa-circle-o text-red"></i>  Color Code
                                </a>
                            </li>

                        </ul>
                    </li>   
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
			<aside class="right-side">
				<!-- Content Header (Page header) -->
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
