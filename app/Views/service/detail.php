<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Service BarberOS</h1>
        <ol class="breadcrumb mb-4">
            <l1 class="breadcrumb-item active">Pengelolaan Service BarberOS</l1>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://awsimages.detik.net.id/community/media/visual/2017/12/06/6414c1ae-fcd1-49a6-8316-4a71c29f93ff_43.jpg?w=600&q=90"
                        alt="" width="50%">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title"><?= $result['title'] ?></h5>
                            <p class="card-text">Pembuat:<br><?= $result['release_year'] ?></p>
                            <p class="card-text">Tahun Layanan Dibuat:<?= $result['release_year'] ?></p>
                            <p class="card-text">Stok:<?= $result['stock'] ?></p>
                            <p class="card-text">Harga:<?= $result['price'] ?></p>
                            <p class="card-text">Diskon:<?= $result['discount'] ?></p>
                            <div class="d-grid gap-2 d-md-block">
                                <a class="btn btn-dark" type="button" href="<?= base_url('service') ?>">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>