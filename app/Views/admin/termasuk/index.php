<?php
    $session  = \Config\Services::session();
?>

<?= $this->extend('admin_template') ?>

<?= $this->section('specific-css') ?>
    <!-- Taruh spesifik css untuk tiap halaman disini -->
    <link href="<?= base_url('admin-assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <style>
        .img-admin{
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Produk Inclusion</h1>
        </div>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= route_to('admin'); ?>">Dashboard</a>
            <li class="breadcrumb-item active">Produk Inclusion</li>
        </ol>

        <!-- Content Row -->
        <div class="row m-1">

            <div class="col-12">

            <?php if($session->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $session->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if($session->getFlashdata('sukses')) : ?>
                <div class="card mb-4 py-2 border-left-success">
                    <div class="card-body">
                        <?= $session->getFlashdata('sukses') ?>
                    </div>
                </div>
            <?php endif; ?>

            </div>

        </div>

        <!-- Product List -->

        <div class="card mb-4">
            <div class="card-header">
                <?= anchor('admin/ketentuan/create','Add Data',array('class'=>'btn btn-info')); ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Produk Inclusion</th>
                                <th>Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Produk Inclusion</th>
                                <th>Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                $no=1;
                                foreach($dataInclusion as $termasuk) :
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $termasuk->deskripsi ?></td>
                                    <td><?= $termasuk->nama_produk ?></td>
                                    <td class="d-flex justify-content-evenly">
                                        <a href="<?= base_url('admin/termasuk/edit/'.$termasuk->id_termasuk) ?>" class="btn btn-info">Edit</a>&nbsp;&nbsp;
                                        <form action="/admin/termasuk/<?= $termasuk->id_termasuk ?>" method="POST">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus Kategori ini?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?= $this->endSection() ?>

<?= $this->section('specific-js') ?>
    <!-- Taruh spesifik js untuk tiap halaman disini -->
    <script src="<?= base_url('admin-assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('admin-assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('admin-assets/js/demo/datatables-demo.js') ?>"></script>
<?= $this->endSection() ?>