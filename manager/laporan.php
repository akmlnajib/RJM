<h1 class="mt-4"><i class="fa-solid fa-circle-exclamation"></i> Laporan Hasil Penilaian</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Laporan Hasil Penilaian</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        Data Laporan Hasil Penilaian
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Berkas</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../src/config.php";
                $query = "SELECT * FROM tb_laporan ORDER BY id_laporan";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (empty($row['berkas']) or ($row['berkas'] == '-'))
                            $berkas = "-";
                        else
                            $berkas = $row['berkas'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center">
                                <a href="../berkas/<?php echo $berkas; ?>" target='_blank' class="btn btn-secondary">
                                    <?php echo $row['berkas'] ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <?= $row['tanggal'] ?>
                            </td>
                            <td class="text-center">
                                <?php if ($row['status'] == 1) { ?>
                                    <button type="button" class="btn btn-success">Tervalidasi</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-secondary">Belum Divalidasi</button>
                                    <?php
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php if ($row['status'] == 1) { ?>
                                        <small>Tidak ada aksi</small>
                                <?php } else { ?>
                                    <button class="btn btn-success">
                                        <a href="laporan-proses.php?proses=validasi&id=<?php echo $row['id_laporan']; ?>"><i
                                                class="fa-solid fa-check" style="color: #000000;"></i></a></button>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>