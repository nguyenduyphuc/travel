<?php
    $session  = \Config\Services::session();
    $validationErrors = $session->getFlashdata('validation'); 
?>

<?= $this->extend('admin_template') ?>

<?= $this->section('specific-css') ?>
    <!-- Taruh spesifik css untuk tiap halaman disini -->
    <link rel="stylesheet" href="<?= base_url('admin-assets/vendor/summernote/summernote.min.css'); ?>">
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
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
        <li class="breadcrumb-item"><a href="<?= route_to('admin/produk'); ?>">List Produk</a></li>
        <li class="breadcrumb-item active">Tambah Produk</li>
    </ol>

    <?php if($session->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $session->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Form Produk -->
    <form action="<?= base_url() ?>/admin/produk" method="post" enctype="multipart/form-data">

        <div class="row">

            <?= csrf_field(); ?>
            

            <div class="offset-lg-1 col-lg-4 col-md-6 col-sm-12 text-right mt-2">
                <div class="card h-auto text-center">
                    <div class="card-header bg-gradient-primary">
                        <p class="h4 text-white">Foto Produk</p>
                    </div>
                    <div class="card-body">
                        <p class="p-admin">Foto Produk</p>
                        <input type="file" name="foto_produk" class="form-control <?= isset($validationErrors['foto_produk']) ? 'is-invalid' : '' ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['foto_produk'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['foto_produk'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Alt. Foto</p>
                        <input type="text" name="alt_foto" class="form-control <?= isset($validationErrors['alt_foto']) ? 'is-invalid' : '' ?>" value="<?= old(esc('alt_foto')); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['alt_foto'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['alt_foto'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>   
            </div>

            <div class="col-lg-6 col-sm-12 text-left mt-2">
                <div class="card h-auto text-center">
                    <div class="card-header bg-gradient-primary">
                        <p class="h4 text-white">Info Produk</p>
                    </div>
                    <div class="card-body">
                        <p class="p-admin">Nama Produk</p>
                        <input type="text" name="nama_produk" class="form-control <?= isset($validationErrors['nama_produk']) ? 'is-invalid' : '' ?>" value="<?= old(esc('nama_produk')); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['nama_produk'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['nama_produk'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Url Produk</p>
                        <input type="text" name="url" class="form-control <?= isset($validationErrors['url']) ? 'is-invalid' : '' ?>" value="<?= old('url'); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['url'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['url'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Kategori</p>
                        <select name="id_kategori" class="form-control <?= isset($validationErrors['id_kategori']) ? 'is-invalid' : '' ?>">
                            <?php foreach($dataKategori as $kategori) : ?>
                                <option value="<?= $kategori['kategori_id'] ?>"><?= $kategori['nama_kategori'] ?></option>
                           <?php endforeach; ?>
                        </select>
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['id_kategori'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['id_kategori'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Harga</p>
                        <input type="number" name="harga" class="form-control <?= isset($validationErrors['harga']) ? 'is-invalid' : '' ?>" value="<?= old(esc('harga')); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['harga'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['harga'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Satuan</p>
                        <input type="text" name="satuan" class="form-control <?= isset($validationErrors['satuan']) ? 'is-invalid' : '' ?>" value="<?= old(esc('satuan')); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['satuan'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['satuan'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Durasi</p>
                        <input type="text" name="durasi" class="form-control <?= isset($validationErrors['durasi']) ? 'is-invalid' : '' ?>" value="<?= old(esc('durasi')); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['durasi'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['durasi'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Min. Kapasitas</p>
                        <input type="number" name="min_kapasitas" class="form-control <?= isset($validationErrors['min-kapasitas']) ? 'is-invalid' : '' ?>" value="<?= old(esc('min_kapasitas')); ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['min_kapasitas'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['min_kapasitas'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="offset-lg-1 col-lg-10 col-sm-12 mt-3">

                <div class="card h-auto">
                    <div class="card-header bg-gradient-primary">
                        <p class="h4 text-white text-center">Deskripsi Produk</p>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Deskripsi</label>
                            <div class="col-xl-8 col-md-6">
                                <textarea name="deskripsi" id="summernote"><?= old(esc('deskripsi')); ?></textarea>
                                <div class="button_set mt-1">
                                </div>
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['deskripsi'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['deskripsi'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="offset-lg-1 col-lg-10 col-sm-12 mt-3 text-center mb-4">

                <div class="card h-auto">
                    <div class="card-header bg-gradient-primary text-center">
                        <p class="h4 text-white">Keperluan SEO</p>
                    </div>

                    <div class="card-body">
                    
                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Judul SEO</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="judul_seo_produk" class="form-control <?= isset($validationErrors['judul_seo_produk']) ? 'is-invalid' : '' ?>" value="<?= old(esc('judul_seo_produk')); ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['judul_seo_produk'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['judul_seo_produk'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Deskripsi SEO</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="deskripsi_seo_produk" class="form-control <?= isset($validationErrors['deskripsi_seo_produk']) ? 'is-invalid' : '' ?>" value="<?= old(esc('deskripsi_seo_produk')); ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['deskripsi_seo_produk'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['deskripsi_seo_produk'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

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
    <script type="text/javascript" src="<?= base_url('admin-assets/vendor/summernote/summernote.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                minHeight: null,
                maxHeight: null,             
                focus: true
            });
        });
    </script>
<?= $this->endSection() ?>