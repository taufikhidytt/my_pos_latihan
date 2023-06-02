<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('supplier')?>">Suppliers</a></li>
        <li class="active"><i class="fa"></i> Create And Update Suppliers</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="<?= base_url('supplier')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="<?= base_url('supplier/process')?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="supplier_id" id="supplier_id" value="<?= $data->supplier_id?>">
                        <label for="name">Name Supplier <span class="text-red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Name Supplier" value="<?= $data->name?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-red">*</span></label>
                        <input type="number" name="phone" id="phone" class="form-control" autocomplete="off" placeholder="Masukan Phone Supplier" value="<?= $data->phone?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address Supplier <span class="text-red">*</span></label>
                        <textarea name="address" id="address" class="form-control" placeholder="Masukan Addres Supplier" required><?= $data->address?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description Supplier <span class="text-red">*</span></label>
                        <textarea name="description" id="description" class="form-control" placeholder="Masukan Description Supplier" required><?= $data->description?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="<?= $page?>" class="btn btn-xs btn-primary">
                            <i class="fa fa-send"></i> Simpan
                        </button>
                        <button type="reset" name="reset" class="btn btn-xs btn-warning">
                            <i class="fa fa-undo"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->