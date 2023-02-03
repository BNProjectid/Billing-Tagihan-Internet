<?php $no = 1;
if ($invoice->num_rows() > 0) {
    foreach ($invoice->result() as $c => $data) { ?>
        <tr>
            <td><?= $no++ ?>.</td>
            <td><?= $data->item_name ?></td>
            <td><?= $data->category_name ?></td>
            <td style="text-align: center"><?= $data->qty ?></td>
            <td style="text-align: right"><?= indo_currency($data->detail_price) ?></td>
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

        </tr>

<?php
    }
} else {
    echo '<tr>
        <td colspan="9" class="text-center">Belum ada layanan</td>
    </tr>';
} ?>