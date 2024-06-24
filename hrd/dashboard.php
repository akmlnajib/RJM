<h1 class="mt-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
        <center>
            <h3>Selamat Datang Pada Sistem Pendukung Keputusan Penilaian Karyawan Terbaik</h3>
            <hr>
            <img src="../src/assets/img/RJM.png" alt="">
            <h4>PT Raharja Jaya Mandiri</h4>
            <hr>
        </center>
        <div class="row">
            <div class="col-6">
                <h5 class="text-center" >VISI</h5>
                <hr>
                <h6>Menjadikan perusahaan yang inovatif, kompetitif dan bermutu di bidang industri karoseri.</h6>
            </div>
            <div class="col-6">
                <h5 class="text-center">MISI</h5>
                <hr>
                <h6>Menyediakan produk yang bermutu, berkulitas tinggi, tepat waktu, dan memberikan layanan yang
                    memuaskan.</h6>
            </div>
        </div>
        <hr>
        <?php
        $query = $conn->query("
                    SELECT department, COUNT(*) AS jumlah_karyawan
                    FROM tb_karyawan
                    GROUP BY department");

        foreach ($query as $data) {
            $department[] = $data['department'];
            $jumlah_karyawan[] = $data['jumlah_karyawan'];
        }
        ?>
        <div class="container" style="width: 500px;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>