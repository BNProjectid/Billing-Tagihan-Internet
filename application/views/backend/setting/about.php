<link href="<?= base_url('assets/backend/') ?>css/bootstrap3-wysihtml5.min.css" rel="stylesheet">
<div class="container">
    <?php $this->view('messages') ?>
</div>
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            Tentang <?= $company['company_name'] ?>
        </div>
        <div class="card-body">
            <form action="<?= site_url('setting/editAbout') ?>" method="POST">
                <textarea name="description" id="editor1" class="form-control"><?= $company['description'] ?></textarea>
                <div class="text-right mt-2">
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/backend/') ?>css/ckeditor/ckeditor.js"></script>
<script src="<?= base_url('assets/backend/') ?>js/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>