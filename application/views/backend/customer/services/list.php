<div class="col-lg-12">
    <div class="card shadow mb-2">
        <div class="card-header py-1">
            <h6 class="m-0 font-weight-bold">Rincian Layanan</h6> #<?= $customer->no_services ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Nama Pelanggan</label>
                            <div class="col-sm-9">
                                <input type="text" name="date1" id="date1" value="<?= $customer->name ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No KTP</label>
                            <div class="col-sm-9">
                                <input type="text" name="date1" id="date1" value="<?= $customer->no_ktp ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">No Telp.</label>
                            <div class="col-sm-8">
                                <input type="text" name="date1" id="date1" value="<?= $customer->no_wa ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <a href="#" data-toggle="modal" data-target="#addModal" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Layanan</a>
                <?php $subtotal = 0;
                foreach ($services->result() as $c => $data) {
                    $subtotal += (int) $data->total;
                } ?>
                <?php if ($services->num_rows() > 0) { ?>
                    <h3 style="font-weight:bold"> <?= indo_currency($subtotal) ?> /bln</h3>
                <?php } ?>
                <?php if ($services->num_rows() <= 0) { ?>
                    <h3 style="font-weight:bold"> <?= indo_currency($subtotal) ?> /bln</h3>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="container">
            <?php $this->view('messages') ?>
        </div>
        <div class="card-body py-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-widget">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="text-align: center; width:20px">No</th>
                                        <th>Item Layanan</th>
                                        <th>Kategori</th>
                                        <th style="text-align: center">Jumlah</th>
                                        <th style="text-align: center">Harga</th>
                                        <th style="text-align: center">Diskon</th>
                                        <th style="text-align: center">Total</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTables">
                                    <?php $this->view('backend/customer/services/detail_services'); ?>
                                <tfoot>
                                    <tr style="text-align: right">
                                        <th colspan="6"><b> Total</b></th>
                                        <th><?= indo_currency($subtotal) ?></th>
                                    </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center; width:20px">No</th>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th style="text-align: center; width:50px; margin: 40px auto;">Jumlah</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($p_item as $r => $data) { ?>
                                <tr>
                                    <td style="text-align: center"><?= $no++ ?>.</td>
                                    <td><?= $data->nameItem ?></td>
                                    <td><?= indo_currency($data->price) ?></td>
                                    <td><?= $data->category_name ?></td>
                                    <form action="<?= site_url('services/add/' . $customer->no_services) ?>" method="post">
                                        <td>
                                            <input type="number" name="qty" class="form-control input-number" value="1" min="1" max="100">
                                        </td>
                                        <td style="text-align: center">
                                            <input type="hidden" value="<?= $customer->no_services ?>" name="no_services">
                                            <input type="hidden" value="<?= $data->p_item_id ?>" name="item_id">
                                            <input type="hidden" value="<?= $data->p_category_id ?>" name="category_id">
                                            <input type="hidden" value="<?= $data->price ?>" name="price">
                                            <button class="btn btn-success" type="submit" title="Add"><i class="fa fa-plus"> Tambahkan</i></button>
                                    </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // on modal edit
    $(document).on('click', '#update', function() {
        $('#services_id').val($(this).data('services_id'))
        $('#no_services').val($(this).data('no_services'))
        $('#item_name').val($(this).data('item_name'))
        $('#category_name').val($(this).data('category_name'))
        $('#price').val($(this).data('price'))
        $('#qty').val($(this).data('qty'))
        $('#disc').val($(this).data('disc'))
        $('#total').val($(this).data('total'))
        $('#remark').val($(this).data('remark'))
    })


    function count() {
        var price = $('#price').val()
        var qty = $('#qty').val()
        var disc = $('#disc').val()
        total = (price * qty) - disc
        $('#total').val(total)
    }

    $(document).on('keyup mouseup', '#disc, #qty, #price', function() {
        count()
    })
</script>