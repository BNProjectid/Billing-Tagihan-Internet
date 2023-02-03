<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?> | <?= $company['company_name'] ?> | <?= $company['sub_name'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800|Playfair+Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>frontend/libraries/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>frontend/styles/main.css">
</head>

<body>
    <!-- Navbar -->
    <div class="menu-bar">
        <div class="container">
            <nav class="row navbar navbar-expand-lg navbar-light ">
                <a href="<?= site_url('front') ?>" class="navbar-brand">
                    <img src="<?= base_url('assets/images/' . $company['logo']) ?>" alt="logo">
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navb">
                    <ul class="navbar-nav ml-auto mr-3">
                        <li class="nav-item mx-md-2">
                            <a href="<?= site_url('front') ?>" class="nav-link <?= $title == 'Home' ? 'active' : '' ?>">Beranda</a>
                        </li>
                        <li>
                            <a href="<?= site_url('front/faq') ?>" class="nav-link <?= $title == 'FAQ' ? 'active' : '' ?>">Diskusi</a>
                        </li>
                        <!-- Mobile Button -->
                        <a href="<?= site_url('auth') ?>" style="text-decoration: none">
                            <div class="form-inline d-sm-block d-md-none">
                                <button class="btn btn-login  my-2 my-sm-0 px-4">Masuk</button>
                            </div>
                        </a>
                        <!-- Desktop Button -->
                        <a href="<?= site_url('auth') ?>">
                            <div class="form-inline my-2 my-lg-0 d-none d-md-block">
                                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">Masuk</button>
                            </div>
                        </a>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <main>
        <script src="<?= base_url('assets/') ?>frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
        <?= $contents ?>
    </main>
    <div class="footer">
        <div class="container">
            Copyright &copy; <?= date('Y') ?> <?= $company['company_name'] ?> Developed By 1112-Project
        </div>
    </div>


    <script src="<?= base_url('assets/') ?>frontend/libraries/bootstrap/js/bootstrap.js"></script>

</body>

</html>
