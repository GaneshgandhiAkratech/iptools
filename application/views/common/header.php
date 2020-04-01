<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Akratech Iptools</title>

  <!-- Font Awesome Icons -->
	<link rel="stylesheet" href="ished_iptools/plugins/fontawesome-free/css/all.min.css">
	<!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">	
  <!-- Theme style -->
	<link rel="stylesheet" href="ished_iptools/dist/css/adminlte.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="ished_iptools/plugins/animate/animate.css">

  <!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="ished_iptools/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="ished_iptools/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="ished_iptools/dist/js/adminlte.min.js"></script>
<style>
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #094584;
    color: #fff;
}
.btn-primary {
    color: #fff;
    background-color: #094584;
    border-color: #094584;
    box-shadow: none;
}
a {
    color: #FFFFFF;
    text-decoration: none;
    background-color: transparent;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color:  #040463 ;
    border-color:  #040463 ;
}
.page-link {
  color:  #040463 ;
}
a.nav-link.active {
    color: #ffff !important;
	background: #094584; !important;
}
.nav-pills .nav-link {
    color: #FFFFFF;
}
</style>
<script>
 $(function(){ 
  let reset_text = ''
  $(".processing").on("click",function(){
    $(this).html('<i class="fa fa-spin fa-spinner"></i> Processing...');
  })
  $(".btn-refresh").on("click",function(){
    reset_text = $(this).html()
    let loading_text = $(this).attr("data-refresh")
    let is_reload = parseInt($(this).attr("data-reload"))
    $(this).html('<i class="fa fa-spin fa-spinner"></i> '+loading_text+'...');
    if(is_reload){
      setTimeout(function(){ 
        location.reload() 
      }, 3000);
    }
  })
}) 
</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

	<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
	<!-- /.navbar -->
	
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: #094584;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://localhost/shed/iptools/image/logo.png" alt="Ished" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Iptools</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="ished_iptools/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
					<li class="nav-item">
              <a href="<?php echo base_url("dashboard") ?>" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
								Dashboard
                </p>
              </a>
					</li>

					<li class="nav-item">
              <a href="<?php echo base_url("master_product") ?>" class="nav-link">
							<i class="nav-icon fas fa-project-diagram"></i>
                <p>
								Master Products
                </p>
              </a>
					</li>

					<!-- <li class="nav-item">
              <a href="<?php echo base_url("master_intake") ?>" class="nav-link">
							<i class="nav-icon fas fa-database"></i>
                <p>
								Master Inaked Products
                </p>
              </a>
					</li> -->

					<!-- <li class="nav-item">
              <a href="<?php echo base_url("product_intake") ?>" class="nav-link">
							<i class="nav-icon fas fa fa-robot"></i>
                <p>
								Product Intake Crawled
                </p>
              </a>
					</li> -->

					<!-- <li class="nav-item">
              <a href="<?php echo base_url("rentalrates") ?>" class="nav-link">
							<i class="nav-icon fas fa-dollar-sign"></i>
                <p>
								Rental Rates Estimator
                </p>
              </a>
						</li> -->

						<!-- <li class="nav-item">
              <a href="<?php echo base_url("rentalprices") ?>" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
								Rental Prices
                </p>
              </a>
						</li> -->

						<li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
									Partners
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="<?php echo base_url("party_perfect") ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Party Perfect</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="<?php echo base_url("greentop") ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Green Top</p>
                  </a>
                </li>
                <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lowes <i class="right fas fa-angle-left"></i></p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="<?php echo base_url("lowes_black_decker") ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Black + Decker</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url("lowes_bostitch") ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Bostitch</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url("lowes_craftsman") ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Craftsman</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url("lowes_dewalt") ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Dewalt</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url("lowes_irwin") ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Irwin</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?php echo base_url("lowes_stanley") ?>" class="nav-link">
												<i class="far fa-circle nav-icon"></i>
												<p>Stanley</p>
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-item">
                  <a href="<?php echo base_url("hamiltonbeach") ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hamilton Beach</p>
                  </a>
								</li>
								<li class="nav-item">
                  <a href="<?php echo base_url("weston") ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Weston</p>
                  </a>
								</li>
								<li class="nav-item">
                  <a href="<?php echo base_url("proctor_silex") ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proctor Silex</p>
                  </a>
								</li>
              </ul>
            </li>

					
					
					
					

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>