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
        <h1 class="h3 mb-0 text-gray-800"><?= isset($tak_termasuk->id_tidak_termasuk) ? 'Edit '.$tak_termasuk->nama_produk. ' Exclusion' : 'Tambah Produk Exclusion' ?></h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
        <li class="breadcrumb-item"><a href="<?= route_to('admin/tak-termasuk'); ?>">Produk Exclusion List</a></li>
        <li class="breadcrumb-item active"><?= isset($tak_termasuk->id_tidak_termasuk) ? 'Edit '.$tak_termasuk->nama_produk. ' Exclusion' : 'Tambah Produk Exclusion' ?></li>
    </ol>

    <!-- Form Kategori -->
    <form action="<?= base_url(); ?>/admin/tak-termasuk/<?= isset($tak_termasuk->id_tidak_termasuk) ? $tak_termasuk->id_tidak_termasuk : '' ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <?= csrf_field(); ?>

            <?php if(isset($tak_termasuk->id_tidak_termasuk)) : ?>
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
                        <p class="h4 text-white text-center">Produk Exclusion</p>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">

                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Produk Exclusion</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="deskripsi" class="form-control <?= isset($validationErrors['deskripsi']) ? 'is-invalid' : '' ?>"value="<?= isset($ketentuan->deskripsi) ? $ketentuan->deskripsi : old(esc('deskripsi')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['deskripsi'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['deskripsi'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Produk</label>
                            <div class="col-xl-6 col-md-6">
                                <select name="produk_id" class="form-control <?= isset($validationErrors['produk_id']) ? 'is-invalid' : '' ?>">
                                    <?php foreach($dataProduk as $produk) : ?>
                                        <?php if(isset($ketentuan->produk_id) && $ketentuan->produk_id === $produk->id_produk) : ?>
                                            <option selected value="<?= $produk->id_produk ?>"><?= $produk->nama_produk ?></option>
                                        <?php else : ?>
                                            <option value="<?= $produk->id_produk ?>"><?= $produk->nama_produk ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['produk_id'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['produk_id'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row form-group mt-3">
                            <div class="col-xl-10 text-center">
                                <input type="submit" name="submit" class="btn btn-info" value="Save Data">
                            </div>
                        </div>

                    </div>
                </div>           

            </div>

        </div>

    </form>
<?= $this->endSection() ?>

<?= $this->section('specific-js') ?>
    <!-- Taruh spesifik js untuk tiap halaman disini -->
<?= $this->endSection() ?>