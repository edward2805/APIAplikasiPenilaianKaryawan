<?php 

require_once('helper.php');

if($_SERVER['REQUEST_METHOD']=='GET'){

    $user_id = $_GET['user_id'];
    $query = "SELECT 
    tb_tugas.user_id, user.nama, tb_tugas.tt_number, tb_tugas.site_id, tb_tugas.site_name, tenant.tenant_name, tb_tugas.alamat, 
    tb_tugas.id_tugas, tb_tugas.status, tb_tugas.tipe, tb_tugas.start_tugas, tb_tugas.end_tugas, tb_tugas.tugas_selesai, DATEDIFF (end_tugas, tugas_selesai) AS durasi_selesai 
    FROM tb_tugas 
    INNER JOIN user ON tb_tugas.user_id = user.id 
    INNER JOIN tenant ON tb_tugas.id_tenant = tenant.id_tenant
    WHERE user_id='$user_id' AND
    status LIKE '%close%' ORDER BY tb_tugas.user_id DESC";
    
    $sql = mysqli_query($db_konek, $query);

    if(mysqli_num_rows($sql)>0){
        $respon = array();
        while($rows=mysqli_fetch_array($sql)){
            $hasil=array();
            $hasil["id_tugas"] = $rows["id_tugas"] ;
            $hasil["user_id"] = $rows["user_id"] ;
            $hasil["nama"] = $rows["nama"] ;
            $hasil["tt_number"] = $rows["tt_number"] ;
            $hasil["site_id"] = $rows["site_id"] ;
            $hasil["site_name"] = $rows["site_name"] ;
            $hasil["tenant_name"] = $rows["tenant_name"] ;
            $hasil["status"] = $rows["status"] ;
            $hasil["alamat"] = $rows["alamat"] ;
            $hasil["tipe"] = $rows["tipe"] ;
            $hasil["start_tugas"] = $rows["start_tugas"] ;
            $hasil["end_tugas"] = $rows["end_tugas"] ;
            $hasil["tugas_selesai"] = $rows["tugas_selesai"] ;
            $hasil["durasi_selesai"] = $rows["durasi_selesai"] ;
            array_push($respon, $hasil);
        }
        echo json_encode($respon);
    }else{
        $respon["sukses"]=0;
        $respon["pesan"]="Hasil Tidak Ditemukan";
		echo json_encode($respon);
    }

    mysqli_close($db_konek);
}

?>