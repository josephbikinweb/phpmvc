<?php
// untuk file ini dipanggil melalui Controller.php
class Students_model
{
    // Kita mengkoneksikan ke database dengan cara driver PDO (PHP Data Object)

    // buat variabel untuk menampung koneksi ke database
    // nama bisa apa saja. #dbh = var DataBase Handler
    // private $dbh;
    // untuk menyimpan query buat var $stmt = statement
    // private $stmt;

    // public function __construct()
    // {
    //     // $dsn = data saurce name
    //     // koneksi ke database dengan nama databasenya phpmvc
    //     $dsn = 'mysql:host=localhost;dbname=phpmvc';

    //     // kita coba apakah koneksi ke database berhasil atau tidak
    //     try {
    //         //masukkan (var,'username database', 'password database') 
    //         // jangan masukkan username dan password disini taruh di file terpisah di config
    //         $this->dbh = new PDO($dsn, 'root', '');
    //     }  //tangkap exceptionnya masukkan ke var $e
    //     catch (PDOException $e) {
    //         // kalau error hentikan programnya tampilkan pesan errornya
    //         die($e->getMessage());
    //     }
    // }
    // DIPINDAHKAN KE FILE TERPISAH

    private $table = 'students';
    private $db;

    public function __construct()
    {
        // karena file database sudah dipanggil terlebih dahulu di file ini.php, kita bisa pakai class Database nya
        $this->db = new Database;
    }

    public function getAllStudents()
    {
        // $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        // // baru kita eksekusi / jalankan
        // $this->stmt->execute();
        // // terakhir kita ambil datanya dengan perintah fetchAll()
        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        // perintah diatas sudah dilakukan di file Database.php class Database

        // jalankan query dari query yang ada di class Database
        // jangan lupa setelah FROM kasih spasi supaya tidak error. karena perintah harusnya SELECT * FROM mahasiswa KALAU tanpa spasi jadinya FROMmahasiswa karena disambung dengan var
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}
