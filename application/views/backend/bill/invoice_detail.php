  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

  <div class="col-lg-12">
      <div class="card shadow mb-2">
          <div class="card-header py-1">
              <h6 class="m-0 font-weight-bold">Rincian Tagihan</h6> #<?= $bill['no_services'] ?>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label class="col-sm-12 control-label">Nama Pelanggan</label>
                              <div class="col-sm-9">
                                  <input type="text" name="date1" id="date1" value="<?= $bill['name'] ?>" class="form-control" readonly>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Bulan</label>
                              <div class="col-sm-9">
                                  <input type="text" name="date1" id="date1" value="<?= indo_month($bill['month']) ?>" class="form-control" readonly>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label class="col-sm-4 control-label">Tahun</label>
                              <div class="col-sm-8">
                                  <input type="text" name="date1" id="date1" value="<?= $bill['year'] ?>" class="form-control" readonly>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="container">
      <?php $this->view('messages') ?>
  </div>
  <div class="col-lg-12">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <div class="d-sm-flex align-items-center justify-content-between">
                  <?php if ($bill['status'] == 'SUDAH BAYAR') { ?>
                      <h3 style="font-weight:bold; color:green"><?= $bill['status'] ?> </h3>
                  <?php } ?>
                  <?php if ($bill['status'] == 'BELUM BAYAR') { ?>
                      <h3 style="font-weight:bold; color:red"><?= $bill['status'] ?> </h3>
                  <?php } ?>
                  <?php $subtotal = 0;
                    foreach ($invoice->result() as $c => $data) {
                        $subtotal += (int) $data->total;
                    } ?>
                  <?php if ($bill['status'] == 'SUDAH BAYAR') { ?>
                      <a href="https://api.whatsapp.com/send?phone=<?= indo_tlp($bill['no_wa']) ?>&text=Plg Yth, Terima kasih Anda Telah membayar iuran Wifi / Internet no <?= $bill['no_services'] ?> a/n <?= $bill['name'] ?> sebesar <?= indo_currency($subtotal) ?>. %0A%0A%0A <?= $company['company_name'] ?> %0A<?= $company['sub_name'] ?>" class="btn btn-success" target="blank"> <i class="fab fa-whatsapp"> Send Thank's</i></a>
                  <?php } ?>
                  <?php if ($bill['status'] == 'BELUM BAYAR') { ?>
                      <h3 style="font-weight:bold; color:red"> <a href="#" data-toggle="modal" data-target="#bayar" class="btn btn-success">Bayar ?</a> </h3>
                  <?php } ?>
              </div>
          </div>
          <br>
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
                                      </tr>
                                  </thead>
                                  <tbody id="dataTables">
                                      <?php $this->view('backend/bill/list_detail'); ?>
                                  <tfoot>
                                      <tr style="text-align: right">
                                          <th colspan="6">Grand Total</th>
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
  <div class="container" style="margin-top: -20px">* <?= number_to_words($subtotal) ?></div>

  <!-- Modal Add -->
  <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= site_url('bill/payment') ?>" method="POST">
                      <input type="hidden" name="invoice" value="<?= $bill['invoice'] ?>">
                      <input type="hidden" name="no_services" value="<?= $bill['no_services'] ?>">
                      <input type="hidden" name="name" value="<?= $bill['name'] ?>">
                      <input type="hidden" name="nominal" value="<?= $subtotal ?>">
                      <input type="hidden" name="year" value="<?= $bill['year'] ?>">
                      <input type="hidden" name="month" value="<?= indo_month($bill['month']) ?>">
                      Apakah yakin iuran dengan no layanan <?= $bill['no_services'] ?> a/n <b><?= $bill['name'] ?></b> Periode <?= indo_month($bill['month']) ?> <?= $bill['year'] ?> sudah terbayarkan ?, jika sudah silahkan isi tanggal bayar iuran.
                      <br>
                      <br>
                      <div class="form-group">
                          <label for="date_payment"><b> Tanggal Bayar</b></label> <span style="font-size: 10px">Format : yyyy-mm-dd Contoh <?= date('Y-m-d') ?></span>
                          <input type="text" name="date_payment" id="datepicker" class="form-control" required>
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
          </div>
      </div>
  </div>
  <!-- bootstrap datepicker -->
  <script src="<?= base_url('assets/backend') ?>/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- <link href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
  <script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
  <script>
      //Date picker
      $('#datepicker').datepicker({
          maxDate: '0',
          format: 'yyyy-mm-dd',
          autoclose: true,
      })
  </script>