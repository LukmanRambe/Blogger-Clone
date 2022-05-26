<?php

class Online extends Controller {
    public function posts() {
        $userId = $_SESSION['user_id'];

        if (isset($_POST['submit'])) {
            $keyword = $_POST['keyword'];

            $posts = $this->model('Blog_model')->searchPosts($keyword);
        } else {
            $posts = $this->model('Blog_model')->getAllPostsByUserId($userId);
        }

        $user = $this->model('Blog_model')->getUserInformation($userId);

        $data = [
            'judul' => $user['username'],
            'posts' => $posts,
            'user' => $user
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('online/posts', $data);
        $this->view('templates/footer');
    }

    public function post($id) {
        $post = $this->model('Post_model')->getPostById($id);
        $comments = $this->model('Online_model')->getPostComments($id);

        $data = [
            'judul' => $post['title'],
            'post' => $post,
            'comments' => $comments
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('online/post', $data);
        $this->view('templates/footer');
    }

    public function userProfile() {
        $url = explode('/', $_GET['url']);
        $userId = $url[2];
        $user = $this->model('Users_model')->getUserInformation($userId);

        $data = [
            'judul' => $user['username'],
            'user' => $user
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('online/userProfile', $data);
        $this->view('templates/footer');
    }

    public function addComment($id) {
        $post = $this->model('Post_model')->getPostById($id);

        $data = [
            'post' => $post,
            'comment' => '',
            'commentError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $_POST['comment'] = str_replace("/\r\n/", "\n", $_POST['comment']);

            $paragraphs = preg_split("/[\n]{2,}/", $_POST['comment']);
            foreach ($paragraphs as $key => $p) {
                $paragraphs[$key] = str_replace("/\n/", "<br />", $paragraphs[$key]);
            }

            $_POST['comment'] = nl2br(implode("", $paragraphs));

            $data = [
                'user_id' => $_SESSION['user_id'],
                'post_id' => $post['id'],
                'comment' => trim($_POST['comment']),
                'commentError' => ''
            ];

            if (empty($data['comment'])) {
                $data['commentError'] = 'The comment cannot be empty';

                Flasher::setFlash($data['commentError'], 'Please enter your comment', 'danger');
            }

            if (empty($data['commentError'])) {
                if ($this->model('Online_model')->addComment($data) > 0) {
                    header('Location: ' . BASEURL . '/online/post/' . $post['id']);
                    exit;
                } else {
                    die('Something went wrong, please try again!');
                }
            } else {
                $this->post($data['post_id']);
            }
        } else {
            $data = [
                'user_id' => '',
                'post_id' => '',
                'comment' => '',
                'commentError' => ''
            ];
        }

        $this->post($post['id']);
    }
}
