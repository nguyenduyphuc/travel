<?= $this->extend('main_template') ?>

<?= $this->section('specific-css') ?>
    <!-- Taruh spesifik css untuk tiap halaman disini -->
    <link rel="stylesheet" href="<?= base_url('assets/owl/dist/assets/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/owl/dist/assets/owl.theme.default.min.css') ?>">
    <style>
        .icon {
            font-size: 5em;
        }

        .d-cover {
            display: flex;
        }

        @media (max-width: 767px) {
            .d-cover {
                display: block;
            }
        }

        .owl-carousel .owl-item {
            padding: 0 5px;
        }

        .owl-nav {
            display: none;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('specific-tag') ?>
    <!-- Taruh spesifik meta tag untuk tiap halaman disini -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Nikmati pengalaman watersport Tanjung Benoa, Banana Boat, Jetski, Parasailing">
    <title>Tanjung Benoa Watersport - Bali Bagus Watersport</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Cover -->
    <div class="container-fluid g-0">
        <div class="d-cover flex-row-reverse align-items-stretch">
            <div class="col-xl-6 col-md-6 col-12 bg-primary">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="<?= base_url('assets/images/lempuyang-temple.jpg') ?>" class="d-block w-100" alt="Lempuyang Temple">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="<?= base_url('assets/images/bali-swing.jpg') ?>" class="d-block w-100" alt="Bali Swing">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="<?= base_url('assets/images/ulun-danu-temple.jpg') ?>" class="d-block w-100" alt="Ulun Danu Temple">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12 bg-secondary d-flex flex-column justify-content-center align-items-center p-5">
                <h1>Bali Tour and Travel Service</h1>
                <p class="h6">We provide cheap Bali Tour and Travel activity price for your great journey in Bali</p>
            </div>
        </div>
    </div>
    <!-- End Cover -->

    <!-- Programs -->
    <div class="container my-5">

        <div class="text-center">
            <h3 class="mb-5">Explore Bali with Us!</h3>
        </div>

        <div class="owl-carousel">
            <?php foreach($dataKategori as $kategori) : ?>
            <div class="card h-100">
                <div class="card-body">
                    <?= $kategori->nama_kategori ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    <!-- End Programs -->


<?= $this->endSection() ?>

<?= $this->section('specific-js') ?>
    <!-- Taruh spesifik js untuk tiap halaman disini -->
    <script src="<?= base_url('assets/owl/dist/owl.carousel.min.js') ?>"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:0,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                    items:4,
                        nav:true,
                        loop:false
                    }
                }
            });
        });
    </script>
<?= $this->endSection() ?>