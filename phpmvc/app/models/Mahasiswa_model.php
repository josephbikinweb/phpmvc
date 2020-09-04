<?php
class Mahasiswa_model
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa
                VALUES
        ('', :nama, :nrp, :email, :jurusan)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa
                WHERE
                id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET
                nama = :nama,
                nrp = :nrp,
                email = :email,
                jurusan = :jurusan
                    WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();

        return $this->db->rowCount();
        // var_dump($data);
    }

    public function cariDataMahasiswa()
    {
        // post keyword dari website / frontend
        $keyword = $_POST['keyword'];

        // kalau = harus sama peris pencariannya
        // kalau LIKE beberapa huruf saja sama bisa
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE :keyword";
        $this->db->query($query);
        // % tidak bisa ditulis di atas karena belum di bind / kaitkan  karena fungsi PDO
        // kalau % didepan berarti dari depan saja begitu juga sebaliknya
        // % didepan dan belakang berarti di cek dari semua tempat meskipun tengah
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
