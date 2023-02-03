<?php $no = 1;
foreach ($bill as $r => $data) { ?>
    Plg Yth, Iuran Internet no <?= $data->no_services ?> a/n <?= $data->name ?>
<?php } ?>