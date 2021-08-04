<?php

class Home extends Controller {
    public function index() {
        $data['judul'] = 'Home';

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function logout() {
        session_unset();
        session_destroy();

        header('Location: ' . BASEURL . '/home/index');
        exit;
    }
}
