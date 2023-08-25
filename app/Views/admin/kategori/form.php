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
        <h1 class="h3 mb-0 text-gray-800"><?= isset($dataKategori->nama_kategori) ? 'Edit '.$dataKategori->nama_kategori : 'Tambah Kategori' ?></h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
        <li class="breadcrumb-item"><a href="<?= base_url('admin/kategori'); ?>">List Kategori</a></li>
        <li class="breadcrumb-item active"><?= isset($dataKategori->nama_kategori) ? 'Edit '.$dataKategori->nama_kategori : 'Tambah Kategori' ?></li>
    </ol>

    <!-- Form Kategori -->
    <?php if (isset($dataKategori->id_kategori)) : ?>
        <form action="<?= base_url(); ?>/admin/kategori/<?= $dataKategori->id_kategori ?>" method="post" enctype="multipart/form-data">
    <?php else : ?>
        <form action="<?= base_url(); ?>/admin/kategori" method="post" enctype="multipart/form-data">
    <?php endif; ?>

        <div class="row">

            <?= csrf_field(); ?>

            <div class="offset-lg-1 col-lg-10 mt-3">

                <?php if($session->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $session->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="card h-auto">
                    <div class="card-header bg-gradient-primary">
                        <p class="h4 text-white text-center">Detail Kategori</p>
                    </div>

                    <div class="card-body">

                        <?php if(isset($dataKategori->foto_kategori)) : ?>
                            <div class="d-flex justify-content-center">
                                <img class="card-img mb-3 w-25" src="<?= base_url(); ?>/assets/images/<?= $dataKategori->foto_kategori; ?>">
                            </div>
                            <div class="text-center mb-4">
                                <h5 style="color:black; margin-top:-5px;">Foto Saat Ini</h5>
                            </div>
                        <?php endif; ?>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Foto Kategori</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="file" name="foto_kategori" id="foto_kategori">
                                <input type="text" name="image_path" class="form-control" value="<?= isset($dataKategori->foto_kategori) ? $dataKategori->foto_kategori : old(esc('foto_kategori')) ?>" hidden>
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['foto_kategori'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['foto_kategori'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div id="imagePreview"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Alt Foto</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="alt_foto" class="form-control <?= isset($validationErrors['alt_foto']) ? 'is-invalid' : '' ?>" value="<?= isset($dataKategori->alt_foto) ? $dataKategori->alt_foto : old(esc('alt_foto')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['alt_foto'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['alt_foto'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Nama Kategori</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="nama_kategori" class="form-control <?= isset($validationErrors['nama_kategori']) ? 'is-invalid' : '' ?>" value="<?= isset($dataKategori->nama_kategori) ? $dataKategori->nama_kategori : old(esc('nama_kategori')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['nama_kategori'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['nama_kategori'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Parent</label>
                            <div class="col-xl-6 col-md-6">
                                <select name="parent" class="form-control <?= isset($validationErrors['parent']) ? 'is-invalid' : '' ?>">
                                    <option value="0">No Parent</option>
                                    <?php foreach($dataParent as $parent) : ?>
                                            <option value="<?= $parent['id_kategori'] ?>"><?= $parent['nama_kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['parent'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['parent'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">URL Kategori</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="url_kategori" class="form-control <?= isset($validationErrors['url_kategori']) ? 'is-invalid' : '' ?>" value="<?= isset($dataKategori->url_kategori) ? $dataKategori->url_kategori : old(esc('url_kategori')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['url_kategori'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['url_kategori'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="offset-lg-1 col-lg-10 mt-3 text-center mb-4">

                <div class="card h-auto">
                    <div class="card-header bg-gradient-primary text-center">
                        <p class="h4 text-white">Keperluan SEO</p>
                    </div>

                    <div class="card-body">
                    
                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Judul SEO</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="judul_seo_kategori" class="form-control <?= isset($validationErrors['judul_seo_kategori']) ? 'is-invalid' : '' ?>" value="<?= isset($dataKategori->judul_seo_kategori) ? $dataKategori->judul_seo_kategori : old(esc('judul_seo_kategori')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['judul_seo_kategori'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['judul_seo_kategori'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Deskripsi SEO</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="deskripsi_seo_kategori" class="form-control <?= isset($validationErrors['deskripsi_seo_kategori']) ? 'is-invalid' : '' ?>" value="<?= isset($dataKategori->deskripsi_seo_kategori) ? $dataKategori->deskripsi_seo_kategori : old(esc('deskripsi_seo_kategori')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['deskripsi_seo_kategori'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['deskripsi_seo_kategori'] ?></p>
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
    <script>
        $(document).ready(function() {
            $('#foto_kategori').on('change', function(event) {
                var selectedFile = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#imagePreview').html('<h5 style="color:black; margin-top:20px;">Image Preview</h5><img class="card-img mb-3 w-50" src="' + event.target.result + '" alt="Selected Image">');
                }

                reader.readAsDataURL(selectedFile);
            });
        });
    </script>
<?= $this->endSection() ?>