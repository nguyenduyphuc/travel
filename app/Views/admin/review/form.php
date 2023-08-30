<?php
    $session  = \Config\Services::session();
    $validationErrors = $session->getFlashdata('validation'); 
?>

<?= $this->extend('admin_template') ?>

<?= $this->section('specific-css') ?>
    <!-- Taruh spesifik css untuk tiap halaman disini -->
    <style>
        .star {
            font-size: 25px;
            margin-right: 10px;
        }

        .star-checked {
            color: #FFA500;
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
        <li class="breadcrumb-item active"><?= isset($review->review) ? 'Edit' : 'Tambah' ?> Slug</li>
    </ol>

    <!-- Form Kategori -->
    <form action="<?= base_url(); ?>/admin/slug/<?= isset($review->id_review) ? $review->id_review : '' ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <?= csrf_field(); ?>

            <?php if(isset($review->id_review)) : ?>
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
                        <p class="h4 text-white text-center">Review Form</p>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-12 d-flex justify-content-center">
                                <?php
                                    if(isset($review->foto_customer))
                                    { ?>
                                        <img class="card-img mb-3" width="100" height="100" src="<?= base_url(); ?>/assets/images/<?= $review->foto_customer; ?>">
                                        <?php
                                    }
                                ?>
                            </div>

                            <label class="col-xl-2 col-md-2 form-label">Foto Customer</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="file" name="foto_customer">
                                <input type="hidden" name="image_path" class="form-control" value="<?= isset($review->foto_customer) ? $review->foto_customer : old(esc('foto_customer')) ?>">
                            </div>

                            <div id="imagePreview"></div>

                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-md-2 form-label">Nama Customer</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="customer" class="form-control" value="<?= isset($review->customer) ? $review->customer : old(esc('customer')) ?>">   
                                <?php if(isset($validation)) : ?>
                                    <p class="text-danger">*<?= $validation->getError('customer'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-md-2 form-label">Email Customer</label>
                            <div class="col-xl-8 col-md-6">
                                <input type="text" name="email" class="form-control" value="<?= isset($review->email) ? $review->email : old(esc('email')) ?>">   
                                <?php if(isset($validation)) : ?>
                                    <p class="text-danger">*<?= $validation->getError('email'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-md-2 form-label">Rating</label>
                            <div class="col-xl-8 col-md-6">
                                <span class="star fas fa-star <?= isset($review->rating)&&($review->rating == 1)||($review->rating == 5)?'star-checked':''; ?>" id="star_1" onclick="rate(1)"></span>
                                <span class="star fas fa-star <?= isset($review->rating)&&($review->rating == 2)||($review->rating == 5)?'star-checked':'' ?>" id="star_2" onclick="rate(2)"></span>
                                <span class="star fas fa-star <?= isset($review->rating)&&($review->rating == 3)||($review->rating == 5)?'star-checked':'' ?>" id="star_3" onclick="rate(3)"></span>
                                <span class="star fas fa-star <?= isset($review->rating)&&($review->rating == 4)||($review->rating == 5)?'star-checked':'' ?>" id="star_4" onclick="rate(4)"></span>
                                <span class="star fas fa-star <?= isset($review->rating)&&($review->rating == 5)?'star-checked':'' ?>" id="star_5" onclick="rate(5)"></span>
                                <input type="hidden" id="star" name="rating" class="form-control" value="<?= isset($review->rating) ? $review->rating : old(esc('rating')) ?>" required>
                                <?php if(isset($validation)) : ?>
                                    <p class="text-danger">*<?= $validation->getError('rating'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-2 col-md-2 form-label">Review</label>
                            <div class="col-xl-8 col-md-6">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"><?= isset($review->review) ? $review->review : old('review'); ?></textarea>
                                <?php if(isset($validation)) : ?>
                                    <p class="text-danger">*<?= $validation->getError('review'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-xl-2 col-form-label">Status</label>
                            <div class="col-xl-6 text-center">
                                <select name="status" class="form-control">
                                <option value="1" <?= isset($review->status)&&($review->status == 1)?'selected':'' ?>>Tampilkan</option>
                                <option value="0" <?= isset($review->status)&&($review->status == 0)?'selected':'' ?>>Jangan tampilkan</option>
                                </select>
                            </div>
                        </div>

                        <div id="fotoReview"></div>

                        <div class="offset-lg-2 offset-sm-0">
                            <div class="col-4 mt-4">
                                <label id="tambahFoto" class="btn btn-info text-white">Tambah Foto</label>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-xl-2 col-form-label"></label>
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
    <script type="text/javascript">
        function rate(id)
        {
            var star = 0;

            switch(id)
            {
                case 1 :
                    checked("star_1");
                    unchecked("star_2");
                    unchecked("star_3");
                    unchecked("star_4");
                    unchecked("star_5");
                    star = 1;
                    break;
                case 2  :
                    checked("star_1");
                    checked("star_2");
                    unchecked("star_3");
                    unchecked("star_4");
                    unchecked("star_5");
                    star = 2;
                    break;
                case 3  :
                    checked("star_1");
                    checked("star_2");
                    checked("star_3");
                    unchecked("star_4");
                    unchecked("star_5");
                    star = 3;
                    break;
                case 4  :
                    checked("star_1");
                    checked("star_2");
                    checked("star_3");
                    checked("star_4");
                    unchecked("star_5");
                    star = 4;
                    break;
                case 5  :
                    checked("star_1");
                    checked("star_2");
                    checked("star_3");
                    checked("star_4");
                    checked("star_5");
                    star = 5;
                    break;
                default :
                    unchecked("star_1");
                    unchecked("star_2");
                    unchecked("star_3");
                    unchecked("star_4");
                    unchecked("star_5");
                    star = 0;
            }

            $('#star').val(star);
        }

        function rateUpdate(id)
        {
            var star = 0;

            switch(id)
            {
                case 1 :
                    checked("star_1_update");
                    unchecked("star_2_update");
                    unchecked("star_3_update");
                    unchecked("star_4_update");
                    unchecked("star_5_update");
                    star = 1;
                    break;
                case 2  :
                    checked("star_1_update");
                    checked("star_2_update");
                    unchecked("star_3_update");
                    unchecked("star_4_update");
                    unchecked("star_5_update");
                    star = 2;
                    break;
                case 3  :
                    checked("star_1_update");
                    checked("star_2_update");
                    checked("star_3_update");
                    unchecked("star_4_update");
                    unchecked("star_5_update");
                    star = 3;
                    break;
                case 4  :
                    checked("star_1_update");
                    checked("star_2_update");
                    checked("star_3_update");
                    checked("star_4_update");
                    unchecked("star_5_update");
                    star = 4;
                    break;
                case 5  :
                    checked("star_1_update");
                    checked("star_2_update");
                    checked("star_3_update");
                    checked("star_4_update");
                    checked("star_5_update");
                    star = 5;
                    break;
                default :
                    unchecked("star_1_update");
                    unchecked("star_2_update");
                    unchecked("star_3_update");
                    unchecked("star_4_update");
                    unchecked("star_5_update");
                    star = 0;
            }

            $('#star_update').val(star);
        }

        function checked(star_id)
        {
            var element = document.getElementById(star_id);
            element.classList.add("star-checked");
        }

        function unchecked(star_id)
        {
            var element = document.getElementById(star_id);
            element.classList.remove("star-checked");
        }

        $(document).ready(function() {
            $('#foto_kategori').on('change', function(event) {
                var selectedFile = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function(event) {
                    $('#imagePreview').html('<h5 style="color:black; margin-top:20px;">Image Preview</h5><img class="card-img mb-3 w-50" src="' + event.target.result + '" alt="Selected Image">');
                }

                reader.readAsDataURL(selectedFile);
            });

            $("#tambahFoto").click(function(){
                counter++;
                // console.log(counter);
                if(counter>2)
                {
                    $('#tambahFoto').hide();
                }
                    $('#fotoReview').append('<div class="row form-group"><label class="col-xl-2 col-form-label">Foto Review</label><div class="col-xl-4 text-center"><input type="file" class="form-control-file" name="photo[]"></div></div><div class="row form-group"><label class="col-xl-2 col-form-label">Alt foto</label><div class="col-xl-4 text-center"><input type="text" class="form-control" name="alt[]"></div></div>');
            });
        });
    </script>
<?= $this->endSection() ?>