<?php

class Blog extends Controller {
    public function posts() {
        if (!isset(($_SESSION['login']))) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        if (isset($_POST['submit'])) {
            $keyword = $_POST['keyword'];

            $posts = $this->model('Blog_model')->searchPosts($keyword);
        } else {
            $userId = $_SESSION['user_id'];

            $posts = $this->model('Blog_model')->getAllPostsByUserId($userId);
        }


        $data = [
            'judul' => 'Posts',
            'posts' => $posts
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('blog/posts', $data);
        $this->view('templates/footer');
    }

    public function comments() {
        $userId = $_SESSION['user_id'];

        $comments = $this->model('Blog_model')->getAllCommentsByPostUserId($userId);

        $data = [
            'judul' => 'Comments',
            'comments' => $comments,
        ];

        if (!isset(($_SESSION['login']))) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('blog/comments', $data);
        $this->view('templates/footer');
    }

    public function settings() {
        $data['judul'] = 'Settings';

        if (!isset(($_SESSION['login']))) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('templates/sidebar');
        $this->view('blog/settings', $data);
        $this->view('templates/footer');
    }

    public function userProfile() {
        $userId = $_SESSION['user_id'];
        $user = $this->model('Blog_model')->getUserInformation($userId);

        $data = [
            'judul' => $_SESSION['username'],
            'user' => $user
        ];

        if (!isset(($_SESSION['login']))) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('blog/userProfile', $data);
        $this->view('templates/footer');
    }

    public function deleteComment($id) {
        $comment = $this->model('Blog_model')->getCommentById($id);

        $data = [
            'comment' => $comment
        ];

        if ($this->model('Blog_model')->deleteComment($data['comment']['id']) > 0) {
            Flasher::setFlash('Success', 'Comment has been deleted', 'success');

            header('Location: ' . BASEURL . '/blog/comments');
            exit;
        } else {
            die('Something went wrong, please try again!');
        }
    }

    public function editProfile() {
        $userId = $_SESSION['user_id'];
        $user = $this->model('Blog_model')->getUserInformation($userId);

        // Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'judul' => $_SESSION['username'],
                'user_id' => $_SESSION['user_id'],
                'username' => trim($_POST['username']),
                'currentPic' => $user['profile_picture'],
                'pictureName' => $_FILES['profilePicture']['name'],
                'pictureSize' => $_FILES['profilePicture']['size'],
                'tmpName' => $_FILES['profilePicture']['tmp_name'],
                'usernameError' => '',
                'pictureError' => '',
                'formError' => ''
            ];

            // Validate size
            if ($data['pictureSize'] > 3000000) {
                $data['pictureError'] = 'The picture size is too large!';

                Flasher::setFlash($data['pictureError'], 'Please insert another picture', 'danger');
            }

            // Validate picture type
            $validPictureExtension = ['jpg', 'jpeg', 'png'];
            $pictureExtension = explode('.', $data['pictureName']);
            $pictureExtension = strtolower(end($pictureExtension));

            if (!in_array($pictureExtension, $validPictureExtension)) {
                $data['pictureError'] = "File format doesn't supported!";

                Flasher::setFlash($data['pictureError'], 'Please choose another picture', 'danger');
            }

            // Validate profile picture
            if (empty($data['tmpName'])) {
                $data['pictureError'] = 'Picture is empty';

                Flasher::setFlash($data['pictureError'], 'Please insert a picture', 'danger');
            }

            // Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is empty';

                Flasher::setFlash($data['usernameError'], 'Please enter username', 'danger');
            }

            // Check is form empty or not
            if (empty($data['username']) && empty($data['password'])) {
                $data['formError'] = 'Form is empty';

                Flasher::setFlash($data['formError'], 'Please fill out the form', 'danger');
            }

            // Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['pictureError'])) {
                if ($this->model('Blog_model')->editProfile($data) > 0) {
                    move_uploaded_file($data['tmpName'], 'img/userProfilePicture/' . $data['pictureName']);
                    unlink($data['tmpName']);

                    $currentPic = 'img/userProfilePicture/' . $data['currentPic'];
                    if ($currentPic != 'img/userProfilePicture/default.jpg') {
                        unlink($currentPic);
                    }

                    Flasher::setFlash('Success', 'Profile has changed successfully', 'success');

                    header('Location: ' . BASEURL . '/blog/userProfile');
                    exit;
                } else {
                    die('Something went wrong, please try again!');
                }
            } else {
                $this->userProfile();
            }
        } else {
            $data = [
                'username' => '',
                'profilePicture' => '',
                'pictureName' => '',
                'pictureSize' => '',
                'tmpName' => '',
                'usernameError' => '',
                'pictureError' => '',
                'formError' => ''
            ];
        }

        $this->userProfile();
    }
}
