
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <!-- jQuery 3 -->
  <script src="<?= base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini <?= $this->uri->segment(1) == 'sales' ? 'sidebar-collapse' : null?>">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url()?>assets//index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->fungsi_user->user_login()->name?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url()?>assets//dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $this->fungsi_user->user_login()->name;?>
                  <small><?= $this->fungsi_user->user_login()->level == 1 ? 'Admin' : 'Kasir'?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('auth/logout')?>" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url()?>assets//dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p class="text-green"><?= $this->fungsi_user->user_login()->name;?></p>
          <span><?= $this->fungsi_user->user_login()->level == 1 ? 'Admin' : 'Kasir'?></span>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= $this->uri->segment(1) == '' ? 'active' : null?>"><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="<?= $this->uri->segment(1) == 'supplier' ? 'active' : null?>"><a href="<?= base_url('supplier')?>"><i class="fa fa-truck"></i> <span>Suppliers</span></a></li>
        <li class="<?= $this->uri->segment(1) == 'customer' ? 'active' : null?>"><a href="<?= base_url('customer')?>"><i class="fa fa-users"></i> <span>Castomers</span></a></li>
        <li class="treeview
        <?= $this->uri->segment(1) == 'category' ? 'active' : null?> || 
        <?= $this->uri->segment(1) == 'unit' ? 'active' : null?> || 
        <?= $this->uri->segment(1) == 'item' ? 'active' : null?>
        ">
              <a href="#">
                <i class="fa fa-archive"></i>
                <span>Products</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?= $this->uri->segment(1) == 'category' ? 'active' : null?>"><a href="<?= base_url('category')?>"><i class="fa fa-circle-o"></i> Categories</a></li>
                <li class="<?= $this->uri->segment(1) == 'unit' ? 'active' : null?>"><a href="<?= base_url('unit')?>"><i class="fa fa-circle-o"></i> Units</a></li>
                <li class="<?= $this->uri->segment(1) == 'item' ? 'active' : null?>"><a href="<?= base_url('item')?>"><i class="fa fa-circle-o"></i> Items</a></li>
              </ul>
            </li>
        <li class="treeview 
          <?= $this->uri->segment(1) == 'sales' ? 'active' : null;?>
          <?= $this->uri->segment(1) == 'stock' ? 'active' : null;?>
          <?= $this->uri->segment(1) == 'stockout' ? 'active' : null;?>
        ">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Transaction</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?= $this->uri->segment(1) == 'sales' ? 'active' : null?>"><a href="<?= base_url('sales')?>"><i class="fa fa-circle-o"></i> Sales</a></li>
                <li class="<?= $this->uri->segment(1) == 'stock' ? 'active' : null;?>"><a href="<?= base_url('stock')?>"><i class="fa fa-circle-o"></i> Stock In</a></li>
                <li class="<?= $this->uri->segment(1) == 'stockout' ? 'active' : null?>"><a href="<?= base_url('stockout')?>"><i class="fa fa-circle-o"></i> Stock Out</a></li>
              </ul>
            </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> Sales</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Stock</a></li>
          </ul>
        </li>
        <?php if($this->fungsi_user->user_login()->level == 1) {?>
        <li class="header">LABELS</li>
        <li><a href="<?= base_url('users')?>"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?= $contents?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/dist/js/demo.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
