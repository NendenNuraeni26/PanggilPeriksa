<?php
include 'config/koneksi.php';

$no_rawat=$_POST['no_rawat'];

mysqli_query(
    $koneksi,
    "UPDATE antri_periksa
     SET status='2'
     WHERE no_rawat='$no_rawat'"
);

echo "OK";