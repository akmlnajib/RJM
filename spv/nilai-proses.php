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
