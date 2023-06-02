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
    <li class="active"><a href="#"><i class="fa fa-truck"></i> Suppliers</a></li>
    </ol>
</section>

<!-- sweetalert2 success -->
<div id="flashSuccess" data-success="<?= $this->session->flashdata('success');?>"></div>

<!-- sweetalert2 error -->
<div id="flashError" data-error="<?= $this->session->flashdata('error');?>"></div>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- <h3>Data Suppliers</h3> -->
            <div class="pull-right">
                <a href="<?= base_url('supplier/add')?>" class="btn btn-primary btn-xs text-right">
                    <i class="fa fa-plus"></i> Create New Suppliers
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive text-center" id="tablesuppliers">
                <thead class="bg-blue">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data->result() as $supplier): ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $supplier->name?></td>
                        <td><?= $supplier->phone?></td>
                        <td><?= $supplier->address?></td>
                        <td><?= $supplier->description ?></td>
                        <td>
                            <a href="<?= base_url('supplier/update/'.$supplier->supplier_id)?>" class="btn btn-xs btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>    |
                            <!-- <form action="<?= base_url('supplier/del')?>" method="post" class="inline">
                                <input type="hidden" name="supplier_id" value="<?= $supplier->supplier_id?>">
                                <button class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form> -->
                            <a href="#modalDelete" onclick="$('#modalDelete #formDelete').attr('action', '<?= base_url('supplier/del/'.$supplier->supplier_id)?>')" class="btn btn-danger btn-xs" data-toggle="modal">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade" id="modalDelete">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Apakah Anda Ingin Menghapus Data Ini?</h4>
        </div>
        <div class="modal-footer">
            <form action="" method="POST" id="formDelete">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Yaa, Saya Ingin Hapus!</button>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- script custom -->
<script>
    $(document).ready(function(){
        $('#tablesuppliers').DataTable();
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
</script>