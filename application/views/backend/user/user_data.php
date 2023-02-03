<?php if ($this->session->userdata('role_id') == 1) { ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Pengguna</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>


    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Package</h3>
                <div class="pull-right">
                    <a href="<?= site_url('auth/register') ?>" class="btn btn-flat btn-primary">
                        <i class="fa fa-plus"></i> Add User
                    </a>
                </div>
            </div>
            <?php $this->view('messages') ?>
            <div class="box-body table-responsive">
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Picture</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($row as $r => $data) { ?>
                            <tr>
                                <td width="35px"><?= $no++ ?>.</td>
                                <td><?= $data->name ?></td>
                                <td><?= $data->email ?></td>
                                <td class="text-center"><img src="<?= base_url() ?>backend/images/profile/<?= $data->image ?>" alt="" style="width:200px; "></td>
                                <td><?= $data->phone ?></td>
                                <td><?= $data->address ?></td>
                                <td><?= $data->gender ?></td>
                                <td><?= $data->is_active == 1 ? 'Active' : 'Non-Active' ?></td>
                                <td><?= $data->role_id == 1 ? 'Admin' : 'User' ?></td>
                                <td class="text-center" width="160px">
                                    <form>
                                        <a class="btn btn-xs btn-primary" href="#ModalEdit<?= $data->id ?>" data-toggle="modal" title="Edit"><i class="fa fa-edit"> </i> Edit </a>
                                        <a class="btn btn-xs btn-danger" href="#ModalHapus<?= $data->id ?>" data-toggle="modal" title="Hapus"><i class="fa fa-close"></i> Hapus</a>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- MODAL eDIT -->
    <?php foreach ($row as $data) { ?>
        <div class="modal fade" id="ModalEdit<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="formModalLabel">Edit User <?= $data->name ?></h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= base_url('user/edit_user') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data->id ?>" class="form-control">
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0" <?= $data->is_active == 0 ? 'selected' : null ?>>Non Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Level</label>
                                <select name="role_id" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2" <?= $data->role_id == 2 ? 'selected' : null ?>>User</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary"> Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--END MODAL eDIT-->
    <!-- MODAL Hapus -->
    <?php foreach ($row as $data) { ?>
        <div class="modal fade" id="ModalHapus<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="formModalLabel">Delete User</h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= base_url('user/del') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data->id ?>" class="form-control">
                            Apakah anda yakin akan hapus user <?= $data->name ?> ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary"> Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--END MODAL Hapus-->
<?php } ?>