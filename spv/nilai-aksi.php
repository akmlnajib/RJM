<?php
if (isset($_GET['aksi'])) {
    include "../src/config.php";
    $aksi = $_GET['aksi'];

    if ($aksi == 'tambah') {
        ?>
        <h1 class="mt-4"><i class="fa-solid fa-marker me-1"></i>Penilaian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="./?halaman=dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Penilaian</li>
            <li class="breadcrumb-item active">Tambah Penilaian</li>
        </ol>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <form action="nilai-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="search_term" class="form-label">NIK</label>
                                    <input type="number" name="nik" id="search_term" class="form-control" placeholder="NIK"
                                        autocomplete="off">
                                    <div id="autocomplete-options"></div>
                                </div>
                                <div class="mb-3" hidden>
                                    <label for="id_karyawan" class="form-label">Id Karyawan</label>
                                    <input type="text" name="id_karyawan" id="id_karyawan" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="namanama" class="form-label">Nama karyawan</label>
                                    <input type="text" name="nama_karyawan" id="namanama" class="form-control"
                                        placeholder="Nama karyawan" autocomplete="off" readonly>
                                </div>
                                <?php
                                $query1 = mysqli_query($conn, "SELECT * FROM tb_kriteria ORDER BY id_kriteria");
                                while ($result1 = mysqli_fetch_array($query1)) {
                                    $id_kriteria = $result1['id_kriteria'];
                                    $nama_kriteria = $result1['nama_kriteria'];
                                    ?>
                                    <div class="mb-3">
                                        <label for="<?= $id_kriteria ?>" class="form-label"><?= $nama_kriteria ?></label>
                                        <select name="<?= $id_kriteria ?>" class="form-control">
                                            <option selected disabled>-- Pilih Bobot <?= $result1['nama_kriteria'] ?> --</option>
                                            <?php
                                            $query2 = mysqli_query($conn, "SELECT * FROM tb_subkriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai_subkriteria ASC");
                                            while ($result2 = mysqli_fetch_array($query2)) { ?>
                                                <option value="<?= $result2['id_subkriteria'] ?>">
                                                    <?= $result2['nilai_subkriteria'] ?> = <?= $result2['nama_subkriteria'] ?> 
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <div class="col-2 text-right">
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-secondary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <?php
                include "data.php";
                ?>
            </div>
            <?php
    }  else {
        }
    }
?>