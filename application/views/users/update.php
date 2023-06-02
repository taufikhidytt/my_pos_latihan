<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('users')?>">Users</a></li>
        <li class="active"><i class="fa fa-edit"></i> Update Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                Update Users
            </div>
            <div class="pull-right">
                <a href="<?= base_url('users')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="" method="post">
                    <div class="form-group <?= form_error('username') ? 'has-error' : null?>">
                        <input type="hidden" name="user_id" value="<?= $data->user_id?>">
                        <label for="username">Username <span class="text-red">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" autocomplete="off" placeholder="Masukan Username Anda" value="<?= $this->input->post('username') ?? $data->username ?>">
                        <span class="text-red"><?= form_error('username')?></span>
                    </div>
                    <div class="form-group <?= form_error('name') ? 'has-error' : null?>">
                        <label for="name">Name <span class="text-red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Nama Anda" value="<?= $this->input->post('name') ?? $data->name?>">
                        <span class="text-red"><?= form_error('name')?></span>
                    </div>
                    <div class="form-group <?= form_error('address') ? 'has-error' : null?>">
                        <label for="address">Address <span class="text-red">*</span></label>
                        <textarea name="address" id="address" class="form-control" autocomplete="off" placeholder="Masukan Address Anda"><?= $this->input->post('address') ?? $data->address?></textarea>
                        <span class="text-red"><?= form_error('address')?></span>
                    </div>
                    <div class="form-group <?= form_error('password') ? 'has-error' : null?>">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Masukan Password Anda" value="<?= $this->input->post('password') ?>">
                        <span class="text-red"><?= form_error('password')?></span>
                    </div>
                    <div class="form-group <?= form_error('password2') ? 'has-error' : null?>">
                        <label for="password2">Konfirmasi Password</label>
                        <input type="password" name="password2" id="password2" class="form-control" autocomplete="off" placeholder="Masukan Konfirmasi Password Anda" value="<?= $this->input->post('password2') ?>">
                        <span class="text-red"><?= form_error('password2')?></span>
                    </div>
                    <div class="form-group <?= form_error('level') ? 'has-error' : null?>">
                        <label for="level">Level <span class="text-red">*</span></label>
                        <select name="level" id="level" class="form-control">
                            <option value="">--Pilih--</option>
                            <?php $level = $this->input->post('level') ?? $data->level ?>
                            <option value="1" <?= $level == 1 ? 'selected' : null ?>>Admin</option>
                            <option value="2" <?= $level == 2 ? 'selected' : null ?>>Kasir</option>
                        </select>
                        <span class="text-red"><?= form_error('level')?></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-xs btn-primary">
                            <i class="fa fa-send"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->