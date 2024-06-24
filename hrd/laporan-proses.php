<?php
if (isset($_GET['proses'])) {
    include "../src/config.php";
    $proses = $_GET['proses'];

    if ($proses == 'simpan') {
        function hariIndonesia($hariInggris)
        {
            $namaHariInggris = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
            $namaHariIndonesia = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
            return $namaHariIndonesia[array_search($hariInggris, $namaHariInggris)];
        }

        $hariInggris = date('l');
        $hariIndonesia = hariIndonesia($hariInggris);
        $tanggal = date('d-m-Y');
        $tanggalLengkap = "$hariIndonesia, $tanggal";
        $abjad = "Laporan Hasil Penilaian";
        $detik = date('s');
        $ad = "$abjad - $detik";
        $nama_file = $_FILES['berkas']['name'];
        if (!empty($nama_file)) {
            $lokasi_file = $_FILES['berkas']['tmp_name'];
            $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);

            $file_berkas = $ad . time() . "." . $tipe_file;
            $folder = "../src/berkas/$file_berkas";

            if (move_uploaded_file($lokasi_file, $folder)) {
                $sql = "INSERT INTO tb_laporan (berkas, tanggal, status) VALUES ('$file_berkas', '$tanggalLengkap', 0)";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Data berhasil disimpan.'); window.open('laporan.php','_self');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Maaf, terjadi kesalahan saat meng-upload file.";
            }
        } else {
            echo "File tidak ditemukan.";
        }
    } else {
        header("Location: laporan.php");
        exit;
    }
} else {
    header("Location: laporan.php");
    exit;
}
?>
