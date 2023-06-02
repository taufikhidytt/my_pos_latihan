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
    <li><a href="#"><i class="fa fa-money"></i> Transaction</a></li>
    <li class="active">Stock In</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- <h3>Data units</h3> -->
            <div class="pull-right">
                <a href="<?= base_url('stock/add')?>" class="btn btn-primary btn-xs text-right">
                    <i class="fa fa-plus"></i> Create New Stock In
                </a>
            </div>
        </div>
        <?php $this->view('massage');?>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive text-center" id="tablein">
                <thead class="bg-blue">
                    <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Product Item</th>
                        <th>Qty</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data->result() as $stockin): ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $stockin->barcode?></td>
                        <td><?= $stockin->item_name?></td>
                        <td><?= $stockin->qty?></td>
                        <td><?= substr($stockin->date,0,10)?></td>
                        <td>
                            <button type="button" name="detail" id="detail" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modaldetail"
                            data-barcode="<?= $stockin->barcode?>"
                            data-item_name="<?= $stockin->item_name?>"
                            data-qty="<?= $stockin->qty?>"
                            data-date="<?= $stockin->date?>"
                            data-supplier="<?= $stockin->supplier_name?>"
                            data-user="<?= $stockin->user_name?>"
                            data-detail="<?= $stockin->detail?>"
                            >
                                <i class="fa fa-eye"></i>
                            </button>   |
                            <a href="<?= base_url('stock/del/'.$stockin->stock_id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">
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

<div class="modal fade" id="modaldetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detail Stock In</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-responsive text-center">
                    <tr>
                        <th>Barcode</th>
                        <td id="barcode"></td>
                    </tr>
                    <tr>
                        <th>Product Item</th>
                        <td id="item_name"></td>
                    </tr>
                    <tr>
                        <th>Qty</th>
                        <td id="qty"></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td id="date"></td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td id="supplier"></td>
                    </tr>
                    <tr>
                        <th>Create By</th>
                        <td id="user"></td>
                    </tr>
                    <tr>
                        <th>Detail</th>
                        <td id="detailstockin"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
        $('#tablein').DataTable();
    });
    $(document).on('click', '#detail', function(){
        var barcode = $(this).data('barcode');
        var item_name = $(this).data('item_name');
        var qty = $(this).data('qty');
        var date = $(this).data('date');
        var supplier = $(this).data('supplier');
        var user = $(this).data('user');
        var detail = $(this).data('detail');

        $('#barcode').text(barcode);
        $('#item_name').text(item_name);
        $('#qty').text(qty);
        $('#date').text(date);
        $('#supplier').text(supplier);
        $('#user').text(user);
        $('#detailstockin').text(detail);
    });
</script>