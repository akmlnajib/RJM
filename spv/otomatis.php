<?php
include "../src/config.php";

if (isset($_GET['term'])) {
    $term = $_GET['term'];

    $query = "SELECT id_karyawan, nama_karyawan, nik FROM tb_karyawan
              WHERE nama_karyawan LIKE ? OR nik LIKE ? LIMIT 5";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $term = '%' . $term . '%';
        mysqli_stmt_bind_param($stmt, "ss", $term, $term);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $suggestions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = array(
                'id_karyawan' => $row['id_karyawan'],
                'nama_karyawan' => $row['nama_karyawan'],
                'nik' => $row['nik']
            );
        }

        echo json_encode($suggestions);
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Parameter term tidak ditemukan.";
}

mysqli_close($conn);
?>