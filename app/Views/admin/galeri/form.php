<?php
    $session  = \Config\Services::session();
    $validationErrors = $session->getFlashdata('validation'); 
?>

<?= $this->extend('admin_template') ?>

<?= $this->section('specific-css') ?>
    <!-- Taruh spesifik css untuk tiap halaman disini -->
    <style>
        .p-admin{
            margin-bottom: -0.15rem; 
            font-size: 1.25rem; 
            text-align: left; 
            margin-top: 0.5rem !important;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= isset($galeri->id_galeri) ? 'Edit' : 'Tambah' ?> Foto Galeri</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
        <li class="breadcrumb-item"><a href="<?= route_to('admin/galeri'); ?>">List Foto Galeri</a></li>
        <li class="breadcrumb-item active"><?= isset($galeri->id_galeri) ? 'Edit' : 'Tambah' ?> Foto Galeri</li>
    </ol>

    <!-- Form Kategori -->
    <form action="<?= base_url(); ?>/admin/galeri/<?= isset($galeri->id_galeri) ? $galeri->id_galeri : '' ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <?= csrf_field(); ?>

            <?php if(isset($galeri->id_galeri)) : ?>
                <input type="hidden" name="_method" value="PUT" />
            <?php endif; ?>

            <div class="offset-lg-1 col-lg-10 mt-3">

                <?php if($session->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $session->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="card h-auto">
                    <div class="card-header bg-gradient-primary">
                        <p class="h4 text-white text-center">Foto Galeri</p>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">

                            <div class="d-flex justify-content-center">
                                <?php if(isset($galeri->foto)) : ?>
                                    <img class="card-img mb-3 w-25" src="<?= base_url(); ?>/assets/images/gallery/<?= $galeri->foto ?>">
                                <?php endif; ?>
                            </div>

                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Foto Galeri</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="file" name="foto">
                                <input type="text" name="image_path" class="form-control" value="<?= isset($galeri->foto) ? $galeri->foto : old(esc('foto')) ?>" hidden>
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['foto'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['foto'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Alt Foto</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="alt_foto" class="form-control <?= isset($validationErrors['alt_foto']) ? 'is-invalid' : '' ?>" value="<?= isset($galeri->alt_foto) ? $galeri->alt_foto : old(esc('alt_foto')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['alt_foto'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['alt_foto'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="offset-lg-1 col-lg-10 mt-3 text-center mb-4">

                <div class="row form-group mt-3">
                    <label class="col-xl-2 col-form-label"></label>
                    <div class="col-xl-10 text-center">
                        <input type="submit" name="submit" class="btn btn-info" value="Save Data">
                    </div>
                </div>

            </div>

        </div>

    </form>
<?= $this->endSection() ?>

<?= $this->section('specific-js') ?>
    <!-- Taruh spesifik js untuk tiap halaman disini -->
<?= $this->endSection() ?>