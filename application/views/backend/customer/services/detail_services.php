<?php $no = 1;
if ($services->num_rows() > 0) {
    foreach ($services->result() as $c => $data) { ?>
        <tr>
            <td><?= $no++ ?>.</td>
            <td><?= $data->item_name ?></td>
            <td><?= $data->category_name ?></td>
            <td style="text-align: center"><?= $data->qty ?></td>
            <td style="text-align: right"><?= indo_currency($data->services_price) ?></td>
            <td style="text-align: right">
                <?php if ($data->disc <= 0) { ?>
                    -
                <?php } ?>
                <?php if ($data->disc > 0) { ?>

                    <?= indo_currency($data->disc)  ?>
                <?php } ?>

            </td>
            <td style="text-align: right"><?= indo_currency($data->total) ?></td>
            <td><?= $data->remark ?></td>
            <td style="text-align: center"><a href="#" id="update" data-services_id="<?= $data->services_id ?>" data-item_name="<?= $data->item_name ?>" data-category_name="<?= $data->category_name ?>" data-price="<?= $data->services_price ?>" data-qty="<?= $data->qty ?>" data-disc="<?= $data->disc ?>" data-remark="<?= $data->remark ?>" data-no_services="<?= $data->no_services ?>" data-total="<?= $data->total ?>" data-toggle="modal" data-target="#modal-item-edit" title="Edit"><i class="fa fa-edit" style="font-size:25px"></i></a> <a href="#" data-toggle="modal" data-target="#DeleteModal<?= $data->services_id ?>" title="Hapus"><i class="fa fa-trash" style="font-size:25px; color:red"></i></a></td>
        </tr>

<?php
    }
} else {
    echo '<tr>
        <td colspan="9" class="text-center">Belum ada layanan</td>
    </tr>';
} ?>


<!-- Modal Edit -->

<div class="modal fade" id="modal-item-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Item Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('services/edit') ?>
                <input type="hidden" id="services_id" name="services_id">
                <input type="hidden" id="no_services" name="no_services">
                <div class="form-group">
                    <label for="item_name">Item Paket</label>
                    <input type="text" id="item_name" name="item_name" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" id="category_name" name="category" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="disc">Disc</label>
                            <input type="number" name="disc" id="disc" min="0" value="0" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" id="total" name="total_modal" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="remark">Remark</label>
                    <input type="text" id="remark" name="remark" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<?php
foreach ($services->result() as $c => $data) { ?>
    <div class="modal fade" id="DeleteModal<?= $data->services_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus daftar layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('services/delete') ?>
                    <input type="hidden" name="services_id" value="<?= $data->services_id ?>">
                    <input type="hidden" name="no_services" value="<?= $data->no_services ?>">
                    Apakah anda yakin akan hapus item <?= $data->item_name ?> dari no layanan <?= $data->no_services ?> ?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php
} ?>