<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Title -->
    <title><?php echo $CI->comp_pre->c_org_name;?> - <?php echo (isset($title))?$title: 'Login'; ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="sales management sytem, enquiry management system, procurement management system, wholesale management system, warehouse management, inventory management, account, billing, pettycash, purchase order" />
    <meta name="keywords" content="sales management sytem, enquiry management system, procurement management system, wholesale management system, warehouse management, inventory management, account, billing, pettycash, purchase order" />
    <meta name="author" content="AGM Technical Solutions" />
    
    
    <!-- Styles -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
    
    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
    
    <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
    <body class="page-login">
        <main class="page-content">
            <div class="page-inner login-bg">
                <div id="main-wrapper">
                    <div class="login-box panel panel-white">
                    	<div class="panel-body">
                        	<div class="row">
                        		<div class="col-md-12 center">
                                    <a href="<?php echo base_url(); ?>" class="logo-name text-lg text-center">
                                        <?php
                                        if(file_exists($CI->comp_pre->c_logo))
                                        {
                                            ?>
                                                <img src="<?php echo base_url($CI->comp_pre->c_logo);?>" title="<?php echo $CI->comp_pre->c_org_name;?>" width="120">
                                            <?php
                                        }else
                                        {
                                            ?>
                                                <img src="<?php echo base_url('assets/images/gallery/favicon-with-square.png');?>" title="AGM Technical Solutions" width="120" >
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <h3 class="text-lg text-center">Sales Management System</h3>
                                    <p class="m-t-md"><b>Forgot Password.</b></p>
                                    <p class="m-t-md">Please enter your Email so we can send you an email to reset your password.</p>
                                    <?php echo (isset($content))? $content	:	''; ?>
                                 
                                    <p class="text-center m-t-xs text-sm"><?php echo '2019 - '.date('Y');?> &copy; <a href="http://agmtechnical.com/" target="_blank">AGM Technical Solutions</a></p>
                        		</div>
                    		</div><!-- Row -->
                    	</div>
                    </div>
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
	

        <!-- Javascripts -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/pace-master/pace.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modern.min.js"></script>
        
    </body>
</html>