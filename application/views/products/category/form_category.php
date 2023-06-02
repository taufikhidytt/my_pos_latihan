<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('category')?>">Categories</a></li>
        <li class="active"><i class="fa fa-archive"></i> Create And Update Categories</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="<?= base_url('category')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="<?= base_url('category/process')?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="category_id" id="category_id" value="<?= $data->category_id?>">
                        <label for="name">Name Categories <span class="text-red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Name Categories" value="<?= $data->name?>" required>
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