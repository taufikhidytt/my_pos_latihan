<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('item')?>">Items</a></li>
        <li class="active"><i class="fa fa-archive"></i> Create And Update Items</li>
    </ol>
</section>
<?php $this->view('massage');?>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-right">
                <a href="<?= base_url('item')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="<?= base_url('item/process')?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="item_id" id="item_id" value="<?= $data->item_id?>">
                        <label for="barcode">Barcode Items <span class="text-red">*</span></label>
                        <input type="text" name="barcode" id="barcode" class="form-control" autocomplete="off" placeholder="Masukan Barcode Items" value="<?= $data->barcode?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name Items <span class="text-red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Name Items" value="<?= $data->name?>" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category Items <span class="text-red">*</span></label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">--Pilih--</option>
                            <?php foreach($category->result() as $category):?>
                                <option value="<?= $category->category_id?>" <?= $category->category_id == $data->category_id ? 'selected' : null?>><?= $category->name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_id">Unit Items <span class="text-red">*</span></label>
                        <select name="unit_id" id="unit_id" class="form-control" required>
                            <option value="">--Pilih--</option>
                            <?php foreach($unit->result() as $unit):?>
                                <option value="<?= $unit->unit_id?>" <?= $unit->unit_id == $data->unit_id ? 'selected' : null?>><?= $unit->name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price Items <span class="text-red">*</span></label>
                        <input type="number" name="price" id="price" class="form-control" autocomplete="off" placeholder="Masukan Price Items" value="<?= $data->price?>" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image Items</label><br>
                        <?php if($page == 'edit'):?>
                            <?php if($data->image):?>
                                <a href="<?= base_url('upload/product/'.$data->image)?>" target="blank">
                                    <img src="<?= base_url('upload/product/'.$data->image)?>" alt="Photo Item" style="width: 50%; margin-bottom:10px;">
                                    
                                </a>
                                <a href="<?= base_url('item/hapusPhoto/'.$data->item_id)?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Photo Ini?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            <?php endif;?>
                        <?php endif;?>
                        <input type="file" name="image" id="image" class="form-control">
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