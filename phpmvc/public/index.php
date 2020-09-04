<?php
// kita jalankan sessionnya disini sebagai awal dari website
// karena tidak ada kondisi lain selain start kurung kurawal tidak diperlukan
if (!session_id()) session_start();

require_once '../app/init.php';

// menjalankan kelas App
$app = new App;
