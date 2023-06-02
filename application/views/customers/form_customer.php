<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('customer')?>">Customers</a></li>
        <li class="active"><i class="fa"></i> Create And Update Customers</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="<?= base_url('customer')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="<?= base_url('customer/process')?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="customer_id" id="customer_id" value="<?= $data->customer_id?>">
                        <label for="name">Name Customer <span class="text-red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Name Customer" value="<?= $data->name?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender <span class="text-red">*</span></label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">--Pilih--</option>
                            <option value="Laki-Laki" <?= $data->gender == 'Laki-Laki' ? 'selected' : null?>>Laki-Laki</option>
                            <option value="Perempuan" <?= $data->gender == 'Perempuan' ? 'selected' : null?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-red">*</span></label>
                        <input type="number" name="phone" id="phone" class="form-control" autocomplete="off" placeholder="Masukan Phone Customer" value="<?= $data->phone?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address Customer <span class="text-red">*</span></label>
                        <textarea name="address" id="address" class="form-control" placeholder="Masukan Addres Customer" required><?= $data->address?></textarea>
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