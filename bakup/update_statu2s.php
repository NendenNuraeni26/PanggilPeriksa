<?php
include 'config/koneksi.php';

$no_rawat = isset($_POST['no_rawat']) ? $_POST['no_rawat'] : '';

if($no_rawat != ''){

    $no_rawat = mysqli_real_escape_string($koneksi,$no_rawat);

    mysqli_query($koneksi,"
        UPDATE antri_periksa
        SET status='2'
        WHERE no_rawat='$no_rawat'
        AND status='1'
    ");

}

echo "OK";