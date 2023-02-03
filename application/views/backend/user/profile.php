<div class="col-6">

    <?php $this->view('messages') ?>

</div>
<div class="col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="col">
                        <img style=" display: block;margin-left: auto;margin-right: auto;width: 100%; max-height:450px" class="profile-user-img img-responsive img-profile rounded-circle" src="<?= base_url('assets/images/profile/' . $user['image']) ?>" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center mt-2"><?= $user['name'] ?></h3>
                    <h5 class="text-center"><?= $user['email'] ?>
                        <a href="" data-toggle="modal" data-target="#email" title="Edit Email">
                            <i class="fa fa-edit"></i></a></h5>
                </div>
                <!-- /.box-body -->
                <br>
                <div class="d-sm-flex align-items-center justify-content-between">
                    <a href="<?= site_url('user/changepassword') ?>" class="btn btn-primary"> Change Password</a>
                    <a href="<?= site_url('user/edit') ?>" class="btn btn-primary"> Edit Profile</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('user/editEmail') ?>" method="POST">
                    <div class="form-group">
                        <label for="cemail">Current Email</label>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <input type="text" name="cemail" id="cemail" class="form-control" value="<?= $user['email'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">New Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>