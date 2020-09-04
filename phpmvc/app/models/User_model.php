<?php
// file in dipanggil melalui file Controller.php
class User_Model
{
    private $nama = 'Joseph';
    // $pekerjaan = 'Programer';

    public function getUser()
    {
        return $this->nama;
    }
}

// $a = new User_model;
// echo $a->getUser();
