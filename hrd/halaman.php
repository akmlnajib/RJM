<?php
$halaman=htmlspecialchars(@$_GET['halaman']);
switch ($halaman){
    case null:
        include 'dashboard.php';
        break;
    case 'dashboard':
        include 'dashboard.php';
        break;
    case 'karyawan':
        include 'karyawan.php';
        break;
    case 'karyawan_aksi':
        include 'karyawan-aksi.php';
        break;
    case 'kriteria_aksi':
        include 'kriteria-aksi.php';
        break;
    case 'hasil':
        include 'hasil.php';
        break;
    case 'laporan_aksi':
        include 'laporan-aksi.php';
        break;
    default:
        include '404.php';
}