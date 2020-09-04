<?php
class Students extends Controller
{
    public function index()
    {
        $data['judul'] = 'Students List';
        $data['student'] = $this->model('Students_model')->getAllStudents();
        $this->view('templates/header', $data);
        $this->view('students/index', $data);
        $this->view('templates/footer');
    }
}
