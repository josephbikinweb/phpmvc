<?php
// class App untuk mengatur url
class App
{

    // Nilai Default dari tiap variabel controller, method dan parameter
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];


    public function __construct()
    {
        // parseURL untuk memecahkan url menjadi array per kata apabila ditulis di webpage url
        // contoh home/index berarti : 
        // home = controllers
        // index = method
        $url = $this->parseURL();
        // untuk mendapatkan nama rule index ke 0 diberi.php
        // controller

        if (file_exists('..app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            // perintah unset untuk mengambil hanya array 0 atau contoh home/about
            unset($url[0]);
            // var_dump($url);
        }

        // fungsi untuk memanggil kembali controller dengann fungsi if diatas
        require_once '../app/controllers/' . $this->controller . '.php';
        // intansiasi / bikin objectnya
        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            // Kalau methodnya ada di array 1 atau url kedua contoh setelah home/about
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
                // var_dump($url);
            }
        }

        // parameter
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller,  $this->method], $this->params);
    }

    // untuk mencegah modifikasi url di web page gunakan ht access
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            // menghilangkan tanda / di url
            $url = rtrim($_GET['url'], '/');
            // supaya url bersih dari karakter2 aneh
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // pecah url tanpa tanda / dan jadikan array
            $url = explode('/', $url);
            return $url;
        }
    }
}
