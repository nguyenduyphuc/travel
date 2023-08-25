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
        <h1 class="h3 mb-0 text-gray-800"><?= isset($dataProduk->nama_produk) ? 'Edit '.$dataProduk->nama_produk : 'Tambah Produk' ?></h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
        <li class="breadcrumb-item"><a href="<?= route_to('admin/produk'); ?>">List Produk</a></li>
        <li class="breadcrumb-item active"><?= isset($dataProduk->nama_produk) ? 'Edit '.$dataProduk->nama_produk : 'Tambah Produk' ?></li>
    </ol>

    <?php if($session->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $session->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Form Produk -->
    <?php if(isset($dataProduk->id_produk)) : ?>
        <form action="<?= base_url() ?>/admin/produk/<?= $dataProduk->id_produk ?>" method="post" enctype="multipart/form-data">
    <?php else : ?>
        <form action="<?= base_url() ?>/admin/produk" method="post" enctype="multipart/form-data">
    <?php endif; ?>

        <div class="row">

            <?= csrf_field(); ?>

            <?php if(isset($dataProduk->id_produk)) : ?>
                <input type="hidden" name="_method" value="PUT" />
            <?php endif; ?>

            <div class="offset-lg-1 col-lg-4 col-md-6 col-sm-12 text-right mt-2">
                <div class="card h-auto text-center">
                    <div class="card-header bg-gradient-primary">
                        <p class="h4 text-white">Foto Produk</p>
                    </div>
                    <div class="card-body">
                        <div id="imagePreview"></div>
                        <?php if(isset($dataProduk->foto_produk)) : ?>
                            <p class="p-admin">Foto Produk Saat Ini</p>
                        <?php endif; ?>
                        <?php if(isset($dataProduk->foto_produk)) : ?>
                            <img class="card-img mb-3 w-75" src="<?= base_url(); ?>/assets/images/products/<?= $dataProduk->foto_produk ?>">
                        <?php endif; ?>
                        <input type="file" name="foto_produk" id="foto_produk" class="form-control">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['foto_produk'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['foto_produk'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <input type="text" name="image_path" class="form-control" value="<?= isset($dataProduk->foto_produk) ? $dataProduk->foto_produk : old(esc('foto_produk')) ?>" hidden>
                        <p class="p-admin">Alt. Foto</p>
                        <input type="text" name="alt_foto" class="form-control <?= isset($validationErrors['alt_foto']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->alt_foto) ? $dataProduk->alt_foto : old(esc('alt_foto')) ?>">
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
                        <input type="text" name="nama_produk" class="form-control <?= isset($validationErrors['nama_produk']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->nama_produk) ? $dataProduk->nama_produk : old(esc('nama_produk')) ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['nama_produk'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['nama_produk'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Url Produk</p>
                        <input type="text" name="url_produk" class="form-control <?= isset($validationErrors['url_produk']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->url_produk) ? $dataProduk->url_produk : old('url_produk') ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['url_produk'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['url_produk'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Kategori</p>
                        <select name="kategori_id" class="form-control <?= isset($validationErrors['kategori_id']) ? 'is-invalid' : '' ?>">
                            <?php foreach($dataKategori as $kategori) : ?>
                                <?php if(isset($dataProduk->kategori_id) && $dataProduk->kategori_id === $kategori['id_kategori']) : ?>
                                    <option selected value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                <?php else : ?>
                                    <option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                <?php endif; ?>
                           <?php endforeach; ?>
                        </select>
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['kategori_id'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['kategori_id'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Harga</p>
                        <input type="number" name="harga" class="form-control <?= isset($validationErrors['harga']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->harga) ? $dataProduk->harga : old(esc('harga')) ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['harga'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['harga'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Durasi</p>
                        <input type="text" name="durasi" class="form-control <?= isset($validationErrors['durasi']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->durasi) ? $dataProduk->durasi : old(esc('durasi')) ?>">
                        <?php if($session->getFlashdata('validation')) : ?>
                            <?php if(isset($validationErrors['durasi'])) : ?>
                                <p class="text-danger">*<?= $validationErrors['durasi'] ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p class="p-admin">Min. Kapasitas</p>
                        <input type="number" name="min_kapasitas" class="form-control <?= isset($validationErrors['min-kapasitas']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->min_kapasitas) ? $dataProduk->min_kapasitas : old(esc('min_kapasitas')) ?>">
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
                                <textarea name="deskripsi_produk" id="summernote"><?= isset($dataProduk->deskripsi_produk) ? $dataProduk->deskripsi_produk : old(esc('deskripsi_produk')) ?></textarea>
                                <div class="button_set mt-1">
                                </div>
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['deskripsi_produk'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['deskripsi_produk'] ?></p>
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
                                <input type="text" name="judul_seo_produk" class="form-control <?= isset($validationErrors['judul_seo_produk']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->judul_seo_produk) ? $dataProduk->judul_seo_produk : old(esc('juudl_seo_produk')) ?>">
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
                                <input type="text" name="deskripsi_seo_produk" class="form-control <?= isset($validationErrors['deskripsi_seo_produk']) ? 'is-invalid' : '' ?>" value="<?= isset($dataProduk->deskripsi_seo_produk) ? $dataProduk->deskripsi_seo_produk : old(esc('deskripsi_seo_produk')) ?>">
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

            $('#foto_produk').on('change', function(event) {
                var selectedFile = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#imagePreview').html('<p class="p-admin">Image Preview</p><img class="card-img mb-3 w-50" src="' + event.target.result + '" alt="Selected Image">');
                }

                reader.readAsDataURL(selectedFile);
            });
        });
    </script>
<?= $this->endSection() ?>