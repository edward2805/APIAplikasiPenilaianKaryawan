<?php 

require_once('helper.php');

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    
if($db_konek) {
    $baseUrl = "https://sinarpalasari.000webhostapp.com/setik/gambar/gambar_tugas/";
    $link = $_SERVER['DOCUMENT_ROOT'] . '/setik/gambar/gambar_tugas/';
  
    $id_tugas = $_POST['id_tugas'];
    $status = $_POST['status'];
    $tanggal_sekarang = date("Y-m-d H:i:s");
    $tugas_selesai = date("Y-m-d H:i:s", strtotime($tanggal_sekarang . "+7 hours"));
    $keterangan = $_POST['keterangan'];
    $gambar = $_FILES['gambar'];
    $gambarNama = $_FILES['gambar']['name'];
    $gambarTmp = $_FILES['gambar']['tmp_name'];

    
    $validasi_foto = ['jpg', 'jpeg', 'png'];
    $gambar_extensi = strtolower(pathinfo($gambarNama, PATHINFO_EXTENSION));
    $gambarNamaFinal = uniqid() . '.' . $gambar_extensi;
    $gambarPath = $baseUrl.$gambarNamaFinal;
    
    if( !in_array($gambar_extensi, $validasi_foto)){
        
    } else {
        $sql = 
        "UPDATE `tb_tugas` 
        SET 
        status = '$status',
        tugas_selesai = '$tugas_selesai',
        gambar = '$gambarNamaFinal',
        path_gambar = '$gambarPath',
        keterangan = '$keterangan'
        WHERE id_tugas='$id_tugas'";
    }

    if(mysqli_query($db_konek, $sql)){
        move_uploaded_file($gambarTmp, $link.$gambarNamaFinal);
        echo json_encode(array('respon' => 'berhasil'));
    }else {
        echo json_encode(array('respon' => 'gagal'));
    }
}else{
    echo json_encode(array('koneksi' => 'gagal'));
} mysqli_close($db_konek);


}
?>