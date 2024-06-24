<?php
if (isset($_GET['proses'])) {
    include "../src/config.php";
    $proses = $_GET['proses'];

    if ($proses == 'ubah') {
        $id_kriteria = $_POST['id_kriteria'];
        $nama_kriteria = $_POST['nama_kriteria'];
        $bobot_kriteria = $_POST['bobot_kriteria'];
        $kategori = $_POST['kategori'];
        $query = "UPDATE tb_kriteria SET nama_kriteria=?, bobot_kriteria=?, kategori=? WHERE id_kriteria=?";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $nama_kriteria, $bobot_kriteria, $kategori, $id_kriteria);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "<script>alert('Data berhasil diubah.'); window.location.href = 'kriteria.php';</script>";
            } else {
                echo "<script>alert('Gagal mengubah data. Silakan coba lagi.');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
        mysqli_close($conn);
    } else {
        header("Location: kriteria.php");
        exit;
    }
} else {
    header("Location: kriteria.php");
    exit;
}
?>
