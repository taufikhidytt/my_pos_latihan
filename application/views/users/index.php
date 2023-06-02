<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $judul?>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-users"></i> Users</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <!-- <h3>Data Users</h3> -->
                <div class="pull-right">
                    <a href="<?= base_url('users/add')?>" class="btn btn-primary btn-xs text-right">
                        <i class="fa fa-plus"></i> Create New Users
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive text-center">
                    <thead class="bg-blue">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($data->result() as $users): ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $users->username?></td>
                            <td><?= $users->name?></td>
                            <td><?= $users->address?></td>
                            <td><?= $users->level == 1 ? 'Admin' : 'Kasir'?></td>
                            <td>
                                <a href="<?= base_url('users/update/'.$users->user_id)?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>    |
                                <form action="<?= base_url('users/del')?>" method="post" class="inline">
                                    <input type="hidden" name="user_id" value="<?= $users->user_id?>">
                                    <button class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->