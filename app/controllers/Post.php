<?php

class Post extends Controller {
    public function create() {
        $data['judul'] = 'Create Post';

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('post/create');
        $this->view('templates/footer');
    }

    public function edit($id) {
        $post = $this->model('Post_model')->getPostById($id);

        $data = [
            'judul' => 'Edit Post',
            'post' => $post
        ];

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('post/edit', $data);
        $this->view('templates/footer');
    }

    public function createPost() {
        $data = [
            'title' => '',
            'content' => '',
            'titleError' => '',
            'contentError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $_POST['content'] = str_replace("/\r\n/", "\n", $_POST['content']);

            $paragraphs = preg_split("/[\n]{2,}/", $_POST['content']);
            foreach ($paragraphs as $key => $p) {
                $paragraphs[$key] = str_replace("/\n/", "<br>", $paragraphs[$key]);
            }

            $_POST['content'] = nl2br(implode("", $paragraphs));

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'titleError' => '',
                'contentError' => '',
                'formError' => ''
            ];

            if (empty($data['content'])) {
                $data['contentError'] = 'The content cannot be empty';

                Flasher::setFlash($data['contentError'], 'Please fill out the content', 'danger');
            }

            if (empty($data['title'])) {
                $data['titleError'] = 'The title cannot be empty';

                Flasher::setFlash($data['titleError'], 'Please enter title', 'danger');
            }

            if (empty($data['title']) && empty($data['content'])) {
                $data['formError'] = 'Form is empty';

                Flasher::setFlash($data['formError'], 'Please fill out the form', 'danger');

                $this->create();
            }

            if (empty($data['titleError']) && empty($data['contentError'])) {
                if ($this->model('Post_model')->addPost($data) > 0) {
                    header('Location: ' . BASEURL . '/blog/posts');
                    exit;
                } else {
                    die('Something went wrong, please try again!');
                }
            } else {
                $this->view('post/create', $data);
            }
        } else {
            $data = [
                'user_id' => '',
                'title' => '',
                'content' => '',
                'titleError' => '',
                'contentError' => '',
                'formError' => ''
            ];
        }

        $this->create();
    }

    public function editPost($id) {
        $post = $this->model('Post_model')->getPostById($id);

        $data = [
            'post' => $post,
            'title' => '',
            'content' => '',
            'titleError' => '',
            'contentError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'post' => $post,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'titleError' => '',
                'contentError' => ''
            ];

            if (empty($data['content'])) {
                $data['contentError'] = 'The content cannot be empty';

                Flasher::setFlash($data['contentError'], 'Please fill out the content', 'danger');
            }

            if (empty($data['title'])) {
                $data['titleError'] = 'The title cannot be empty';

                Flasher::setFlash($data['titleError'], 'Please fill out the title', 'danger');
            }

            if ($data['title'] == $data['post']['title'] && $data['content'] == $data['post']['content']) {
                $data['titleError'] = "Nothing has changed";

                Flasher::setFlash($data['titleError'], 'Please change either the title or the content', 'danger');
            }

            if (empty($data['titleError']) && empty($data['contentError'])) {
                if ($this->model('Post_model')->updatePost($data) > 0) {
                    Flasher::setFlash('Success', 'Post has been edited', 'success');

                    header('Location: ' . BASEURL . '/blog/posts');
                    exit;
                } else {
                    die('Something went wrong, please try again!');
                }
            } else {
                header('Location: ' . BASEURL . '/post/edit/' . $data['post']['id']);
                exit;
                $this->edit($id);
            }
        }
    }

    public function deletePost($id) {
        $post = $this->model('Post_model')->getPostById($id);

        $data = [
            'post' => $post,
            'title' => '',
            'content' => '',
            'titleError' => '',
            'contentError' => ''
        ];

        if ($this->model('Post_model')->deletePost($data['post']['id']) > 0) {
            Flasher::setFlash('Success', 'Post has been deleted', 'success');

            header('Location: ' . BASEURL . '/blog/posts');
            exit;
        } else {
            die('Something went wrong, please try again!');
        }
    }
}
