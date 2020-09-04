<?php
// class ini untuk menangani Flash Message
// dibuat 2 static method supaya tidak dilakukan instansiasi
// Supaya bisa jalan maka dipanggil di file ini.php
class Flasher
{
    // parameter bisa ditambah, tipe bootstrap yang dipakai misal warna apa kalau berhasil
    // fungsi setFlash ini untuk meNENTUkan pesan flashnya seperti apa
    public static function setFlash($pesan, $aksi, $tipe)
    {
        // Session ini bisa dijalankan kalau ada trigger tapi sebelumnya harus dipanggil / dijalankan dulu diawal website. Jadi Session start ditaruh di index public
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    // method flash ini untuk meNAMPILkan pesannya
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION["flash"]["tipe"] . ' alert-dismissible fade show" role="alert">Data Mahasiswa <strong>' . $_SESSION["flash"]["pesan"] . '</strong> ' . $_SESSION["flash"]["aksi"] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button></div>';
            //supaya berjalan sekali maka kita unset flash message nya 
            unset($_SESSION['flash']);
        }
    }
}
