<body style="background-color: brown;">
    <div class="card">
        <h5 class="card-header">Pilih Rentang Tanggal</h5>
        <div class="card-body">
            <form action="<?= base_url('laporan') ?>" method="get">
                <div class="row mb-3">
                    <div class="col">
                        <label for="tanggal_mulai" class="form-label">Mulai Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                    </div>
                    <div class="col">
                        <label for="tanggal_selesai" class="form-label">Selesai Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <button onclick ="window.print()" class="btn btn-danger shadow float-right">Print <i class="fa fa-print"></i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <h5 class="card-header">Laporan Penjualan</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>No. Nota</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Beli</th>
                            <th>Harga Produk</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $current_pelanggan = ''; // Inisialisasi pelanggan saat ini
                        $total = 0; // Inisialisasi total harga
                        foreach ($penjualan as $data) {
                            ?>
                            <tr>
                                <!-- Tampilkan nama pelanggan hanya pada baris pertama untuk setiap pelanggan -->
                                <?php if ($data['nama_pelanggan'] != $current_pelanggan) { ?>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_pelanggan'] ?></td>
                                <?php } else { ?>
                                    <!-- Kosongkan sel untuk kolom nomor, nama pelanggan jika pelanggan sama -->
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                                <!-- Tampilkan tanggal, no.nota, kode produk, nama produk, jumlah, dan harga per produk -->
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['kode_penjualan'] ?></td>
                                <td><?= $data['kode_produk'] ?></td>
                                <td><?= $data['nama_produk'] ?></td>
                                <td><?= $data['jumlah'] ?></td>
                                <td>Rp. <?= number_format($data['harga']) ?></td>

                                <!-- Tampilkan total harga per pelanggan hanya pada baris pertama untuk setiap pelanggan -->
                                <?php if ($data['nama_pelanggan'] != $current_pelanggan) { ?>
                                    <td>Rp. <?= number_format($data['total_harga']) ?></td>
                                <?php } else { ?>
                                    <!-- Kosongkan sel untuk total harga jika pelanggan sama dengan baris sebelumnya -->
                                    <td></td>
                                <?php } ?>

                                <!-- Hitung total harga per baris -->
                                <?php $total_per_barang = $data['jumlah'] * $data['harga']; ?>
                            </tr>
                            <?php
                            // Tambahkan total harga per barang ke total keseluruhan
                            $total += $total_per_barang;

                            // Simpan nama pelanggan saat ini
                            $current_pelanggan = $data['nama_pelanggan'];
                            ?>
                        <?php } ?>
                        <!-- Tampilkan total harga keseluruhan di bagian bawah tabel -->
                        <tr>
                            <td colspan="8"><strong>Total Harga Keseluruhan</strong></td>
                            <td><strong>Rp. <?= number_format($total) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>