<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">TRANSAKSI </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Transaksi Penjualan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <label class="col-form-label">Tanggal</label>
                            <input type="date" value=<?= date('Y-m-d') ?> disabled>
                        </div>
                        <div class="col">
                            <label class="col-form-label">User</label>
                            <input type="text" value="<?= session()->user_name ?>" disabled>
                        </div>
                        <div class="col">
                            <label class="col-form-label">Customer</label>
                            <input type="text" id="nama-cust" disabled>
                            <input type="hidden" id="id-cust">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" data-bs-target="#modalProduk" data-bs-toggle="modal">Pilih Produk</button>
                            <button class="btn btn-dark" data-bs-target="#modalCust" data-bs-toggle="modal">Cari Customer</button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detail_cart">
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <label class="col-form-label">Total Bayar</label>
                            <h1><span id="spanTotal">0</span></h1>
                        </div>
                        <div class="col-4">
                            <div class="mb-3 row">
                                <label class="col-4 col-form-label">Nominal</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="nominal" autocomplete="off">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-4 col-form-label">Kembalian</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="kembalian" disabled>
                                </div>
                            </div>
                            <div class="d-grid gap-3 d-md-flex justify-content-md-end">

                                <button class="btn btn-success" onclick="bayar()">Proses Bayar</button>
                                <button onclick="location.reload()" class="btn btn-primary" type="button">Transaksi Baru</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</main>
<?= $this->include('penjualan/modal-produk') ?>
<?= $this->include('penjualan/modal-customer') ?>
<script>
    function load() {
        $('#detail_cart').load("<?= base_url('jual/load') ?>");
        $('#spanTotal').load("<?= base_url('jual/gettotal') ?>");
    }
    $(document).ready(function() {
        load();
    });

    //Ubah Jumlah Item
    $(document).on('click', '.ubah_cart', function() {
        var row_id = $(this).attr('id');
        var qty = $(this).attr('qty');
        $('#rowid').val(row_id)
        $('#qty').val(qty)
        $('#modalUbah').modal('show');
    });

    //Hapus Item Cart
    $(document).on('click', '.hapus_cart', function() {
        var row_id = $(this).attr("id");
        $.ajax({
            url: "<?= base_url('jual') ?>/" + row_id,
            method: "DELETE",
            success: function(data) {
                load();
            }
        });
    });

    //Pembayaran
    function bayar() {
        var nominal = $('#nominal').val()
        var idcust = $('#id-cust').val()
        //var total_bayar = $('#spanTotal').val()
        // var total_bayar = document.getElementById('spanTotal').innerText
        // console.log(nominal)
        // console.log(idcust)
        // console.log(total_bayar)
        $.ajax({
            url: "jual/bayar",
            method: "POST",
            data: {
                'nominal': nominal,
                'id-cust': idcust
            },
            success: function(response) {
                var result = JSON.parse(response);
                alert(result.msg)
                swal({
                    title: result.msg,
                    icon: result.status ? "success" : "error",
                });
                load();
                $('#nominal').val("");
                $('#kembalian').val(result.data.kembalian);
            }
        });
    }
</script>
<?= $this->endSection() ?>