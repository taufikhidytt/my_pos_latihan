
<!-- sweetalert2 -->
<link rel="stylesheet" href="<?= base_url()?>assets/sweetalert/sweetalert2.min.css">

<style>
  .swal2-popup{
    font-size: 1.5rem !important;
  }
</style>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $judul?>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>

  <div id="flashSuccess" data-success="<?= $this->session->flashdata('success');?>"></div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
          <h3><?= $item?></h3>

          <p>ITEMS</p>
          </div>
          <div class="icon">
          <i class="fa fa-archive"></i>
          </div>
          <a href="<?= base_url('item')?>" class="small-box-footer">More Info Items <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
          <h3><?= $supplier?></h3>

          <p>SUPPLIERS</p>
          </div>
          <div class="icon">
          <i class="fa fa-users"></i>
          </div>
          <a href="<?= base_url('supplier')?>" class="small-box-footer">More Info Suppliers <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
          <h3>44</h3>

          <p>User Registrations</p>
          </div>
          <div class="icon">
          <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
          <h3><?= $user?></h3>

          <p>USERS</p>
          </div>
          <div class="icon">
          <i class="ion ion-person-add"></i>
          </div>
          <a href="<?= base_url('users')?>" class="small-box-footer">More Info Users <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>
  <!-- /.content -->

  <!-- sweetalert -->
  <script src="<?= base_url()?>assets/sweetalert/sweetalert2.min.js"></script>

  <script>
    var flashsuccess = $('#flashSuccess').data('success');
    if(flashsuccess){
      Swal.fire({
            icon: 'success',
            title: 'Success',
            text: flashsuccess,
        })
    }
  </script>