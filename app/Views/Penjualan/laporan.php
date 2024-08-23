<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"> PENJUALAN </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"> Laporan Penjualan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>

            <div class="card-body">
                <!-- Filter  -->
                <form action="/jual/laporan/filter" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <!--<label class="col-form-label">Tanggal Awal</label>-->
                                <input type="date" class="form-control" name="tanggal_awal" value="<?= $tanggal['tanggal_awal'] ?>" title="Tanggal Awal">
                            </div>
                            <div class="col-4">
                                <!--<label class="col-form-label">Tanggal Akhir</label>-->
                                <input type="date" class="form-control" name="tanggal_akhir" value="<?= $tanggal['tanggal_akhir'] ?>" title=" Tanggal Akhir">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-secondary">Filter</button>
                            </div>
                        </div>
                </form>
                <br>

                <!-- Filter  -->
                <!--
                <form action="/jual/laporan/filter" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <label class="col-form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tanggal_awal" value="<?= date('Y-m-01') ?>" title="Tanggal Awal">
                            </div>
                            <div class="col-4">
                                <label class="col-form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tanggal_akhir" value="<?= $tanggal['tanggal_akhir'] ?>" title=" Tanggal Akhir">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-secondary">Filter</button>
                            </div>
                        </div>
                </form>
                <br> -->


                <!-- Isi Laporan -->
                <a target="_blank" class="btn btn-primary mb-3" type="button" href="/jual/exportpdf">
                    Export PDF
                </a>
                <a class="btn btn-dark mb-3" type="button" href="/jual/exportexcel">
                    Export Excel
                </a>

                <table id="datatablesSimple" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sale ID</th>
                            <th>Tgl Transaksi</th>
                            <th>User</th>
                            <th>Customer</th>
                            <th>Total Transaksi</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($result as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['sale_id'] ?></td>
                                <td><?= $value['tanggal_transaksi'] ?></td>
                                <td><?= $value['firstname'] ?> <?= $value['lastname'] ?></td>
                                <td><?= $value['nama_customer'] ?></td>
                                <td><?= number_to_currency($value['total'], 'IDR', 'id_ID', 2) ?></td>



                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>