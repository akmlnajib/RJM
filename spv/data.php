<div class="card mb-4">
    <div class="card-header">
        Bobot
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama Karyawan</th>
                    <th class="text-center">Kedisiplinan</th>
                    <th class="text-center">Prestasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM tb_karyawan";
                $execute = mysqli_query($conn, $query);
                while ($result = mysqli_fetch_array($execute)) { ?>
                    <tr id="data">
                        <td class="text-center"><?= $no ?></td>
                        <td class="text-center"><?= htmlspecialchars($result['nik']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($result['nama_karyawan']) ?></td>
                        <td class="text-center">
                            <?php
                            if ($result['kedisiplinan'] >= 7) {
                                echo "5";
                            } elseif ($result['kedisiplinan'] >= 5) {
                                echo "4";
                            } elseif ($result['kedisiplinan'] >= 4) {
                                echo "3";
                            } elseif ($result['kedisiplinan'] >= 1) {
                                echo "2";
                            } elseif ($result['kedisiplinan'] == 0) {
                                echo "1";
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($result['prestasi'] >= 6) {
                                echo "5";
                            } elseif ($result['prestasi'] >= 4) {
                                echo "4";
                            } elseif ($result['prestasi'] >= 2) {
                                echo "3";
                            } elseif ($result['prestasi'] == 1) {
                                echo "2";
                            } elseif ($result['prestasi'] == 0) {
                                echo "1";
                            }
                            ?>
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
