<?php
if (isset($_GET['proses'])) {
    include "../src/config.php";
    $proses = $_GET['proses'];

    if ($proses == 'simpan') {
        $nik = htmlspecialchars($_POST['nik']);
        $nama_karyawan = htmlspecialchars($_POST['nama_karyawan']);
        $department = htmlspecialchars($_POST['department']);
        $kedisiplinan = htmlspecialchars($_POST['kedisiplinan']);
        $prestasi = htmlspecialchars($_POST['prestasi']);

        if (empty($nama_karyawan)) {
            echo "<script>alert('Nama karyawan harus diisi. Silakan coba lagi.');</script>";
        } else {
            $check_query = "SELECT nik FROM tb_karyawan WHERE nik = ?";
            $check_stmt = mysqli_prepare($conn, $check_query);
            mysqli_stmt_bind_param($check_stmt, "s", $nik);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);
            if (mysqli_stmt_num_rows($check_stmt) > 0) {
                echo "<script>alert('NIK sudah ada. Silakan coba lagi dengan NIK yang berbeda.'); window.open('./?halaman=karyawan_aksi&aksi=tambah','_self');</script>";
            } else {
                $query = "INSERT INTO tb_karyawan (nik, nama_karyawan, department, kedisiplinan, prestasi, nilai_akhir, rangking) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                if ($stmt) {
                    $nilai_akhir = 0;
                    $rangking = 0;
                    mysqli_stmt_bind_param($stmt, "sssssss", $nik, $nama_karyawan, $department,$kedisiplinan, $prestasi, $nilai_akhir, $rangking);
                    $result = mysqli_stmt_execute($stmt);
                    if ($result) {
                        echo "<script>alert('Data berhasil disimpan.'); window.open('./?halaman=karyawan','_self');</script>";
                    } else {
                        echo "<script>alert('Gagal menyimpan data. Silakan coba lagi.'); window.open('./?halaman=karyawan_aksi&aksi=tambah','_self');</script>";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
            mysqli_stmt_close($check_stmt);
        }
        mysqli_close($conn);
    } elseif ($proses == 'ubah') {
        $id_karyawan = htmlspecialchars($_POST['id_karyawan']);
        $nik = htmlspecialchars($_POST['nik']);
        $nama_karyawan = htmlspecialchars($_POST['nama_karyawan']);
        $department = htmlspecialchars($_POST['department']);
        $kedisiplinan = htmlspecialchars($_POST['kedisiplinan']);
        $prestasi = htmlspecialchars($_POST['prestasi']);

        $check_query = "SELECT id_karyawan FROM tb_karyawan WHERE nik = ? AND id_karyawan != ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("ss", $nik, $id_karyawan);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>alert('NIK sudah ada. Silakan coba lagi dengan NIK yang berbeda.'); window.open('./?halaman=karyawan_aksi&aksi=ubah&id_karyawan=urlencode($id_karyawan)','_self');</script>";
        } else {
            $update_stmt = $conn->prepare("UPDATE tb_karyawan SET nik = ?, nama_karyawan = ?, department = ? , kedisiplinan = ?, prestasi = ? WHERE id_karyawan = ?");
            $update_stmt->bind_param("ssssss", $nik, $nama_karyawan, $department,$kedisiplinan, $prestasi, $id_karyawan);
            $success = $update_stmt->execute();

            $update_stmt->close();
            $conn->close();

            if ($success) {
                echo "<script>alert('Data berhasil disimpan.'); window.location.href = './?halaman=karyawan';</script>";
            } else {
                echo "<script>alert('Gagal mengubah data. Silakan coba lagi.');</script>";
            }
        }
    } elseif ($proses == 'hapus') {
        if (isset($_GET['id_karyawan'])) {
            $id_karyawan = htmlspecialchars($_GET['id_karyawan']);
            $query = "DELETE FROM tb_karyawan WHERE id_karyawan=?";
            $stmt = mysqli_prepare($conn, $query);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id_karyawan);
                $result = mysqli_stmt_execute($stmt);
                if ($result) {
                    echo "<script>alert('Data berhasil dihapus.'); window.location.href = './?halaman=karyawan';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data. Silakan coba lagi.');</script>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_close($conn);
        } else {
            echo "<script>alert('ID karyawan tidak ditemukan.'); window.location.href = './?halaman=karyawan';</script>";
        }
    } else {
        header("Location: ./?halaman=karyawan");
        exit;
    }
} else {
    header("Location: ./?halaman=karyawan");
    exit;
}
?>