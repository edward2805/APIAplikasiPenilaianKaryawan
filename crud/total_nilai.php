<?php 

require_once('helper.php');

if($_SERVER['REQUEST_METHOD']=='GET'){

    $user_id = $_GET['user_id'];
    
    $query = "SELECT tb_tugas.user_id, user.nama,  
            SUM(penilaian.nilai) AS total_nilai,
            COUNT(tb_tugas.user_id) AS total_tugas
            FROM penilaian
            INNER JOIN tb_tugas ON penilaian.id_tugas = tb_tugas.id_tugas
            INNER JOIN user ON tb_tugas.user_id = user.id_user
            WHERE user.id_user ='$user_id'";
    
    $sql = mysqli_query($db_konek, $query);


    if(mysqli_num_rows($sql)>0){
        $respon = array();
        while($rows=mysqli_fetch_array($sql)){
            $hasil=array();
            $hasil["user_id"] = $rows["user_id"] ;
            $hasil["nama"] = $rows["nama"] ;
            $hasil["total_nilai"] = $rows["total_nilai"] ;
            $hasil["total_tugas"] = $rows["total_tugas"] ;
            $hasil["rata_rata_tugas"] = $rows["total_nilai"]/$rows["total_tugas"] ;
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