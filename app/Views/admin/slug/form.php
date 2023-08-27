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
        <h1 class="h3 mb-0 text-gray-800">Edit Slug</h1>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
        <li class="breadcrumb-item"><a href="<?= route_to('admin/slug'); ?>">Slug</a></li>
        <li class="breadcrumb-item active"><?= isset($slug->id_slug) ? 'Edit' : 'Tambah' ?> Slug</li>
    </ol>

    <!-- Form Kategori -->
    <form action="<?= base_url(); ?>/admin/slug/<?= isset($slug->id_slug) ? $slug->id_slug : '' ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <?= csrf_field(); ?>

            <?php if(isset($slug->id_slug)) : ?>
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
                        <p class="h4 text-white text-center">Detail Route</p>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">

                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Slug (Url)</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" class="form-control <?= isset($validationErrors['slug']) ? 'is-invalid' : '' ?>" name="slug" value="<?= isset($slug->slug) ? $slug->slug : old(esc('slug')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['slug'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['slug'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Target</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="target" class="form-control <?= isset($validationErrors['target']) ? 'is-invalid' : '' ?>" value="<?= isset($slug->target) ? $slug->target : old(esc('target')) ?>">
                                <?php if($session->getFlashdata('validation')) : ?>
                                    <?php if(isset($validationErrors['target'])) : ?>
                                        <p class="text-danger">*<?= $validationErrors['target'] ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="offset-lg-1 col-xl-2 col-md-2 form-label">Filter</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="filters" class="form-control" value="<?= isset($slug->filters) ? $slug->filters : old(esc('filters')) ?>">
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