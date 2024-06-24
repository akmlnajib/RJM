<?php
include "../src/config.php";
$h = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_kriteria"));
?>
<h1 class="mt-4"><i class="fa-solid fa-marker me-1"></i>Penilaian</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Penilaian</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        Data Penilaian
    </div>
    <div class="card-body">
        <a href="./?halaman=nilai_aksi&aksi=tambah" class="btn btn-dark mb-3 float-end"><i
                class="fa-solid fa-person-circle-plus me-1"></i>Tambah Data</a>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center" rowspan="2">No</th>
                    <th class="text-center" rowspan="2">Nama Karyawan</th>
                    <th class="text-center" colspan="<?= $h ?>">Kriteria</th>
                </tr>
                <tr class="text-center">
                    <?php
                    for ($n = 1; $n <= $h; $n++) {
                        echo "<th class='text-center'>C{$n}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tb_karyawan ORDER BY id_karyawan";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id_karyawan'];
                        $nama = $row['nama_karyawan'];
                        $dnilai = mysqli_query($conn, "SELECT * FROM tb_nilai WHERE id_karyawan='$id'");
                        $dn = mysqli_fetch_array($dnilai);
                        echo "<tr>";

                        if (empty($dn['id_karyawan'])) {

                        } else {
                            ?>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="text-center">
                                <?= $row['nama_karyawan'] ?>
                            </td>
                            <?php
                            $sql = mysqli_query($conn, "SELECT nama_subkriteria, nilai_subkriteria FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_karyawan='$id' ORDER BY b.id_kriteria");
                            while ($rsql = mysqli_fetch_array($sql)) { ?>

                                <td class="text-center">
                                    Bobot <?= $rsql['nilai_subkriteria'] ?> = <?= $rsql['nama_subkriteria'] ?>
                                </td>

                                <?php
                            }
                            ?>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>