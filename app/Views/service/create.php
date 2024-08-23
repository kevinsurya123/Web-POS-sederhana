<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA LAYANAN </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> Pengelolaan Data Layanan</li>
        </ol>
        <!-- Start Flash Data -->
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Data -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <!-- Form Tambah Buku -->
                <form action="<?= base_url('service/create') ?>" method="POST" enctype="multipart/form-data">

                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form--label">Judul Layanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('title') ? 'is-invalid'
                                                                        : '' ?>" id="title" name="title" value="<?= old('title') ?>" value="<?= old('title') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form--label">Pembuat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('author') ? 'is-invalid'
                                                                        : '' ?>" id="author" name="author" value="<?= old('author') ?>" value="<?= old('author') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('author') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="release_year" class="col-sm-2 col-form-label">Tahun
                            Dibuat</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('release_year') ? 'is-invalid'
                                                                        : '' ?>" id="release_year" name="release_year" value="<?= old('release_year') ?>" value="<?= old('release_year') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('release_year') ?>
                            </div>
                        </div>
                        <label for="stock" class="col-sm-2 col-form--label">Stok</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control <?= $validation->hasError('stock') ? 'is-invalid'
                                                                            : '' ?>" id="stock" name="stock" value="<?= old('stock') ?>" value="<?= old('stock') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stock') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('price') ? 'is-invalid'
                                                                        : '' ?>" id="price" name="price" value="<?= old('price') ?>" value="<?= old('price') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('price') ?>
                            </div>
                        </div>
                        <label for="discount" class="col-sm-2 col-form--label">Diskon</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="discount" name="discount">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control <?= $validation->hasError('sampul') ?
                                                                        'is-invalid' : '' ?>" id="sampul" name="sampul" onchange="previewImage()">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('sampul') ?>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <img src="/img/default.jpg" alt="" class="img-thumbnail img-preview">
                            </div>
                        </div>

                        <label for="service_category_id" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                            <select type="text" class="form-control" id="service_category_id" name="service_category_id">
                                <?php foreach ($category as $value) : ?>
                                    <option value="<?= $value['service_category_id'] ?>">
                                        <?= $value['name_category'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                        <a class="btn btn-dark" type="button" href="<?= base_url('service') ?>">Batal</a>
                        <!-- <button class="btn btn-danger" type="reset">Batal</button> -->
                    </div>
                </form>
                <!-- -->
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>