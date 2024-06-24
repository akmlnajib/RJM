<h1 class="mt-4"><i class="fa-solid fa-people-roof me-1"></i> Karyawan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Karyawan</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        Data Karyawan
    </div>
    <div class="card-body">
        <a href="./?halaman=karyawan_aksi&aksi=tambah" class="btn btn-dark mb-3 float-end"><i
                class="fa-solid fa-person-circle-plus me-1"></i>Tambah Data</a>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Department</th>
                    <th>Kedisplinan</th>
                    <th>Prestasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM tb_karyawan";
                $execute = mysqli_query($conn, $query);
                while ($result = mysqli_fetch_array($execute)) { ?>
                    <tr id="data">
                        <td><?= $no ?></td>
                        <td><?= htmlspecialchars($result['nik']) ?></td>
                        <td><?= htmlspecialchars($result['nama_karyawan']) ?></td>
                        <td><?= htmlspecialchars($result['department']) ?></td>
                        <td><?= htmlspecialchars($result['kedisiplinan']) ?> Hari</td>
                        <td><?= htmlspecialchars($result['prestasi']) ?> Sertifikat</td>
                        <td>
                            <div class='norebuttom'>
                                <a class="btn btn-success"
                                    href="./?halaman=karyawan_aksi&aksi=ubah&id_karyawan=<?= urlencode($result['id_karyawan']) ?>"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="karyawan-proses.php?proses=hapus&id_karyawan=<?= urlencode($result['id_karyawan']) ?>"
                                    class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>