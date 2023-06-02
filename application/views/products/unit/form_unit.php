<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('unit')?>">Units</a></li>
        <li class="active"><i class="fa fa-archive"></i> Create And Update Categories</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="<?= base_url('unit')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="<?= base_url('unit/process')?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="unit_id" id="unit_id" value="<?= $data->unit_id?>">
                        <label for="name">Name Units <span class="text-red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Name Units" value="<?= $data->name?>" required>
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