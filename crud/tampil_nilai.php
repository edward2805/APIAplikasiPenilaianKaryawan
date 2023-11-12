<?php 

require_once('helper.php');

if($_SERVER['REQUEST_METHOD']=='GET'){

    $user_id = $_GET['user_id'];
    
    $query = "SELECT user.nama, tb_tugas.user_id, tb_tugas.tt_number, tb_tugas.site_id, tb_tugas.site_name,
                penilaian.id_penilaian, penilaian.nilai, penilaian.durasi_tugas, tb_tugas.start_tugas,
                tb_tugas.end_tugas, tb_tugas.tugas_selesai
            FROM penilaian 
            INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
            INNER JOIN user ON tb_tugas.user_id = user.id_user
            WHERE id_user ='$user_id'";
    
    $sql = mysqli_query($db_konek, $query);


    if(mysqli_num_rows($sql)>0){
        $respon = array();
        while($rows=mysqli_fetch_array($sql)){
            $hasil=array();
            $hasil["id_penilaian"] = $rows["id_penilaian"] ;
            $hasil["user_id"] = $rows["user_id"] ;
            $hasil["nama"] = $rows["nama"] ;
            $hasil["tt_number"] = $rows["tt_number"] ;
            $hasil["site_id"] = $rows["site_id"] ;
            $hasil["site_name"] = $rows["site_name"] ;
            $hasil["nilai"] = $rows["nilai"] ;
            $hasil["durasi_tugas"] = $rows["durasi_tugas"] ;
            $hasil["start_tugas"] = $rows["start_tugas"] ;
            $hasil["end_tugas"] = $rows["end_tugas"] ;
            $hasil["tugas_selesai"] = $rows["tugas_selesai"] ;
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