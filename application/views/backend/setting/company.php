<?php $this->view('messages') ?>
<div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Data Perusahaan</h6>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                    <?php echo form_open_multipart('setting/editCompany') ?>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $company['id'] ?>">
                        <label for="name">Nama Perusahaan</label>
                        <input type="text" id="name" name="company_name" class="form-control" value="<?= $company['company_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sub">Slogan / Moto</label>
                        <input type="text" id="sub" name="sub_name" class="form-control" value="<?= $company['sub_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?= $company['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="hp">No Telp</label> *<span style="font-size: 10px"> aktif WA</span>
                        <input type="text" id="hp" name="hp" class="form-control" value="<?= $company['whatsapp'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="fb">Facebook</label>
                        <input type="text" id="fb" name="fb" class="form-control" value="<?= $company['facebook'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ig">Instagram</label>
                        <input type="text" id="ig" name="ig" class="form-control" value="<?= $company['instagram'] ?>">
                    </div>


                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-body">
                    <div class="form-group">
                        <label for="logo">Logo</label><br>
                        <img src="<?= base_url('assets/images/') ?><?= $company['logo'] ?>" style=" display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;" alt=""> <br>
                        <input type="file" name="logo">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" class="form-control"><?= $company['address'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="owner">Nama Pemilik</label>
                        <input type="text" id="owner" name="owner" class="form-control" value="<?= $company['owner'] ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>