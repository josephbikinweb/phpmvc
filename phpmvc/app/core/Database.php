<?php
// Database Wrapper bisa untuk tabel manapun
// jadi kita bisa membuat KONEKSI lagi ke database / tabel yang lain dengan koneksi ke class Database ini (class Database ini deisebut Database Wrapper / pembungkus database)
// sebelum bisa dipakai file ini harus dipanggil dulu di file init.php
class Database
{
    //  jadi tidak ada data database kita di halaman ini
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    // buat variabel untuk menampung koneksi ke database
    // nama bisa apa saja. #dbh = var DataBase Handler
    private $dbh;
    // untuk menyimpan query buat var $stmt = statement
    private $stmt;

    public function __construct()
    {
        // $dsn = data saurce name
        // koneksi ke database dengan nama databasenya phpmvc
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        // untuk mengoptimasi KONEKSI ke database maka dibutuhkan parameter baru kita buat option yang isinya array

        $option = [
            // array ini parameter dari konfigurasi ke database
            // untuk membuat database kita koneksinya terjaga terus dengan atribut persistent
            // array pakai koma
            PDO::ATTR_PERSISTENT => true,
            // untuk mode errornya tampilkan exception
            // yang terakhir tanpa koma
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        // option ini masuknya ke dbh

        // kita coba apakah koneksi ke database berhasil atau tidak
        try {
            //masukkan (var,'username database', 'password database') 
            // jangan masukkan username dan password disini taruh di file terpisah di config
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        }  //tangkap exceptionnya masukkan ke var $e
        catch (PDOException $e) {
            // kalau error hentikan programnya tampilkan pesan errornya
            die($e->getMessage());
        }
    }

    // kita butuh function untuk menjalankan query. ini kita buat generic jadi bisa kita buat untuk apapun CRUD bisa flexibel. ini tujuannya untuk DATABASE WRAPPER
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    // jadinya user bisa melakukan apapun untuk querynya apa SELECT, INSERT, atau lainnya CRUD

    // kalau sudah querynya disiapkan kita butuh binding datanya siapa tahu dalam perintahnya ada WHERE nya, Value, set data dll
    // supaya yang menentukan bukan kita tapi aplikasinya melalui parameternya, value parameternya
    // untuk menghindari sql injection maka sebelum query dijalankan kita bersihkan string dari parameternya dengan perintah ini dan perintah ini diluar perintah query
    // jadi parameternya apa yang valuenya apa dan typenya apa. type di set default null jadi yang menentukan aplikasinya
    public function bind($param, $value, $type = null)
    {
        // kita cek :
        if (is_null($type)) {
            // kalau typenya null maka kita lakukan sesuatu / jalankan fungsinya:
            // switch diisi true supaya perintah switch dijalankan
            switch (true) {
                    // kalau isinya int maka typenya adalah int
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                    // kalau isinya /valuenya adalah bool maka typenya adalah bool
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                    // kalau valuenya null maka typenya juga null
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                    // selain daripada itu typenya dimasukkan string
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // setelah dibersihkan dan dicek semua maka query dieksekusi / jalankan
    public function execute()
    {
        $this->stmt->execute();
    }

    // setelah dieksekusi kita mau hasilnya banyak atau satu aja datanya
    // kalau banyak dengan perintah ini
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // kalau single data pakai perintah dibawah
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // untuk menghitung berapa baris yang baru berubah
    public function rowCount()
    {
        // rowCount yang atas punya Database
        // rowCount yang bawah punya PDO / model
        return $this->stmt->rowCount();
    }
}
