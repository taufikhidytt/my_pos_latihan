<!-- Css Datatable -->
<link rel="stylesheet" href="<?= base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- sweetalert2 -->
<link rel="stylesheet" href="<?= base_url()?>assets/sweetalert/sweetalert2.min.css">

<style>
    .swal2-popup{
        font-size: 1.5rem !important;
    }
</style>

<!-- script Datatable -->
<script src="<?= base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- sweetalert -->
<script src="<?= base_url()?>assets/sweetalert/sweetalert2.min.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-users"></i> Customers</a></li>
    </ol>
</section>

<div id="flashSuccess" data-success="<?= $this->session->flashdata('success');?>"></div>

<div id="flashError" data-error="<?= $this->session->flashdata('error');?>"></div>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- <h3>Data customers</h3> -->
            <div class="pull-right">
                <a href="<?= base_url('customer/add')?>" class="btn btn-primary btn-xs text-right">
                    <i class="fa fa-plus"></i> Create New Customers
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive text-center" id="tablecustomers">
                <thead class="bg-blue">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data->result() as $customer): ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $customer->name?></td>
                        <td><?= $customer->gender?></td>
                        <td><?= $customer->phone?></td>
                        <td><?= $customer->address?></td>
                        <td>
                            <a href="<?= base_url('customer/update/'.$customer->customer_id)?>" class="btn btn-xs btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>    |
                            <form action="<?= base_url('customer/del')?>" method="post" class="inline">
                                <input type="hidden" name="customer_id" value="<?= $customer->customer_id?>">
                                <button class="btn btn-xs btn-danger" id="form-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- script custom -->
<script>
    $(document).ready(function(){
        $('#tablecustomers').DataTable();
    });
</script>

<script>
    var flashsuccess = $('#flashSuccess').data('success');
    var flasherror = $('#flashError').data('error');
    if(flashsuccess){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: flashsuccess,
        })
    }

    if(flasherror){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: flasherror,
        })
    }

    $(document).on('click', '#form-delete', function(e){
        e.preventDefault();
        var link = $(this).parent('form');
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Ingin Menghapus Data Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yaa, Hapus Data Ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                link.submit();
            }
        })

    });
</script>