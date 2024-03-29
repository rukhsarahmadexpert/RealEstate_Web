<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php echo $pageTitle; ?></title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
      <style>
         .error{
         color:red;
         font-weight: normal;
         }
      </style>
      <script type="text/javascript" src="<?php echo base_url().'ckeditor/ckeditor.js' ?>"></script>
      <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
      <script type="text/javascript">
         var baseURL = "<?php echo base_url(); ?>";
      </script>
      <link href="<?php echo base_url(); ?>assets/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
      <script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.min.js"></script>
     
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
      <header class="main-header">
         <a href="<?php echo base_url(); ?>" class="logo">
         <span class="logo-mini"><b>CI</b>AS</span>
         <span class="logo-lg"><b><?php echo APP_NAME; ?></b>AS</span>
         </a>
         <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <li class="dropdown tasks-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                     <i class="fa fa-history"></i>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
                     </ul>
                  </li>
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                     <span class="hidden-xs"><?php echo $name; ?></span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-header">
                           <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                           <p>
                              <?php echo $name; ?>
                              <small><?php echo $role_text; ?></small>
                           </p>
                        </li>
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
                           </div>
                           <div class="pull-right">
                              <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <aside class="main-sidebar">
         <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
               <li class="header">MAIN NAVIGATION</li>
               <li>
                  <a href="<?php echo base_url(); ?>dashboard">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                  </a>
               </li>
              
               <?php 
                  $flag=0;
                  $last = $this->uri->total_segments();
                  $record_num = $this->uri->segment($last);
                    
                   if( $record_num=='item_master_listing' || $record_num=='item_unit_listing' || $record_num=='vehicle_listing' || $record_num=='time_slot_listing' || $record_num=='item_category_listing' || $record_num=='module_master_listing' || $record_num=='role_master_listing' )
                   {
                     $flag=1;
                   }
                   if($record_num=='userListing' || $record_num=='guest_user_listing' || $record_num=='r_user_listing')
                   {
                     $flag=2;
                   }
                   if($record_num=='servicesListing' || $record_num=='sub_service_listing' || $record_num=='service_request_listing' || $record_num=='guest_service_request_listing')
                   {
                     $flag=3;
                   }
                   if($record_num=='sliderListing' || $record_num=='contact_us_listing' || $record_num=='careers_listing' || $record_num=='partner_listing')
                   {
                     $flag=4;
                   }
                   if($record_num=='purchase_order_listing' || $record_num=='purchase_master_listing')
                   {
                     $flag=5;
                   }
                   if($record_num=='sales_quotation_listing' || $record_num=='sales_master_listing')
                   {
                     $flag=6;
                   }
                   if($record_num=='amc_listing' || $record_num=='amc_content_listing')
                   {
                     $flag=7;
                   }
                  $alldata=$this->session->all_userdata();
                  $alluserdata=$this->session->userdata['rights'];                 
                  if(isset($alldata['role']) || $alldata['role']!=1)
                  {
                     
                     $modulestodisplay=array_column($alluserdata, 'module_id');

                 /////////////////////////Buliding Master/////////////////////

                 if(isset($this->session->userdata['myfinal']['building_listing']['p_view']) && 
                    $this->session->userdata['myfinal']['building_listing']['p_view']==1 ||
                    isset($this->session->userdata['myfinal']['building_listing']['p_add']) && 
                    $this->session->userdata['myfinal']['building_listing']['p_add']==1 ||
                    isset($this->session->userdata['myfinal']['building_listing']['p_update']) && 
                    $this->session->userdata['myfinal']['building_listing']['p_update']==1 ||
                    isset($this->session->userdata['myfinal']['building_listing']['p_delete']) && 
                    $this->session->userdata['myfinal']['building_listing']['p_delete']==1 ||
                    $this->session->userdata['role']==1)
                 {                        
                 ?>
                    <li>
                    <a href="<?php echo base_url(); ?>building_listing">
                    <i class="fa fa-ellipsis-v"></i>
                    <span>Property Registration</span>
                    </a>
                  </li>
                  <?php 
                  }

                  /////////////////////////PROPERTY TYPE/////////////////////

                     if(isset($this->session->userdata['myfinal']['property_type_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
                    <li>
              <a href="<?php echo base_url(); ?>property_type_listing">
              <i class="fa fa-database"></i>
              <span>Property Unit Types</span>
              </a>
            </li>

                     <?php 
                     }

              /////////////////////////PROPERTY Unit Size/////////////////////

               if(isset($this->session->userdata['myfinal']['property_unit_size_listing']['p_view']) && 
                  $this->session->userdata['myfinal']['property_unit_size_listing']['p_view']==1 ||
                  isset($this->session->userdata['myfinal']['property_unit_size_listing']['p_add']) && 
                  $this->session->userdata['myfinal']['property_unit_size_listing']['p_add']==1 ||
                  isset($this->session->userdata['myfinal']['property_unit_size_listing']['p_update']) && 
                  $this->session->userdata['myfinal']['property_unit_size_listing']['p_update']==1 ||
                  isset($this->session->userdata['myfinal']['property_unit_size_listing']['p_delete']) && 
                  $this->session->userdata['myfinal']['property_unit_size_listing']['p_delete']==1 ||
                  $this->session->userdata['role']==1)
               {                        
               ?>
                    <li>
              <a href="<?php echo base_url(); ?>property_unit_size_listing">
              <i class="fa fa-safari"></i>
              <span>Property Unit Sizes</span>
              </a>
            </li>
               <?php 
               }

                     /////////////////////////CUSTOMER/////////////////////

                     if(isset($this->session->userdata['myfinal']['customer_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['customer_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['customer_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['customer_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['customer_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['customer_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['customer_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['customer_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
                        <li>
                    <a href="<?php echo base_url(); ?>customer_listing">
                    <i class="fa fa-address-book"></i>
                    <span>Customer</span>
                    </a>
                  </li>

                     <?php 
                     } 

            /////////////////////////Property Reservation/////////////////////

             if(isset($this->session->userdata['myfinal']['property_reservation_listing']['p_view']) && 
                $this->session->userdata['myfinal']['property_reservation_listing']['p_view']==1 ||
                isset($this->session->userdata['myfinal']['property_reservation_listing']['p_add']) && 
                $this->session->userdata['myfinal']['property_reservation_listing']['p_add']==1 ||
                isset($this->session->userdata['myfinal']['property_reservation_listing']['p_update']) && 
                $this->session->userdata['myfinal']['property_reservation_listing']['p_update']==1 ||
                isset($this->session->userdata['myfinal']['property_reservation_listing']['p_delete']) && 
                $this->session->userdata['myfinal']['property_reservation_listing']['p_delete']==1 ||
                $this->session->userdata['role']==1)
             {                        
             ?>
                <li>
            <a href="<?php echo base_url(); ?>property_reservation_listing">
            <i class="fa fa-book"></i>
            <span>Reservation</span>
            </a>
          </li>

             <?php 
             } 

                     /////////////////////////Property Master/////////////////////

                     if(isset($this->session->userdata['myfinal']['property_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['property_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['property_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['property_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['property_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['property_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['property_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['property_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
                        <li>
                    <a href="<?php echo base_url(); ?>property_listing">
                    <i class="fa fa-building-o"></i>
                    <span>Property Unit</span>
                    </a>
                  </li>

                     <?php 
                     }

             

                     /////////////////////////Vendor/////////////////////

                     if(isset($this->session->userdata['myfinal']['vendor_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
                        <li>
                    <a href="<?php echo base_url(); ?>vendor_listing">
                    <i class="fa fa-venus-mars"></i>
                    <span>Vendor</span>
                    </a>
                  </li>

                     <?php 
                     } 

                     /////////////////////////Expences/////////////////////

                     if(isset($this->session->userdata['myfinal']['expence_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['expence_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['expence_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['expence_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['expence_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['expence_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['expence_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['expence_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
                        <li>
                    <a href="<?php echo base_url(); ?>expence_listing">
                    <i class="fa fa-etsy"></i>
                    <span>Expences</span>
                    </a>
                  </li>

                     <?php 
                     } 

                     /////////////////////////Reports////////////////////////////

                     if(isset($this->session->userdata['myfinal']['userListing']['p_view']) && 
                        $this->session->userdata['myfinal']['userListing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_add']) && 
                        $this->session->userdata['myfinal']['userListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_update']) && 
                        $this->session->userdata['myfinal']['userListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['userListing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==2){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-files-o"></i><span>Reports</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if($this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>expence_report"><i class="fa fa-btc"></i>Expence Report</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     } 

                     

                     /////////////////////////users////////////////////////////

                     if(isset($this->session->userdata['myfinal']['userListing']['p_view']) && 
                        $this->session->userdata['myfinal']['userListing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_add']) && 
                        $this->session->userdata['myfinal']['userListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_update']) && 
                        $this->session->userdata['myfinal']['userListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['userListing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==2){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-asterisk"></i><span>Users</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['userListing']['p_add']) && 
                        $this->session->userdata['myfinal']['userListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_update']) && 
                        $this->session->userdata['myfinal']['userListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['userListing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>userListing"><i class="fa fa-users"></i>Admin User</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     }   

                     ///////////////////////////////masters////////////////////////////////////


                     if(isset($this->session->userdata['myfinal']['module_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['property_type_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['property_type_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==1){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-superpowers"></i><span>Masters</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['module_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>module_master_listing"><i class="fa fa-folder-open"></i>Module Master</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['role_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>role_master_listing"><i class="fa fa-handshake-o"></i>Role Management</a></li>


                              <?php } if(isset($this->session->userdata['myfinal']['item_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>item_master_listing"><i class="fa fa-indent"></i>Item Master</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     }          
                  }
?>

            </ul>
         </section>
      </aside>