<?php
$halaman=htmlspecialchars(@$_GET['halaman']);
switch ($halaman){
    case null:
        include 'dashboard.php';
        break;
    case 'dashboard':
        include 'dashboard.php';
        break;
    case 'laporan':
        include 'laporan.php';
        break;
    case 'laporan_proses':
        include 'laporan-proses.php';
        break;
    default:
        include '404.php';
}