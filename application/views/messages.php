<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> <?= $this->session->flashdata('success'); ?>
    </div>
<?php } ?>

<?php if ($this->session->has_userdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-ban"></i> <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>

<?php if ($this->session->has_userdata('successpay')) { ?>
    <div class="login-box-body">
        <p class="login-box-msg"> <?= $this->session->flashdata('successpay'); ?></p>
        <?php $this->view('messages') ?>
        <?= $bank; ?>
        <a href="<?= site_url('auth') ?>">Back to login</a><br>
        <a href="<?= site_url('auth/register') ?>" class="text-center">Register a new membership</a>

    </div>
<?php } ?>