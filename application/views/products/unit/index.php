<!-- Css Datatable -->
<link rel="stylesheet" href="<?= base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


<!-- script Datatable -->
<script src="<?= base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-archive"></i> Units</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- <h3>Data units</h3> -->
            <div class="pull-right">
                <a href="<?= base_url('unit/add')?>" class="btn btn-primary btn-xs text-right">
                    <i class="fa fa-plus"></i> Create New Units
                </a>
            </div>
        </div>
        <?php $this->view('massage');?>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive text-center" id="tableunit">
                <thead class="bg-blue">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data->result() as $unit): ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $unit->name?></td>
                        <td>
                            <a href="<?= base_url('unit/update/'.$unit->unit_id)?>" class="btn btn-xs btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>    |
                            <form action="<?= base_url('unit/del')?>" method="post" class="inline">
                                <input type="hidden" name="unit_id" value="<?= $unit->unit_id?>">
                                <button class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">
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
        $('#tableunit').DataTable();
    });
</script>