<?php
$CI = &get_instance();
$CI->load->model('common_model','mcommon',TRUE);
$aclCategory = $CI->mcommon->userACLCategories($auth_user_id);
?>
<!DOCTYPE html>
<html>
<!-- index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Feb 2016 09:23:22 GMT -->
<head>
    <!-- Title -->
    <title><?php echo $CI->comp_pre->c_org_name;?> - <?php echo (isset($title))? $title: '';?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="sales management sytem, enquiry management system, procurement management system, wholesale management system, warehouse management, inventory management, account, billing, pettycash, purchase order" />
    <meta name="keywords" content="sales management sytem, enquiry management system, procurement management system, wholesale management system, warehouse management, inventory management, account, billing, pettycash, purchase order" />
    <meta name="author" content="AGM Technical Solutions" />
    <link rel="short icon" type="image/png" href="<?php echo base_url(); ?>assets/images/gallery/favicon.ico">
    
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
    <link href="<?php echo base_url(); ?>assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>    
    <link href="<?php echo base_url(); ?>assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>  
    <link href="<?php echo base_url(); ?>assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/> 
    <link href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>   
    <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>

    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
     <link href="<?php echo base_url(); ?>assets/css/overwrite.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/> 
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/> 
    <link href="<?php echo base_url(); ?>assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/chartjs/utils.js"></script>
     <script src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>

    <!--
    <script src="<?php echo base_url(); ?>assets/css/summernote/dist/summernote-lite.css"></script>
    <script src="<?php echo base_url(); ?>assets/css/summernote/dist/summernote-lite.js"></script>
    -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
    
</head>
<body class="page-header-fixed page-horizontal-bar">
    <div class="overlay"></div>
    <!--
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
        <h3><span class="pull-left"></span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
       
    </nav>
   <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
        <h3><span class="pull-left">Sandra Smith</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
        <div class="slimscroll chat">
            <div class="chat-item chat-item-left">
                <div class="chat-image">
                    <img src="<?php echo base_url(); ?>assets/images/avatar2.png" alt="">
                </div>
                <div class="chat-message">
                    Hi There!
                </div>
            </div>
            <div class="chat-item chat-item-right">
                <div class="chat-message">
                    Hi! How are you?
                </div>
            </div>
            <div class="chat-item chat-item-left">
                <div class="chat-image">
                    <img src="<?php echo base_url(); ?>assets/images/avatar2.png" alt="">
                </div>
                <div class="chat-message">
                    Fine! do you like my project?
                </div>
            </div>
            <div class="chat-item chat-item-right">
                <div class="chat-message">
                    Yes, It's clean and creative, good job!
                </div>
            </div>
            <div class="chat-item chat-item-left">
                <div class="chat-image">
                    <img src="<?php echo base_url(); ?>assets/images/avatar2.png" alt="">
                </div>
                <div class="chat-message">
                    Thanks, I tried!
                </div>
            </div>
            <div class="chat-item chat-item-right">
                <div class="chat-message">
                    Good luck with your sales!
                </div>
            </div>
        </div>
        <div class="chat-write">
            <form class="form-horizontal" action="javascript:void(0);">
                <input type="text" class="form-control" placeholder="Say something">
            </form>
        </div>
   </nav>
   -->
   <!--
    <div class="menu-wrap">
        <nav class="profile-menu">
            <div class="profile"><img src="<?php echo base_url(); ?>assets/images/profile-menu-image.png" width="60" alt="David Green"/><span>David Green</span></div>
            <div class="profile-menu-list">
                <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a>
                <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a>
                <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a>
                <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a>
            </div>
        </nav>
        <button class="close-button" id="close-button">Close Menu</button>
    </div>
    -->
  <!--   <form class="search-form" action="#" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
            </span>
        </div>
    </form> -->
    <main>
        <div class="navbar">
            <div >
                <div class="sidebar-pusher mobile">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="logo-box">
                    <a href="<?php echo base_url(); ?>" class="logo-text"><span><img src="<?php echo base_url('assets/images/gallery/logo-white.png');?>" width="48" title="Warehouse Managment"> SMS</span></a>
                </div>
                <div class="topmenu-outer">
                    <div class="top-menu">
                        <ul class="nav navbar-nav navbar-left" >
                                         
                        </ul>
                         <ul class="nav navbar-nav navbar-left" style="margin-top: 10px;margin-left: 30px;">
                                            
                        </ul>
                         <ul class="nav navbar-nav navbar-left" style="margin-top: 10px;margin-left: 20px;">
                                            
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                           
                           <?php if( in_array('masters', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Masters<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                
                                   
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Department">Department</a></li>
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/Desgination">Designation</a></li>
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/Vendor_Management">Vendor ID Management</a></li>
                                     <hr>
                                       <li role="presentation"><a href="<?php echo base_url(); ?>masters/Tax">Tax</a></li>
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Currency">Currency</a></li> 
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/bank_details">Bank Details</a></li> 
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Payment_mode">Payment Mode</a></li>
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Payment_terms">Payment Terms</a></li> 
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/Quotation_Validity">Quotation Validity</a></li> 
                                    
                                </ul>
                            </li>
                            <?php endif;?>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Vendor<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Client">Client</a></li>
                                  <li role="presentation"><a href="<?php echo base_url(); ?>masters/Vendor">Supplier</a></li>
                                    
                                </ul>
                            </li>
                               <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Enquiry<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Enquiry">Enquiry</a></li>
                                    
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Quotation<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                  <!--   <li><a href="<?php echo base_url(); ?>Quotation">New Quotation</a></li> -->
                                    <li><a href="<?php echo base_url(); ?>Quotation/manage">Quotation</a></li>
                                     <li><a href="<?php echo base_url(); ?>Message_send">Whatsapp</a></li>
                                </ul>
                            </li>
                       
                          
                               <?php if( in_array('purchase', $aclCategory)): ?>
                                 <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Purchase Order<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li><a href="<?php echo base_url(); ?>Purchase_order">New Purchase Order</a></li>
                                    <li><a href="<?php echo base_url(); ?>Purchase_order/manage">View Purchase Order</a></li>
                                </ul>
                            </li>
                             <?php endif;?>
                             <?php if( in_array('invoice', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Invoice<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                  <!--   <li><a href="<?php echo base_url(); ?>sales_order">New Invoice</a></li> -->
                                  <li><a href="<?php echo base_url(); ?>Proforma/manage">Proforma</a></li>
                                    <li><a href="<?php echo base_url(); ?>sales_order/manage">Invoice</a></li>
                                    <li><a href="<?php echo base_url(); ?>Credict_notes">Credit Note</a></li>
                                </ul>
                            </li>
                            <?php endif;?>
                             <?php if( in_array('payment', $aclCategory)): ?>
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Payment<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li><a href="<?php echo base_url(); ?>Payment">Vendor Payment</a></li>
                                    <li><a href="<?php echo base_url(); ?>So_payment">Client Payment</a></li>
    
                                </ul>
                            </li>
                            <?php endif;?>
                                 <?php if( in_array('report', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Report<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li><a href="<?php echo base_url(); ?>Report/SalesReport">Sales Report</a></li>
                                    <li><a href="<?php echo base_url(); ?>Report/purchase_report">Purchase Report</a></li>
                                     <li role="presentation"><a href="#"><h3>Payment</h3></a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/payables">Payables</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/receivables">Receivables</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/Outstanding_payables">Outstanding Payables</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/Outstanding_receivables">Outstanding Receivables</a></li>
                                      <li><a href="<?php echo base_url(); ?>Report/customer_balance_sheet">Customer Balance sheet</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/vendor_balance_sheet">Vendor Balance Sheet </a></li>
                                     <li role="presentation"><a href="#"><h3>Product Report</h3></a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/vendor_report">Purchase Wise</a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/Customer_report">Sales Wise</a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/stack_vendor_report">Cumulative - Purchase Wise</a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/stack_customer_report">Cumulative - Sales Wise</a></li>
                                    
                                     <!-- <li role="presentation"><a href="#"><h3>Stock Report</h3></a></li>
                                    <li><a href="<?php echo base_url(); ?>ProductReport/product_report">Product stock</a></li>
                                    <li><a href="<?php echo base_url(); ?>ProductReport/rendor_item">Reorder item </a></li> -->
                                </ul>
                            </li>

                           <?php endif;?>

                            <?php if( in_array('settings', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Settings<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/Company_profile/operation">Company Profile</a></li>
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/User_registration">Create User</a></li>
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/User_role">User Role</a></li>
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/Preference">Preference</a></li>
                                </ul>
                            </li>
                            <?php endif;?>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                    <span class="user-name"><?php echo $this->auth_username;?><i class="fa fa-angle-down"></i></span>
                                    <img class="img-circle avatar" src="<?php echo base_url();?>assets/images/profile.jpg" width="40" height="40" alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <!--  <li role="presentation"><a href="<?PHP echo base_url(); ?>Auth/profile"><i class="fa fa-user"></i>Change Password</a></li> -->
                                    <li role="presentation"><a href="<?php echo base_url().'masters/User_registration/Change_Password';?>"><i class="fa fa-sign-out m-r-xs"></i>Change Password</a></li>
                                    <li role="presentation"><a href="<?PHP echo base_url(); ?>Auth/logout"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                </ul>
                            </li>

                        </ul><!-- Nav -->
                    </div><!-- Top Menu -->
                </div>
            </div>
        </div><!-- Navbar -->
        <div class="horizontal-bar sidebar ">
            <div class="page-sidebar-inner slimscroll">
                 <ul class="nav">
                           
                           <?php if( in_array('masters', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Masters<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                
                                   
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Department">Department</a></li>
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/Desgination">Designation</a></li>
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/Vendor_Management">Vendor ID Management</a></li>
                                     <hr>
                                       <li role="presentation"><a href="<?php echo base_url(); ?>masters/Tax">Tax</a></li>
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Currency">Currency</a></li> 
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/bank_details">Bank Details</a></li> 
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Payment_mode">Payment Mode</a></li>
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Payment_terms">Payment Terms</a></li> 
                                     <li role="presentation"><a href="<?php echo base_url(); ?>masters/Quotation_Validity">Quotation Validity</a></li> 
                                    
                                </ul>
                            </li>
                            <?php endif;?>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Vendor<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Client">Client</a></li>
                                  <li role="presentation"><a href="<?php echo base_url(); ?>masters/Vendor">Supplier</a></li>
                                    
                                </ul>
                            </li>
                               <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Enquiry<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                
                                    <li role="presentation"><a href="<?php echo base_url(); ?>masters/Enquiry">Enquiry</a></li>
                                    
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Quotation<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                  <!--   <li><a href="<?php echo base_url(); ?>Quotation">New Quotation</a></li> -->
                                    <li><a href="<?php echo base_url(); ?>Quotation/manage">Quotation</a></li>
                                </ul>
                            </li>
                       
                          
                               <?php if( in_array('purchase', $aclCategory)): ?>
                                 <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Purchase Order<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li><a href="<?php echo base_url(); ?>Purchase_order">New Purchase Order</a></li>
                                    <li><a href="<?php echo base_url(); ?>Purchase_order/manage">View Purchase Order</a></li>
                                </ul>
                            </li>
                             <?php endif;?>
                             <?php if( in_array('invoice', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Invoice<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                  <!--   <li><a href="<?php echo base_url(); ?>sales_order">New Invoice</a></li> -->
                                  <li><a href="<?php echo base_url(); ?>Proforma/manage">Proforma</a></li>
                                    <li><a href="<?php echo base_url(); ?>sales_order/manage">Invoice</a></li>
                                    <li><a href="<?php echo base_url(); ?>Credict_notes">Credit Note</a></li>
                                </ul>
                            </li>
                            <?php endif;?>
                             <?php if( in_array('payment', $aclCategory)): ?>
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Payment<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li><a href="<?php echo base_url(); ?>Payment">Vendor Payment</a></li>
                                    <li><a href="<?php echo base_url(); ?>So_payment">Client Payment</a></li>
    
                                </ul>
                            </li>
                            <?php endif;?>
                                 <?php if( in_array('report', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Report<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li><a href="<?php echo base_url(); ?>Report/SalesReport">Sales Report</a></li>
                                    <li><a href="<?php echo base_url(); ?>Report/purchase_report">Purchase Report</a></li>
                                     <li role="presentation"><a href="#"><h3>Payment</h3></a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/payables">Payables</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/receivables">Receivables</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/Outstanding_payables">Outstanding Payables</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/Outstanding_receivables">Outstanding Receivables</a></li>
                                      <li><a href="<?php echo base_url(); ?>Report/customer_balance_sheet">Customer Balance sheet</a></li>
                                     <li><a href="<?php echo base_url(); ?>Report/vendor_balance_sheet">Vendor Balance Sheet </a></li>
                                     <li role="presentation"><a href="#"><h3>Product Report</h3></a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/vendor_report">Purchase Wise</a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/Customer_report">Sales Wise</a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/stack_vendor_report">Cumulative - Purchase Wise</a></li>
                                     <li><a href="<?php echo base_url(); ?>ProductReport/stack_customer_report">Cumulative - Sales Wise</a></li>
                                    
                                     <!-- <li role="presentation"><a href="#"><h3>Stock Report</h3></a></li>
                                    <li><a href="<?php echo base_url(); ?>ProductReport/product_report">Product stock</a></li>
                                    <li><a href="<?php echo base_url(); ?>ProductReport/rendor_item">Reorder item </a></li> -->
                                </ul>
                            </li>

                           <?php endif;?>

                            <?php if( in_array('settings', $aclCategory)): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown" aria-expanded="true">
                                    <span class="user-name">Settings<i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/Company_profile/operation">Company Profile</a></li>
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/User_registration">Create User</a></li>
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/User_role">User Role</a></li>
                                    <li  role="presentation"><a href="<?php echo base_url(); ?>masters/Preference">Preference</a></li>
                                </ul>
                            </li>
                            <?php endif;?>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                    <span class="user-name"><?php echo $this->auth_username;?><i class="fa fa-angle-down"></i></span>
                                    <img class="img-circle avatar" src="<?php echo base_url();?>assets/images/profile.jpg" width="40" height="40" alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <!--  <li role="presentation"><a href="<?PHP echo base_url(); ?>Auth/profile"><i class="fa fa-user"></i>Change Password</a></li> -->
                                    <li role="presentation"><a href="<?php echo base_url().'masters/User_registration/Change_Password';?>"><i class="fa fa-sign-out m-r-xs"></i>Change Password</a></li>
                                    <li role="presentation"><a href="<?PHP echo base_url(); ?>Auth/logout"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                </ul>
                            </li>

                        </ul><!-- Nav -->
        </div><!-- Page Sidebar Inner -->
        </div><!-- Page Sidebar -->
            <?php echo (isset($content))?$content:''; ?>
            <div class="page-footer">
                <p class="no-s" style="text-align: center;">
                    Powered By <a href="https://agmtechnical.com/" target="_blank">AGM Technical Solutions</a>
                </p>
            </div>
</main><!-- Page Content -->
    <nav class="cd-nav-container" id="cd-nav">
        <header>
            <h3>Navigation</h3>
            <a href="#0" class="cd-close-nav">Close</a>
        </header>
        <ul class="cd-nav list-unstyled">
            <li class="cd-selected" data-menu="index">
                <a href="javsacript:void(0);">
                    <span>
                        <i class="glyphicon glyphicon-home"></i>
                    </span>
                    <p>Dashboard</p>
                </a>
            </li>
            <li data-menu="profile">
                <a href="javsacript:void(0);">
                    <span>
                        <i class="glyphicon glyphicon-user"></i>
                    </span>
                    <p>Profile</p>
                </a>
            </li>
            <li data-menu="inbox">
                <a href="javsacript:void(0);">
                    <span>
                        <i class="glyphicon glyphicon-envelope"></i>
                    </span>
                    <p>Mailbox</p>
                </a>
            </li>
            <li data-menu="#">
                <a href="javsacript:void(0);">
                    <span>
                        <i class="glyphicon glyphicon-tasks"></i>
                    </span>
                    <p>Tasks</p>
                </a>
            </li>
            <li data-menu="#">
                <a href="javsacript:void(0);">
                    <span>
                        <i class="glyphicon glyphicon-cog"></i>
                    </span>
                    <p>Settings</p>
                </a>
            </li>
            <li data-menu="calendar">
                <a href="javsacript:void(0);">
                    <span>
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                    <p>Calendar</p>
                </a>
            </li>
        </ul>
    </nav>
    <div class="cd-overlay"></div>
   <input type="hidden" name="url"  id= "url" value="<?php echo base_url().'masters/User_registration/Change_Password';?>" />

    <!-- Javascripts -->
    
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/pace-master/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/js/classie.js"></script>
    <!--<script src="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/js/main.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/plugins/waves/waves.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/summernote-master/summernote.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
   <!--  //for Quotation -->
    <!--  <script src="https://cdn.tiny.cloud/1/0b2v319rg4q5uk28vjptv4dfi7vjxveg5j59cm9uk8o07u9m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
 <script src="<?php echo base_url(); ?>assets/js/tinymce.min.js"></script> 
    <!--
    <script src="<?php echo base_url(); ?>assets/js/modern.min.js"></script>
    -->
    <script src="<?php echo base_url(); ?>assets/js/pages/form-elements.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/modern.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/table-data.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/form-select2.js"></script>
 
<!--       <script>
    tinymce.init({ 
      selector:'.elm1',
      theme: 'modern',
      height: 200
    });
    </script> -->
    <script>
    tinymce.init({
      selector: '.elm1',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
    content_style: "p { margin: 0;padding: 0;}",
      
       plugins: 'table',
     

  mode : "textareas",


  // entity_encoding : "raw",
  // add_unload_trigger : false,
  // remove_linebreaks : false,
  // apply_source_formatting : false,
   force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : '',
     
       
        table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol'
        
    });
  </script>
    <script type="text/javascript">
        function conformboxdelete(l)
        {
            if(arguments[0] != null)
            {
              if(window.confirm('Are you sure you want to delete???'))
              {
                location.href = l;
              }
              else
              {
                event.cancelBubble = true;
                event.returnValue = false;
                return false;
              }
            }
            else
            {
              return false;
            }
            return;
        }
        function ChangeLangugeEng()
        {
            var eng = "english";
         
            $.ajax({
              type: "GET",
              url: "<?php echo site_url('LanguageSwitcher/switchLang'); ?>",
              data: {language: eng},
              dataType:"html",
              success: function(response)
              {
               
                location.reload()       
              },
            })
        }
         function ChangeLangugeAr()
        {
            var eng = "arabic";
         
            $.ajax({
              type: "GET",
              url: "<?php echo site_url('LanguageSwitcher/switchLang'); ?>",
              data: {language: eng},
              dataType:"html",
              success: function(response)
              {
               
                  location.reload()        
              },
            })
        }

//          $(document).ready(function() {
//           var timer = 0;
//           var url = $('#url').val();
//           alert(url);
// function set_interval() {
//   // the interval 'timer' is set as soon as the page loads
//   timer = setInterval("auto_logout()", 1000);
//   // the figure '10000' above indicates how many milliseconds the timer be set to.
//   // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
//   // So set it to 300000
// }

// function reset_interval() {
//   //resets the timer. The timer is reset on each of the below events:
//   // 1. mousemove   2. mouseclick   3. key press 4. scroliing
//   //first step: clear the existing timer
// alert('hhh');
//   if (timer != 0) {
//     clearInterval(timer);
//     timer = 0;
//     // second step: implement the timer again
//     timer = setInterval("auto_logout()", 1000);
//     // completed the reset of the timer
//   }
// }

// function auto_logout() {
//   // this function will redirect the user to the logout script
//   window.location = url;
// }


//          });
    </script>   
</body>
<!-- index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Feb 2016 09:23:25 GMT -->
</html>
