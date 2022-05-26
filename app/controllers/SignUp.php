<?php

class SignUp extends Controller {
    public function index() {
        $data['judul'] = 'Sign Up';

        if (isset($_SESSION['login'])) {
            header('Location: ' . BASEURL . '/home/posts');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('signup/index');
        $this->view('templates/footer');
    }

    public function signUp() {
        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm-password' => trim($_POST['confirm-password']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'formError' => ''
            ];

            $nameValidation = "/^[a-z A-Z 0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z ]*|[^\d]*)$/i";

            // Validate confirm password
            if (empty($data['confirm-password'])) {
                $data['confirmPasswordError'] = 'Confirm password is empty';

                Flasher::setFlash($data['confirmPasswordError'], 'Please enter confirm password', 'danger');
            } else {
                if ($data['password'] != $data['confirm-password']) {
                    $data['confirmPasswordError'] = "Passwords don't match";

                    Flasher::setFlash($data['confirmPasswordError'], 'Please try again', 'danger');
                }
            }

            // Validate password on length and numeric values
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please is empty';

                Flasher::setFlash($data['passwordError'], 'Please enter password', 'danger');
            } else if (strlen($data['password']) < 8) {
                $data['passwordError'] = 'Password must be atleast 8 characters';

                Flasher::setFlash($data['passwordError'], 'Please try again', 'danger');
            } else if (!preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must have at least one numeric value';

                Flasher::setFlash($data['passwordError'], 'Please try again', 'danger');
            }


            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email address is empty';

                Flasher::setFlash($data['emailError'], 'Please enter email address', 'danger');
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Incorrect email format';

                Flasher::setFlash($data['emailError'], 'Please try again', 'danger');
            } else {
                if ($this->model('SignUp_model')->findUserByEmail($data['email']) > 0) {
                    $data['emailError'] = 'Email is already taken';

                    Flasher::setFlash($data['emailError'], 'Please try again', 'danger');
                }
            }

            // Validate username on letters / numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is empty';

                Flasher::setFlash($data['usernameError'], 'Please enter username', 'danger');
            } else if (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers';

                Flasher::setFlash($data['usernameError'], 'Please try again', 'danger');
            }

            if (empty($data['username']) && empty($data['email']) && empty($data['password']) && empty($data['confirm-password'])) {
                $data['formError'] = 'Form is empty';

                Flasher::setFlash($data['formError'], 'Please fill out the form', 'danger');
            }

            // Make sure that errors are empty
            if (
                empty($data['usernameError']) && empty($data['emailError'])
                && empty($data['passwordError']) && empty($data['confirmPasswordError'])
            ) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user from model function
                if ($this->model('SignUp_model')->signUp($data) > 0) {
                    Flasher::setFlash('Success', 'You have been signed up successfully', 'success');

                    header('Location: ' . BASEURL . '/login');
                    exit;
                } else {
                    die('Something went wrong');
                }
            }

            $this->index();
        }
    }
}
