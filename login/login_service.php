<?php 

    //koneksi ke database
    $server = "localhost";
    $username = "id20938462_edward";
    $password = "4N(Bh+0{/yk\zCMp";
    $database = "id20938462_setik";

    $koneksi = mysqli_connect($server, $username, $password, $database);

    if (mysqli_connect_errno()){
        echo "gagal konek dengan database". mysqli_connect_errno() ;
    }

    //ambil data yang di kirim android
    $username = $_POST["post_username"];
    $password = $_POST["post_password"];

    //proses periksa username dan password di database
    $query = "SELECT * FROM user where username='$username' AND password='$password' ";
    $objek_query = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($objek_query);

    //proses login
    if($data){
        echo json_encode(
            array(
                'response' => true,
                'payload' => array(
                    "id" => $data["id_user"],
                    "nama" => $data["nama"],
                    "username" => $data["username"],
                    "alamat" => $data["alamat"],
                    "no_tlp" => $data["no_tlp"],
                )
            )
        );
    } else {
        echo json_encode(
            array(
                'response' => false,
                'payload' => null
                )
            );
    }
?>