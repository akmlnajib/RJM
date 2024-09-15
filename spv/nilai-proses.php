Sederhana dan Intuitif: Algoritma SMART mudah dipahami dan diterapkan. Ini membuatnya sangat cocok untuk digunakan dalam situasi di mana pengguna mungkin tidak memiliki latar belakang teknis yang kuat.

Keterlibatan Pengguna: Pengguna dapat dengan mudah menentukan bobot untuk setiap kriteria berdasarkan preferensi dan prioritas mereka. Hal ini memungkinkan penyesuaian yang fleksibel sesuai dengan kebutuhan spesifik.

Efisiensi: Proses penilaian dan pengambilan keputusan dapat dilakukan dengan cepat karena algoritma ini tidak memerlukan perhitungan yang rumit atau prosedur yang berbelit-belit.

Transparansi: Hasil penilaian dapat dengan mudah ditelusuri kembali ke bobot dan nilai kriteria, sehingga pengguna dapat memahami bagaimana keputusan dihasilkan.

Fleksibilitas: Algoritma SMART dapat digunakan dalam berbagai konteks, mulai dari penilaian kinerja karyawan hingga pemilihan proyek atau solusi bisnis lainnya.

Kekurangan Algoritma SMART
Subjektivitas: Meskipun pengguna dapat menentukan bobot dan nilai kriteria, proses ini tetap bersifat subjektif dan dapat dipengaruhi oleh bias individu.

Tidak Mengatasi Interaksi Antar Kriteria: Algoritma SMART mengasumsikan bahwa kriteria independen satu sama lain. Ini bisa menjadi masalah jika ada interaksi atau ketergantungan antar kriteria yang signifikan.

Keterbatasan dalam Penanganan Data Kualitatif: SMART lebih mudah diterapkan pada data kuantitatif. Penilaian kualitatif bisa menjadi lebih sulit dan kurang akurat ketika menggunakan metode ini.

Tidak Cocok untuk Masalah Kompleks: Untuk masalah pengambilan keputusan yang sangat kompleks dengan banyak kriteria dan sub-kriteria, metode lain seperti AHP (Analytic Hierarchy Process) atau TOPSIS (Technique for Order Preference by Similarity to Ideal Solution) mungkin lebih cocok.

Normalisasi Data: Algoritma SMART memerlukan normalisasi data untuk memastikan bahwa skala penilaian konsisten. Proses normalisasi ini bisa menjadi tambahan kerja dan mempengaruhi hasil jika tidak dilakukan dengan benar.
<?php
include "../src/config.php";

if (isset($_GET['proses'])) {
    $proses = $_GET['proses'];

    if ($proses == 'simpan') {
        $id_karyawan = $_POST['id_karyawan'] ?? null;

        if ($id_karyawan) {
            $check_query = "SELECT id_karyawan FROM tb_nilai WHERE id_karyawan = ?";
            $check_stmt = mysqli_prepare($conn, $check_query);
            mysqli_stmt_bind_param($check_stmt, "s", $id_karyawan);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);

            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                echo "<script>alert('NIK sudah ada. Silakan coba lagi dengan NIK yang berbeda.'); window.open('./?halaman=nilai_aksi&aksi=tambah','_self');</script>";
            } else {
                $query1 = mysqli_query($conn, "SELECT * FROM tb_kriteria ORDER BY id_kriteria");
                while ($result1 = mysqli_fetch_array($query1)) {
                    $id_kriteria = $result1['id_kriteria'];
                    $id_subkriteria = $_POST[$id_kriteria] ?? null;
                    if ($id_subkriteria) {
                        $query2 = "INSERT INTO tb_nilai (id_karyawan, id_kriteria, id_subkriteria) VALUES (?, ?, ?)";
                        $stmt2 = mysqli_prepare($conn, $query2);
                        mysqli_stmt_bind_param($stmt2, "sss", $id_karyawan, $id_kriteria, $id_subkriteria);
                        mysqli_stmt_execute($stmt2);
                    }
                }
                header("Location: ./?halaman=nilai&status=sukses");
                exit();
            }
        } else {
            echo "<script>alert('Data tidak lengkap. Silakan coba lagi.'); window.open('./?halaman=nilai_aksi&aksi=tambah','_self');</script>";
        }
    } elseif ($proses == 'hapus') {
        $id_karyawan = $_GET['id_karyawan'] ?? null;

        if ($id_karyawan) {
            $delete_query = "DELETE FROM tb_nilai WHERE id_karyawan = ?";
            $delete_stmt = mysqli_prepare($conn, $delete_query);
            mysqli_stmt_bind_param($delete_stmt, "s", $id_karyawan);
            mysqli_stmt_execute($delete_stmt);
            header("Location: ./?halaman=nilai");
            exit();
        } else {
            echo "<script>alert('ID karyawan tidak ditemukan.'); window.open('./?halaman=nilai','_self');</script>";
        }
    }
}
?>
