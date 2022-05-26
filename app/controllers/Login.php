<?php

class Login extends Controller {
    public function index() {
        $data['judul'] = 'Login';

        if (isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/blog/posts');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('login/index', $data);
        $this->view('templates/footer');
    }

    public function login() {
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
                'formError' => ''
            ];


            // Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Password is empty';

                Flasher::setFlash($data['passwordError'], 'Please enter password', 'danger');
            }

            // Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is empty';

                Flasher::setFlash($data['usernameError'], 'Please enter username', 'danger');
            }

            // Check if form is empty or not
            if (empty($data['username']) && empty($data['password'])) {
                $data['formError'] = 'Form is empty';

                Flasher::setFlash($data['formError'], 'Please fill out the form', 'danger');
            }

            // Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {

                $loggedInUser = $this->model('Login_model')->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect';

                    Flasher::setFlash($data['passwordError'], 'Please try again', 'danger');

                    $this->index();
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => '',
                'formError' => ''
            ];
        }

        $this->index();
    }

    public function createUserSession($user) {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header('Location: ' . BASEURL . '/blog/posts');
        exit;
    }
}
