<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-money"></i> Transaction</a></li>
    <li class="active"> Sales</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="date">Date</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d')?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="user">Name User</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="user" id="user" class="form-control" value="<?= $this->fungsi_user->user_login()->name?>" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="customer">Customer</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="customer" id="customer" class="form-control">
                                        <option value="">Umum</option>
                                        <?php foreach($customers->result() as $customer):?>
                                            <option value="<?= $customer->customer_id?>" <?= $this->input->post('customer') == $customer->customer_id ? 'selected' : null ;?>><?= $customer->name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="barcode">Barcode</label>
                            </td>
                            <td>
                                <div class="form-group input-group">
                                    <input type="hidden" id="item_id" name="item_id" value="<?= $this->input->post('item_id')?>">
                                    <input type="hidden" id="price" name="price" value="<?= $this->input->post('price')?>">
                                    <input type="hidden" id="stock" name="stock" value="<?= $this->input->post('stock')?>">
                                    <input type="text" name="barcode" id="barcode" class="form-control" value="<?= $this->input->post('barcode');?>">
                                    <span class="input-group-btn">
                                        <button type="button" name="search" id="search" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalitem">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="qty">Qty</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="qty" id="qty" class="form-control" value="<?= $this->input->post('qty') != null ? $this->input->post('qty') : 1;?>" min="1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="form-group">
                                    <button type="button" name="add_cart" id="add_card" class="btn btn-primary btn-sm">
                                        <i class="fa fa-cart-plus"></i> Add
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h3>Invoice <b><span id="invoice">MP0123456789</span></b></h4>
                        <h5><b><span id="grand_total2" style="font-size:50pt;">0</span></b></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Product Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th width="10%">Discount Item</th>
                                <th width="15%">Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart_table">
                            <tr>
                                <td colspan="8" class="text-center">Tidak Ada Item</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="sub_total">Sub Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="sub_total" id="sub_total" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="discount">Discount</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="discount" id="discount" value="<?= $this->input->post('discount') == null ?0 : $this->input->post('discount')?>" min="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="grand_total">Grand Total</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="grand_total" id="grand_total" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top; width:30%;">
                                <label for="cash">Cash</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="cash" id="cash" class="form-control" value="<?= $this->input->post('cash') == null ? 0 : $this->input->post('cash');?>" min="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="change">Change</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="change" id="change" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="note">Note</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <textarea name="note" id="note" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div>
                <button id="process_payment" class="btn btn-success btn-sm">
                    <i class="fa fa-paper-plane-o"></i> Process Payment
                </button>
                <button id="cancel_payment" class="btn btn-danger btn-sm">
                    <i class="fa fa-refresh"></i> Cancel
                </button>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->