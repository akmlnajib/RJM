<?php
if (isset($_GET['proses'])) {
    include "../src/config.php";
    $proses = $_GET['proses'];

    if ($proses == 'validasi') {
        $id_laporan = $_GET['id'];
        $query = $conn->query("SELECT * FROM tb_laporan WHERE id_laporan='$id_laporan'");
        $result = $query->fetch_assoc();
        $conn->query("UPDATE tb_laporan SET status = 1 WHERE id_laporan='$id_laporan'");
        echo "<script>alert('Data berhasil disimpan.'); window.open('./?halaman=laporan','_self');</script>";
    } elseif ($proses == 'tolak') {
        $id_laporan = $_GET['id'];
        $query = $conn->query("SELECT * FROM tb_laporan WHERE id_laporan='$id_laporan'");
        $result = $query->fetch_assoc();
        $conn->query("UPDATE tb_laporan SET status = 1 WHERE id_laporan='$id_laporan'");
        echo "<script>alert('Data berhasil disimpan.'); window.open('./?halaman=laporan','_self');</script>";
    } else {
        header("Location: ./?halaman=laporan");
        exit;
    }
} else {
    header("Location: ./?halaman=laporan");
    exit;
}
?>