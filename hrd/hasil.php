<h1 class="mt-4"><i class="fa-solid fa-square-poll-vertical me-1"></i> Analisa dan Hasil</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Analisa dan Hasil</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        Analisa dan Hasil
    </div>
    <div class="card-body">
        
        <h4>Normalisasi Bobot Kriteria</h4>
        <hr>
        <table class="table table-striped responsive" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Kriteria</th>
                    <th class="text-center">Bobot</th>
                    <th class="text-center">Normalisasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../src/config.php";
                $h = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_kriteria"));
                $query = "SELECT *, (SELECT SUM(bobot_kriteria) FROM tb_kriteria) as sum_bobot FROM tb_kriteria ORDER BY id_kriteria";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['sum_bobot'] != 0) {
                            $n_normalisasi = number_format($row['bobot_kriteria'] / $row['sum_bobot'], 2);
                        } else {
                            $n_normalisasi = 0;
                        }
                        ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="text-center">
                                <?= $row['nama_kriteria'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['bobot_kriteria'] ?>
                            </td>
                            <td class="text-center">
                                <?= $n_normalisasi ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <h4>Konversi Nilai</h4>
        <hr>
        <table class="table table-striped responsive">
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
                include "../src/config.php";
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
                            $sql = mysqli_query($conn, "SELECT a.nilai_subkriteria as sub FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_karyawan='$id' ORDER BY b.id_kriteria");
                            while ($rsql = mysqli_fetch_array($sql)) { ?>
                                <td class="text-center">
                                    <?= $rsql['sub'] ?>
                                </td>

                                <?php
                            }
                            ?>
                            </tr>

                            <?php
                        }
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data karyawan</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <table class="table table-striped responsive">
            <thead>
                <tr>
                    <th class="text-center" rowspan="2">MAX - MIN</th>
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
                <tr>
                    <td>Nilai Max</td>
                    <?php
                    $dkriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria ORDER BY id_kriteria");
                    while ($dk = mysqli_fetch_array($dkriteria)) {
                        $idk = $dk['id_kriteria'];
                        $sql = mysqli_query($conn, "SELECT MAX(a.nilai_subkriteria) as max FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_kriteria='$idk' ORDER BY b.id_kriteria");
                        $dq1 = mysqli_fetch_array($sql);
                        $n_max = $dq1['max'];
                        echo "<th class='text-center'>" . $dq1['max'] . "</th>";
                    }
                    ?>
                </tr>
                <tr>
                    <td>Nilai Min</td>
                    <?php
                    $dkriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria ORDER BY id_kriteria");
                    while ($dk = mysqli_fetch_array($dkriteria)) {
                        $idk = $dk['id_kriteria'];
                        $sql = mysqli_query($conn, "SELECT MIN(a.nilai_subkriteria) as min FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_kriteria='$idk' ORDER BY b.id_kriteria");
                        $dq1 = mysqli_fetch_array($sql);
                        $n_max = $dq1['min'];
                        echo "<th class='text-center'>" . $dq1['min'] . "</th>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
        <h4>Nilai Utility</h4>
        <hr>
        <table class="table table-striped responsive">
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
                include "../src/config.php";
                $query = "SELECT * FROM tb_karyawan ORDER BY id_karyawan";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id_karyawan'];
                        $nama = $row['nama_karyawan'];
                        echo "<tr>";
                        echo "<td class='text-center'>$no</td>";
                        echo "<td class='text-center'>$nama</td>";

                        $sql = mysqli_query($conn, "SELECT a.nilai_subkriteria as sub, b.id_kriteria as id_kriteria, k.kategori as kategori 
                                        FROM tb_subkriteria a 
                                        JOIN tb_nilai b ON a.id_subkriteria = b.id_subkriteria 
                                        JOIN tb_kriteria k ON b.id_kriteria = k.id_kriteria
                                        WHERE b.id_karyawan='$id' 
                                        ORDER BY b.id_kriteria");
                        while ($dq = mysqli_fetch_array($sql)) {
                            $n_sub = $dq['sub'];
                            $kategori = $dq['kategori'];

                            // Mendapatkan nilai maksimum dan minimum dari setiap kriteria
                            $sql1 = mysqli_query($conn, "SELECT MAX(a.nilai_subkriteria) as max FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_kriteria='{$dq['id_kriteria']}'");
                            $dq1 = mysqli_fetch_array($sql1);
                            $n_max = $dq1['max'];

                            $sql2 = mysqli_query($conn, "SELECT MIN(a.nilai_subkriteria) as min FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_kriteria='{$dq['id_kriteria']}'");
                            $dq2 = mysqli_fetch_array($sql2);
                            $n_min = $dq2['min'];

                            // Menghitung utilitas SMART untuk setiap kriteria
                            $n_maxmin = $n_max - $n_min;

                            if ($kategori === 'Cost') {
                                $n_cm = $n_max - $n_sub;
                                $n_utiliti = number_format(($n_cm / $n_maxmin) * 100 / 100, 2);
                            } elseif ($kategori === 'Benefit') {
                                $n_cm = $n_sub - $n_min;
                                $n_utiliti = number_format(($n_cm / $n_maxmin) * 100 / 100, 2);
                            }

                            echo "<td class='text-center'>$n_utiliti</td>";
                        }

                        echo "</tr>";
                        $no++;
                    }
                }
                ?>
            </tbody>
        </table>
        <h4 class="mt-4">Nilai Normalisasi Bobot</h4>
        <hr>
        <table class="table table-striped responsive">
            <thead>

                <tr>
                    <th class="text-center" rowspan="2">No</th>
                    <th class="text-center" rowspan="2">Nama Karyawan</th>
                    <th class="text-center" colspan="<?= $h ?>">Kriteria</th>
                    <th class="text-center" rowspan="2">Nilai Akhir</th>
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
                include "../src/config.php";
                $query = "SELECT * FROM tb_karyawan ORDER BY id_karyawan";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $n_akhir = 0.0;
                        $id = $row['id_karyawan'];
                        $nama = $row['nama_karyawan'];

                        echo "<tr>";
                        echo "<td class='text-center'>$no</td>";
                        echo "<td class='text-center'>$nama</td>";

                        // Mengambil nilai subkriteria untuk setiap kriteria karyawan
                        $sql = mysqli_query($conn, "SELECT a.nilai_subkriteria as sub, b.id_kriteria as id_kriteria, k.kategori as kategori 
                       FROM tb_subkriteria a 
                       JOIN tb_nilai b ON a.id_subkriteria = b.id_subkriteria 
                       JOIN tb_kriteria k ON b.id_kriteria = k.id_kriteria
                       WHERE b.id_karyawan='$id' 
                       ORDER BY b.id_kriteria");

                        while ($dq = mysqli_fetch_array($sql)) {
                            $n_sub = $dq['sub'];
                            $kategori = $dq['kategori'];

                            // Mendapatkan nilai maksimum dan minimum dari setiap kriteria
                            $sql1 = mysqli_query($conn, "SELECT MAX(a.nilai_subkriteria) as max FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_kriteria='{$dq['id_kriteria']}'");
                            $dq1 = mysqli_fetch_array($sql1);
                            $n_max = $dq1['max'];

                            $sql2 = mysqli_query($conn, "SELECT MIN(a.nilai_subkriteria) as min FROM tb_subkriteria a, tb_nilai b WHERE a.id_subkriteria=b.id_subkriteria AND b.id_kriteria='{$dq['id_kriteria']}'");
                            $dq2 = mysqli_fetch_array($sql2);
                            $n_min = $dq2['min'];

                            // Menghitung utilitas SMART untuk setiap kriteria
                            $n_maxmin = $n_max - $n_min;

                            if ($kategori === 'Cost') {
                                $n_cm = $n_max - $n_sub;
                                $n_utiliti = ($n_cm / $n_maxmin) * 100 / 100;
                            } elseif ($kategori === 'Benefit') {
                                $n_cm = $n_sub - $n_min;
                                $n_utiliti = ($n_cm / $n_maxmin) * 100 / 100;
                            }

                            $data1 = mysqli_query($conn, "SELECT * FROM tb_kriteria WHERE id_kriteria='$dq[id_kriteria]' ORDER BY id_kriteria");
                            $row = mysqli_fetch_array($data1);
                            $dt = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as sum_bobot FROM tb_kriteria");
                            $td = mysqli_fetch_array($dt);
                            $n_normalisasi = $row['bobot_kriteria'] / $td['sum_bobot'];
                            $nm_bobot = number_format($n_utiliti * $n_normalisasi, 2);
                            //$n_akhir += $nm_bobot;
                            $nn_akhir = number_format($n_akhir += $nm_bobot, 2);
                            echo "<td class='text-center'>$nm_bobot</td>";
                        }
                        echo "<td class='text-center'>$nn_akhir</td>";
                        mysqli_query($conn, "UPDATE tb_karyawan set nilai_akhir=$n_akhir WHERE id_karyawan='$id'");
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada data karyawan</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        $rang = mysqli_query($conn, "SELECT * FROM tb_karyawan ORDER BY nilai_akhir DESC");
        $rank = 1;
        while ($rg = mysqli_fetch_array($rang)) {
            mysqli_query($conn, "UPDATE tb_karyawan set rangking='$rank' WHERE id_karyawan='$rg[id_karyawan]'");
            $rank++;
        }
        ?>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>Rangking</h4>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped responsive" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Karyawan</th>
                    <th class="text-center">Nilai Akhir</th>
                    <th class="text-center">Rangking</th>

                </tr>
            </thead>
            <tbody>
                <?php
                include "../src/config.php";
                $query = "SELECT * FROM tb_karyawan ORDER BY id_karyawan ASC";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="text-center">
                                <?= $row['nama_karyawan'] ?>
                            </td>
                            <td class="text-center">
                                <?= number_format($row['nilai_akhir'], 2) ?>
                            </td>
                            <td class="text-center">
                                <?= $row['rangking'] ?>
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