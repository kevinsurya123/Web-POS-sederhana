<div class="modal fade" id="modalCust" aria-hidden="true" aria-labelledby="e" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">DATA PRODUK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Buku-->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Nama</th>
                            <th width="30%">No Customer</th>
                            <th width="15%">Email</th>
                            <th width="15%">Telp</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detail_cart">
                    </tbody>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataCust as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['no_customer'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['phone'] ?></td>
                                <td>
                                    <button onclick="selectCustomer(
                                    '<?= $value['customer_id'] ?>','<?= $value['name'] ?>')" class="btn btn-success">
                                        <i class="fa fa-plus"></i>
                                        Tambahkan
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    function selectCustomer(id, name) {
        $('#id-cust').val(id);
        $('#nama-cust').val(name);
        $('#Customer').val('hide');
    }
</script>