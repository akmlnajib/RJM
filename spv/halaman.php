<?php
$halaman=htmlspecialchars(@$_GET['halaman']);
switch ($halaman){
    case null:
        include 'dashboard.php';
        break;
    case 'dashboard':
        include 'dashboard.php';
        break;
    case 'nilai':
        include 'nilai.php';
        break;
    case 'nilai_aksi':
        include 'nilai-aksi.php';
        break;
    default:
        include '404.php';
}