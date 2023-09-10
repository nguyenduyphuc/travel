<?= $this->extend('main_template') ?>

<?= $this->section('specific-css') ?>
    <!-- Taruh spesifik css untuk tiap halaman disini -->
    <style>
        .icon {
            font-size: 5em;
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
    <div class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark cover-homepage" style="background-image: url(<?= base_url(); ?>/assets/img/ulun-danu-temple.jpg);">
        <div class="container">
            <div class="row align-items-center d-flex justify-content-between">
                <div class="col-12 col-md-6 pb-5 order-2 order-sm-2 text-cover">
                </div>
            </div>
        </div>
    </div>
    <!-- End Cover -->


<?= $this->endSection() ?>

<?= $this->section('specific-js') ?>
    <!-- Taruh spesifik js untuk tiap halaman disini -->
<?= $this->endSection() ?>