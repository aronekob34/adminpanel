<html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-gb" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $site_info['site_name']; ?> | Admin Panel</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo/favicon.png">
    <!-- for FF, Chrome, Opera -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo/favicon-32x32.png" sizes="32x32">

    <!-- for IE -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/logo/favicon.ico" >
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/logo/favicon.ico"/>
	
	<!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url(); ?>assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url(); ?>assets/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url(); ?>assets/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url(); ?>assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
	<link href="<?php echo base_url(); ?>assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
    <!-- File Upload -->
    <link href="<?php echo base_url(); ?>assets/file_upload/css/style.css" rel="stylesheet" />
    
	<!-- tabs -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/tabs/assets/css/responsive-tabs3.css">
    
    <!-- Krajee Bootstrap Star Rating -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/rating/star-rating.css" media="all" type="text/css"/>
    
    
    
    <!-- Be StyleSheet -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/be_tags.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/be_styles.css" type="text/css" />
	
	<!-- jQuery 2.0.2 -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <?php if ( !empty( $styles ) ): ?>
            <?php foreach ( $styles as $style ): ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $style['href']; ?>"  />
            <?php endforeach; ?>
    <?php endif; ?>
</head>