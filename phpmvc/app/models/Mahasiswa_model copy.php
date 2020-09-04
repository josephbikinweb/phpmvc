<?php
// untuk file ini dipanggil melalui Controller.php
class Mahasiswa_model
{
    // private $mhs = [
    //     [
    //         "nama"      => "Joseph",
    //         "nrp"       => "312334111",
    //         "email"     => "jnugro78@gmail.com",
    //         "jurusan"   => "ekonomi"
    //     ],
    //     [
    //         "nama"      => "Jo",
    //         "nrp"       => "312334222",
    //         "email"     => "jnugr@gmail.com",
    //         "jurusan"   => "teknik"
    //     ],
    //     [
    //         "nama"      => "Jojo",
    //         "nrp"       => "312378444",
    //         "email"     => "jn444@gmail.com",
    //         "jurusan"   => "teologi"
    //     ]
    // ];

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

    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        // karena file database sudah dipanggil terlebih dahulu di file ini.php, kita bisa pakai class Database nya
        $this->db = new Database;
    }

    public function getAllMahasiswa()
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

    public function getMahasiswaById($id)
    {
        // jangan lupa spasi ketika menyambungkan var dengan string supaya ketika digabung tetap perintah sesuai SQL
        // =:id  sengaja ditulis bukan $id supaya menghindari sql injection
        // =:id untuk menyimpan data yang kita binding
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // menerima data $_POST dan ditampung di var $data
    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa
                VALUES
        ('', :nama, :nrp, :email, :jurusan)";
        // cara diatas lalu kita binding untuk menghindari sql injection

        $this->db->query($query);
        // binding = mengikat
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->execute();
        // fungsi diatas belum mengembalikan angka yg dikondisikan di controller Mahasiswa.php
        // didalam class Database kita tambahkan fungsi / method untuk menghitung berapa baris yang ditambahkan

        return $this->db->rowCount();

        // untuk coba kalau gagal ditambahkan
        // return 0;
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa
                WHERE
                id = :id";
        // cara diatas lalu kita binding untuk menghindari sql injection

        $this->db->query($query);
        // binding = mengikat
        $this->db->bind('id', $id);
        $this->db->execute();
        // fungsi diatas belum mengembalikan angka yg dikondisikan di controller Mahasiswa.php
        // didalam class Database kita tambahkan fungsi / method untuk menghitung berapa baris yang ditambahkan

        return $this->db->rowCount();

        // untuk coba kalau gagal ditambahkan
        // return 0;
    }

    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET
                nama =:nama,
                nrp =:nrp,
                email =:email,
                jurusan =:jurusan
                    WHERE id = :id";

        // cara diatas lalu kita binding untuk menghindari sql injection

        $this->db->query($query);
        // binding = mengikat
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        // fungsi diatas belum mengembalikan angka yg dikondisikan di controller Mahasiswa.php
        // didalam class Database kita tambahkan fungsi / method untuk menghitung berapa baris yang ditambahkan

        return $this->db->rowCount();

        // untuk coba kalau gagal ditambahkan
        // return 0;
    }
}
