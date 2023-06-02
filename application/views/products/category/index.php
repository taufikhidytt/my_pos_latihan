<!-- Css Datatable -->
<link rel="stylesheet" href="<?= base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- sweetalert2 -->
<link rel="stylesheet" href="<?= base_url()?>assets/sweetalert/sweetalert2.min.css">

<!-- style custom sweetalert -->
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
    <li class="active"><a href="#"><i class="fa fa-archive"></i> Categories</a></li>
</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- <h3>Data categorys</h3> -->
            <div class="pull-right">
                <a href="<?= base_url('category/add')?>" class="btn btn-primary btn-xs text-right">
                    <i class="fa fa-plus"></i> Create New Categories
                </a>
            </div>
        </div>

        <!-- flashdata default -->
        <?php 
        // $this->view('massage');
        ?>

        <!-- sweetalert2 success -->
        <div id="flashSuccess" data-success="<?= $this->session->flashdata('success');?>"></div>

        <!-- sweetalert2 error -->
        <div id="flashError" data-error="<?= $this->session->flashdata('error');?>"></div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive text-center" id="tablecategory">
                <thead class="bg-blue">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data->result() as $category): ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $category->name?></td>
                        <td>
                            <a href="<?= base_url('category/update/'.$category->category_id)?>" class="btn btn-xs btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>    |
                            <!-- hapus data dalam form -->
                            <form action="<?= base_url('category/del')?>" method="post" class="inline" id="form-deleted">
                                <input type="hidden" name="category_id" id="category_id" value="<?= $category->category_id?>">
                                <button class="btn btn-xs btn-danger" id="confirm-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                            <!-- hapus data dalam tag a -->
                            <!-- <a href="<?= base_url('category/del/'.$category->category_id)?>" class="btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            </a> -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- script sweetalert2 -->
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

    $(document).on('click', '#confirm-delete', function(e){
        e.preventDefault();

        // untuk tag form
        var link = $(this).parents('form');

        // untuk tag a 
        // var link = $(this).attr('action');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Ingin Menghapus Data Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#a7a8a7',
            confirmButtonText: 'Ya, Yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                // untuk tag form
                link.submit();

                // untuk tag a
                // window.location = link;
            }
        })
    });
</script>

<!-- script custom -->
<script>
    $(document).ready(function(){
        $('#tablecategory').DataTable();
    });
</script>