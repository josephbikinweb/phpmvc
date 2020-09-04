// Ketika documentnya sudah siap, jalankan fungsi didalamnya
$(function () {
    // UBAH Label
    // supaya tulisan TAMBAH tidak ditimpa UBAH maka disipakan perintah ini
    $('.tombolTambahData').on('click', function () {
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type = submit]').html('Tambah Data');
        $('#nama').val('');
        $('#nrp').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#id').val('');
    });

    // Perintah diatas bisa ditulis juga seperti ini
    // $('.tombolTambahData').on('click', function () {
    //     $('#formModalLabel').html('Tambah Data Mahasiswa');
    //     $('.modal-body form')[0].reset();
    // });

    // Perintah  ini untuk mengubah ke tambah
    // jquery tolong carikan saya sebuah elemen yang nama kelasnya tampilModalUbah lalu jalankan fungsi berikut
    $('.tampilModalUbah').on('click', function () {
        // jQuery carikan saya ID formModalLabel dan timpa tulisan html nya jadi...
        $('#formModalLabel').html('Ubah Data Mahasiswa');
        // jQuery carikan saya class modal-footer button bertype submit dan timpa tulisan htmlnya...
        $('.modal-footer button[type = submit]').html('Ubah Data');
        // untuk merubah data yang diubah dengan method ubah di controller Mahasiswa
        // ketika klik ubah yang dikirimkan adalah 4 data di ajax, id masih belum maka dibuatkan form hidden di index.php di form modal dengan method POST
        // tujuan perintah dibawah supaya yang awalnya actionnya ke method tambah diganti menjadi method ubah
        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah');

        // id dati data-id ditangkap dan diproses disini melalui ajax
        // $(this) disini adalah tombol yang kita click di function class tampilModalUbah lalu kita ambil yang datanya yang namanya id
        // beda dengan php, javascript banyak memakai ()
        const id = $(this).data('id');
        // maka kita id kita pakai di perintah dibawah ini
        // console.log(id);
        $.ajax({
            // alamat url dengan controller mahasiswa dengan method getUbah
            // ingat ajax menggunakan ,
            url: 'http://localhost/phpmvc/public/mahasiswa/getUbah',
            // id di sebelah kiri adalah nama data yang dikirimkan const
            // id di sebelah kanan adalah isi datanya
            data: {
                id: id
            },
            // data dikirim lewat...POST / GET
            method: 'post',
            // type data text biasa atau json
            dataType: 'json',
            // ketika success maka jalankan function. Function ini akan menerima parameter kita tulis aja data / lainnya
            success: function (data) {
                // di modal sudah ada id di tiap inputnya
                // jQuey carikan saya id nama ubah valuenya ganti dengan data yang diambil yang idnya  nama, dst
                // kalau di javascript object pakai . kalau php ->
                // data ini dikirimkan ke controller mahasiswa method / function getubah
                $('#nama').val(data.nama);
                $('#nrp').val(data.nrp);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        });
    });
});