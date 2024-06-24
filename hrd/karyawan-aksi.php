<?php
$departments = ['Produksi', 'Marketing', 'Administrasi', 'Gudang', 'Accounting', 'Driver'];

if (isset($_GET['aksi'])) {
    include "../src/config.php";
    $aksi = $_GET['aksi'];

    if ($aksi == 'tambah') {
        ?>
        <h1 class="mt-4">Karyawan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="./?halaman=dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Karyawan</li>
            <li class="breadcrumb-item active">Tambah Karyawan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <form action="karyawan-proses.php?proses=simpan" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select name="department" id="department" class="form-control" required>
                                <option value="BLANK" selected="selected">-Pilih Department-</option>
                                <?php
                                foreach ($departments as $row) { ?>
                                    <option value='<?php echo $row ?>'><?php echo $row ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kedisiplinan" class="form-label">Jumlah Hari Tidak Masuk Kerja</label>
                            <input type="number" class="form-control" id="kedisiplinan" name="kedisiplinan" required>
                        </div>
                        <div class="mb-3">
                            <label for="prestasi" class="form-label">Prestasi</label>
                            <input type="number" class="form-control" id="prestasi" name="prestasi" required>
                        </div>
                        <div class="text-right">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-secondary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } elseif ($aksi == 'ubah') {
        include "../src/config.php";

        $id = htmlspecialchars($_GET['id_karyawan'] ?? '');
        $stmt = $conn->prepare("SELECT * FROM tb_karyawan WHERE id_karyawan = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
        } else {
            header('Location: ./?halaman=karyawan');
            exit;
        }
        $stmt->close();
        ?>
        <h1 class="mt-4">Karyawan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="./?halaman=dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Karyawan</li>
            <li class="breadcrumb-item active">Ubah Karyawan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-person-circle-plus me-1"></i>
                Ubah Karyawan
            </div>
            <div class="card-body">
                <form action="karyawan-proses.php?id_karyawan=<?= urlencode($id) ?>&proses=ubah" method="post"
                    enctype="multipart/form-data">
                    <input type="text" class="form-control" id="id_karyawan" name="id_karyawan"
                        value="<?= htmlspecialchars($data['id_karyawan']) ?>" hidden>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik"
                            value="<?= htmlspecialchars($data['nik']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                            value="<?= htmlspecialchars($data['nama_karyawan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select name="department" id="department" class="form-control" required>
                            <option value="<?= htmlspecialchars($data['department']) ?>" selected="selected">
                                <?= htmlspecialchars($data['department']) ?>
                            </option>
                            <?php
                            foreach ($departments as $row) { ?>
                                <option value='<?php echo $row ?>'><?php echo $row ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kedisiplinan" class="form-label">Jumlah Hari tidak Masuk Kerja</label>
                        <input type="number" class="form-control" id="kedisiplinan" name="kedisiplinan"
                            value="<?= htmlspecialchars($data['kedisiplinan']) ?>" required>
                    </div><div class="mb-3">
                        <label for="prestasi" class="form-label">Jumlah Sertifikat</label>
                        <input type="number" class="form-control" id="prestasi" name="prestasi"
                            value="<?= htmlspecialchars($data['prestasi']) ?>" required>
                    </div>
                    <div class="text-right">
                        <input type="submit" name="ubah" value="Simpan" class="btn btn-secondary">
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo "ID karyawan tidak ditemukan.";
    }
}
?>