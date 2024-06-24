<?php

if (isset($_GET['aksi'])) {
    include "../src/config.php";
    $aksi = $_GET['aksi'];
    if ($aksi == 'tambah') {
        ?>
        <h1 class="mt-4"><i class="fa-solid fa-circle-exclamation"></i> Laporan Penilaian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Laporan</li>
            <li class="breadcrumb-item active">Tambah Laporan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <form action="laporan-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="berkas" class="form-label">Berkas</label>
                            <input type="file" class="form-control" id="berkas" name="berkas" required>
                        </div>
                        <div class="text-right">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-secondary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo "Tidak ditemukan.";
    }
}
?>