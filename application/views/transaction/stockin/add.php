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
        <li><a href="<?= base_url('')?>"><i class="fa fa-money"></i> Transaction</a></li>
        <li><a href="<?= base_url('stock')?>"> Stock In</a></li>
        <li class="active"> Create Stock In</li>
    </ol>
</section>
<?php $this->view('massage');?>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="<?= base_url('stock')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="date">Date <span class="text-red">*</span></label>
                        <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d')?>">
                        <span class="text-red"><?= form_error('date')?></span>
                    </div>
                    <label for="barcode">Barcode <span class="text-red">*</span></label>
                    <div class="form-group input-group">
                        <input type="hidden" name="item_id" id="item_id" value="<?= $this->input->post('item_id')?>">
                        <input type="text" name="barcode" id="barcode" class="form-control" value="<?= $this->input->post('barcode')?>" placeholder="-" readonly>
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-item">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <span class="text-red"><?= form_error('barcode')?></span>
                    <div class="form-group">
                        <label for="name">Product Item</label>
                        <input type="text" name="name" id="name" class="form-control" readonly value="<?= $this->input->post('name')?>" placeholder="-">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="category_name">Category Item</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" readonly value="<?= $this->input->post('category_name')?>" placeholder="-">
                            </div>
                            <div class="col-lg-6">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" readonly value="<?= $this->input->post('price')?>" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="unit_name">Unit</label>
                                <input type="text" name="unit_name" id="unit_name" class="form-control" readonly value="<?= $this->input->post('unit_name')?>" placeholder="-">
                            </div>
                            <div class="col-lg-6">
                                <label for="stock">Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control" readonly value="<?= $this->input->post('stock')?>" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier <span class="text-red">*</span></label>
                        <select name="supplier" id="supplier" class="form-control">
                            <option value="">--Pilih--</option>
                            <?php foreach($suppliers->result() as $supplier):?>
                                <option value="<?= $supplier->supplier_id?>" <?= $this->input->post('supplier') == $supplier->supplier_id ? 'selected' : null;?>><?= $supplier->name?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="text-red"><?= form_error('supplier')?></span>
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail <span class="text-red">*</span></label>
                        <textarea name="detail" id="detail" class="form-control" placeholder="Masukan Detail Stock In"><?= $this->input->post('detail');?></textarea>
                        <span class="text-red"><?= form_error('detail')?></span>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty <span class="text-red">*</span></label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Masukan Qty Stock In" value="<?= $this->input->post('qty')?>">
                        <span class="text-red"><?= form_error('qty')?></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="add_in" id="add_in" class="btn btn-primary btn-xs">
                            <i class="fa fa-send"></i> Simpan
                        </button>
                        <button type="reset" name="reset" id="reset" class="btn btn-warning btn-xs">
                            <i class="fa fa-undo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Data Items</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-responsive text-center table-striped" style="width: 100%;" id="tableitem">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                            <th>Product Item </th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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

<script>
    $(document).ready(function(){
        $('#tableitem').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?= base_url('stock/get_ajax_item')?>",
                "type": "POST"
            },
            "columnDefs":[
                {
                    "targets": [6],
                    "orderable": false
                }
            ],
            "order": []
        });
    });
    $(document).on('click', '#select', function(){
        var item_id = $(this).data('item_id');
        var barcode = $(this).data('barcode');
        var name = $(this).data('name');
        var category_name = $(this).data('category_name');
        var price = $(this).data('price');
        var unit_name = $(this).data('unit_name');
        var stock = $(this).data('stock');

        $('#item_id').val(item_id);
        $('#barcode').val(barcode);
        $('#name').val(name);
        $('#category_name').val(category_name);
        $('#price').val(price);
        $('#unit_name').val(unit_name);
        $('#stock').val(stock);

        $('#modal-item').modal('hide');
    });
</script>