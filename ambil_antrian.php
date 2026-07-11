<?php
include 'config/koneksi.php';

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
ORDER BY a.no_rawat ASC
LIMIT 1
";

$query = mysqli_query($koneksi,$sql);

if(mysqli_num_rows($query)>0){

    $data=mysqli_fetch_assoc($query);

    echo json_encode([
        "success"=>true,
        "data"=>$data
    ]);

}else{

    echo json_encode([
        "success"=>false
    ]);

}