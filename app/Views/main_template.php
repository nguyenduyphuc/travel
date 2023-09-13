<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="<?= base_url('assets/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <?= $this->renderSection('specific-css') ?>

    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/images/icon/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('assets/images/icon/apple-icon-60x60.png') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('assets/images/icon/apple-icon-72x72.png') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/images/icon/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('assets/images/icon/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('assets/images/icon/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('assets/images/icon/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('assets/images/icon/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/images/icon/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url('assets/images/icon/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/images/icon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/images/icon/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/icon/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('assets/images/icon/manifest.json') ?>">

    <?= $this->renderSection('specific-tag') ?>
  </head>
  <body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo.png') ?>" width="40" height="40" alt="Bali Bagus Watersport">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Watersport
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('tanjung-benoa-watersport') ?>">Aktivitas Watersport</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('assets/file/harga-watersport.pdf') ?>">List Harga (PDF)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('galeri') ?>">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('hubungi-kami') ?>">Hubungi Kami</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="GET" action="<?= base_url('cari-produk') ?>">
                    <?= csrf_field() ?>
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-info" style="margin-left:-1em" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Content -->
    <?= $this->renderSection('content') ?>
    <!-- End Content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center justify-content-center">
            <div class="row">
                <div class="my-4">
                    <img src="<?= base_url('assets/images/logo.png'); ?>" height="75" width="75" alt="Bali Bagus Watersport">
                </div>
                <p class="h5">Hubungi Kami</p>
                <div class="mb-3">
                    <a href="https://wa.me/6287733773159" target="_blank"><img class="ms-3 me-3" src="<?= base_url('assets/images/wa.png'); ?>" height="50" width="50" alt="Bali Bagus Watersport Whatsapp"></a>
                    <a href="https://www.instagram.com/balibaguswatersport/" target="_blank"><img class="ms-3 me-4" src="<?= base_url('assets/images/ig.png'); ?>" height="50" width="50" alt="Bali Bagus Watersport Instagram"></a>
                    <a href="https://www.facebook.com/profile.php?id=100091142362327&mibextid=ZbWKwL" target="_blank"><img class="ms-3 me-4" src="<?= base_url('assets/images/fb.png'); ?>" height="43" width="43" alt="Bali Bagus Watersport Facebook"></a>
                </div>
                <div class="border-top"></div>
            </div>
        </div>
    </footer>

    <button class="btn btn-primary" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-chevron-up fa-xl"></i></button>
    

    <p class="mt-2 text-body-secondary text-center">&copy; 2023 Bali Bagus Watersport</p>
    <!-- End Footer -->

    <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/fontawesome/js/all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <?= $this->renderSection('specific-js') ?>
    
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
  </body>
</html>