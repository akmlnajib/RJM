<?php
if (isset($_GET['aksi'])) {
    include "../src/config.php";
    $kategori = ['Cost', 'Benefit'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'ubah') {
        if (isset($_GET['id_kriteria'])) {
            $id_kriteria = $_GET['id_kriteria'];
            $data = mysqli_query($conn, "SELECT * FROM tb_kriteria WHERE id_kriteria='$id_kriteria'");
            $row = mysqli_fetch_assoc($data);
            ?>
            <h1 class="mt-4">Kriteria</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="./?halaman=dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Kriteria</li>
                <li class="breadcrumb-item active">Ubah Kriteria</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="kriteria-proses.php?proses=ubah" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria'] ?>">
                        <div class="mb-3">
                            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                                value="<?= htmlspecialchars($row['nama_kriteria']) ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="bobot_kriteria" class="form-label">Bobot Kriteria</label>
                            <input type="text" class="form-control" id="bobot_kriteria" name="bobot_kriteria"
                                value="<?= htmlspecialchars($row['bobot_kriteria']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori"
                                value="<?= htmlspecialchars($row['kategori']) ?>" readonly>
                        </div>
                        <input type="hidden" name="id_kriteria" value="<?= htmlspecialchars($id_kriteria) ?>">
                        <div class="text-right">
                            <input type="submit" name="ubah" value="Simpan" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    }
}
?>
