<?php
include 'config/koneksi.php';

header('Content-Type: application/json');

$kd_poli = isset($_GET['kd_poli']) ? $_GET['kd_poli'] : '';

if($kd_poli == ''){
    echo json_encode([
        "success"=>false,
        "message"=>"kd_poli kosong"
    ]);
    exit;
}

$kd_poli = mysqli_real_escape_string($koneksi,$kd_poli);

$sql = "
SELECT
    a.no_rawat,
    a.kd_poli,
    a.kd_dokter,
    rp.no_reg,
    p.nm_pasien,
    pl.nm_poli
FROM antri_periksa a
INNER JOIN reg_periksa rp ON rp.no_rawat=a.no_rawat
INNER JOIN pasien p ON p.no_rkm_medis=rp.no_rkm_medis
INNER JOIN poliklinik pl ON pl.kd_poli=rp.kd_poli
WHERE a.status='1'
AND a.kd_poli='$kd_poli'
ORDER BY a.no_rawat ASC
LIMIT 1
";

$query = mysqli_query($koneksi,$sql);

if(mysqli_num_rows($query)>0){

    $data = mysqli_fetch_assoc($query);

    echo json_encode([
        "success"=>true,
        "data"=>$data
    ]);

}else{

    echo json_encode([
        "success"=>false
    ]);

}