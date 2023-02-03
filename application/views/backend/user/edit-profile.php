<div class="col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><?= $title; ?></h6>

        </div>
        <div class="card-body">

            <div class="box box-primary">
                <div class="row">
                    <div class="col">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                            <?= form_open_multipart('user/edit'); ?>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                    <?= form_error('name', '<small class="text-danger pl-3 ">', '</small>') ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="<?= $user['gender']; ?>"><?= $user['gender']; ?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <?= form_error('gender', '<small class="text-danger pl-3 ">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" value="<?= $user['phone']; ?>" placeholder="">
                                    <?= form_error('phone', '<small class="text-danger pl-3 ">', '</small>') ?>
                                </div>

                                <input type="hidden" class="form-control" id="image1" name="image1" value="<?= $user['image']; ?>" placeholder="">


                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="image" class="file-upload-default">

                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="4"><?= $user['address']; ?></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="reset" class="btn">Reset</button>
                                    <button "submit" class="btn btn-success"> <i class="ik ik-save"></i> Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->