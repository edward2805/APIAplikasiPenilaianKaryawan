<?php

define('HOST', 'localhost');
define('USER', 'id20938462_edward');
define('PASSWORD', '4N(Bh+0{/yk\zCMp');
define('DB', 'id20938462_setik');

$db_konek = mysqli_connect(HOST, USER, PASSWORD, DB) or die('Unable connect');

header('Content-Type: application/json');