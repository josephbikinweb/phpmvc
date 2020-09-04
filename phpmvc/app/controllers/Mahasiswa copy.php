<?php
class Mahasiswa extends Controller
{
    public function index()
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    // kita buat tampilan single yang bila diklik mengarah ke details mahasiswanya
    // kita ambil id dari url ketika klik details an masukkan ke var $id
    public function details($id)
    {
        $data['judul'] = 'Details Mahasiswa';
        // $id ambil dari yang atas
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);
        $this->view('templates/header', $data);
        $this->view('mahasiswa/details', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        // kalau kita panggil model mahasiswa dan didalamnya ada method tambahDataMahasiswa yang mengirimkan data $_POST itu menghasilkan nilai lebih besar dari 0
        // kalau nilai nya lebih besar dari 0 maka ada baris baru yang kita lakukan yaitu redirect ke halaman utama mahasiswa
        // ingat phpdasar
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
            // sebelum redirect kita set dulu flash messagenya yang dipanggil di index.php
            // ingat kita set 3 parameter di file flasher (pesan,aksi,tipe)
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/mahasiswa');
            exit;
        }
    }

    // function hapus ini menerima data berupa id mana yang mau dihapus dari index.php
    public function hapus($id)
    {
        // kalau kita panggil model mahasiswa dan didalamnya ada method tambahDataMahasiswa yang mengirimkan data $_POST itu menghasilkan nilai lebih besar dari 0
        // kalau nilai nya lebih besar dari 0 maka ada baris baru yang kita lakukan yaitu redirect ke halaman utama mahasiswa
        // ingat phpdasar
        if ($this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0) {
            // sebelum redirect kita set dulu flash messagenya yang dipanggil di index.php
            // ingat kita set 3 parameter di file flasher (pesan,aksi,tipe)
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('location: ' . BASEURL . '/mahasiswa');
            exit;
        }
    }

    public function getUbah()
    {
        // ketika kita jalankan ajaxnya, kita minta data nya ke model dan kirim datanya dengan method POST
        // karena kita sudah memiliki query berdasarkan id maka kita pakai fungsi tersebut dari model

        // karena bentuk datanya array assoc untuk bisa di tampilkan melalui echo maka harus ditambahkan code json_encode dan ditampilkan dalam bentuk json -->untuk test data sudah terambil atau belum
        echo json_encode($this->model('Mahasiswa_model')->getMahasiswaById($_POST['id']));
    }

    public function ubah()
    {
        if ($this->model('Mahasiswa_model')->ubahDataMahasiswa($_POST) > 0) {
            // sebelum redirect kita set dulu flash messagenya yang dipanggil di index.php
            // ingat kita set 3 parameter di file flasher (pesan,aksi,tipe)
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('location: ' . BASEURL . '/mahasiswa');
            exit;
        }
    }
}
