 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
 </div>
 <?php $this->view('messages') ?>
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold">Data Kategori Layanan</h6>
     </div>
     <div class="card-body">
         <div class="table-responsive">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                     <tr>
                         <th style="text-align: center; width:20px">No</th>
                         <th>Nama Kategori</th>
                         <th>Keterangan</th>
                         <th style="text-align: center">Aksi</th>
                     </tr>
                 </thead>
                 <tfoot>
                     <tr>
                         <th style="text-align: center">No</th>
                         <th>Nama Kategori</th>
                         <th>Keterangan</th>
                         <th style="text-align: center">Aksi</th>
                     </tr>
                 </tfoot>
                 <tbody>
                     <?php $no = 1;
                        foreach ($p_category as $r => $data) { ?>
                         <tr>
                             <td style="text-align: center"><?= $no++ ?>.</td>
                             <td><?= $data->name ?></td>
                             <td><?= $data->description ?></td>
                             <td style="text-align: center"><a href="" data-toggle="modal" data-target="#EditModal<?= $data->p_category_id ?>" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="" data-toggle="modal" data-target="#DeleteModal<?= $data->p_category_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>



 <!-- Modal Add -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?php echo form_open_multipart('package/addPCategory') ?>
                 <div class="form-group">
                     <label for="name">Nama Kategori</label>
                     <input type="text" id="name" name="name" class="form-control" required>
                 </div>
                 <div class="form-group">
                     <label for="description">Keterangan</label>
                     <textarea id="description" name="description" class="form-control"> </textarea>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
                 <?php echo form_close() ?>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal Edit -->
 <?php
    foreach ($p_category as $r => $data) { ?>
     <div class="modal fade" id="EditModal<?= $data->p_category_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit Kategori </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('package/editPCategory') ?>
                     <div class="form-group">
                         <input type="hidden" name="p_category_id" value="<?= $data->p_category_id ?>" class="form-control">
                         <label for="name">Nama Kategori</label>
                         <input type="text" id="name" name="name" value="<?= $data->name ?>" class="form-control" required>
                     </div>
                     <div class="form-group">
                         <label for="description">Keterangan</label>
                         <textarea id="description" name="description" class="form-control"><?= $data->description ?> </textarea>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-primary">Simpan</button>
                     </div>
                     <?php echo form_close() ?>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>

 <!-- Modal Hapus -->
 <?php
    foreach ($p_category as $r => $data) { ?>
     <div class="modal fade" id="DeleteModal<?= $data->p_category_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <?php echo form_open_multipart('package/deletePCategory') ?>
                     <input type="hidden" name="p_category_id" value="<?= $data->p_category_id ?>" class="form-control">
                     Apakah yakin akan hapus kategori <?= $data->name ?> ?
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-danger">Hapus</button>
                     </div>
                     <?php echo form_close() ?>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>