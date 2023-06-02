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
    <li class="active"><a href="#"><i class="fa fa-archive"></i> Items</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- <h3>Data items</h3> -->
            <div class="pull-right">
                <a href="<?= base_url('item/add')?>" class="btn btn-primary btn-xs text-right">
                    <i class="fa fa-plus"></i> Create New Items
                </a>
            </div>
        </div>
        <?php $this->view('massage');?>
        <div class="card-body">
            <table class="table table-bordered table-responsive" id="tableitem">
                <thead class="bg-blue">
                    <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Image Product</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- script custom -->
<script>
    $(document).ready(function(){
        $('#tableitem').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?= base_url('item/get_ajax')?>",
                "type": "POST"
            },
            "columnDefs":[
                {
                    "targets": [1,2,3,4,5,6,7,8],
                    "className": 'text-center'
                },
                {
                    "targets": [7],
                    "width": '10%'
                },
                {
                    "targets": [0,7,8],
                    "orderable": false
                }
            ],
            "order": []
        });
    });
</script>