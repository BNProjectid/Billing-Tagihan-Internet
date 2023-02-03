<?php $subtotal = 0;
foreach ($bill->result() as $c => $data) {
    $subtotal += (int) $data->total;
} ?>

<?php
if ($customer->num_rows() > 0) { ?>
    <?php
    if ($bill->num_rows() > 0) { ?>
        <?php $query = "SELECT *
                                    FROM `customer`
                                        WHERE `customer`.`no_services` = $data->no_services";
        $querying = $this->db->query($query);
        ?>
        <!-- // var_dump($querying);  -->
        <?php
        foreach ($querying->result() as  $dataa)
        ?>
        <?php if ($data->status == 'BELUM BAYAR') {
        # code...
        ?>
            <div class="info-tagihan">
                <div class="container">
                    <div class="card border-primary mb-2">
                        <div class="container mt-2">
                            <h5>Periode <?= indo_month($data->month) ?> 2020</h5>
                            <div class="row">
                                <div class="col-3">
                                    No Layanan
                                </div>
                                <div class="col-8">
                                    : <?= $data->no_services ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    Nama Pelanggan
                                </div>
                                <div class="col-8">
                                    : <?= $dataa->name ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    Jumlah Iuran
                                </div>
                                <div class="col-8">
                                    : <?= indo_currency($subtotal) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    Terbilang
                                </div>
                                <div class="col-8 mb-3">
                                    : <b><?= number_to_words($subtotal) ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
        echo ' <div class="text-center mb-3">
                <div class="container">
                    <div class="card border-success">
                        <div class="card-body">
                            <h4 class="card-title text-success">Data Iuran sudah dibayar</h4>
                        </div>
                    </div>
                </div>
            </div>';
    } ?>

<?php
    } else {
        echo '<div class="text-center mb-3">
    <div class="container">
        <div class="card border-danger">
            <div class="card-body">
                <h4 class="card-title text-danger">Data Iuran belum Tersedia</h4>
            </div>
        </div>
    </div>
</div>';
    }
} else {
    echo '<div class="text-center mb-3">
        <div class="container">
            <div class="card border-warning">
                <div class="card-body">
                    <h4 class="card-title text-warning">No Layanan tidak Terdaftar, pastikan no layanan anda benar</h4>
                </div>
            </div>
        </div>
    </div>';
} ?>