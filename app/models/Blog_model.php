<?php

class Blog_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserInformation($userId) {
        $query = "SELECT * FROM users WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $userId);
        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }

    public function getAllPostsByUserId($userId) {
        $query = "SELECT p.id AS 'post_id', SUBSTRING(p.title, 1, 50) AS 'title', p.created_at, p.content, u.username
                  FROM posts AS p
                  JOIN users AS u ON (p.user_id = u.id)
                  WHERE user_id = :userId
                  ORDER BY p.created_at DESC
                  ";

        $this->db->query($query);
        $this->db->bind('userId', $userId);
        $this->db->execute();

        $results = $this->db->resultSet();

        return $results;
    }

    public function searchPosts($keyword) {
        $query = "SELECT p.id AS 'post_id', SUBSTRING(p.title, 1, 50) AS 'title', p.created_at, p.content, u.username
                  FROM posts AS p
                  JOIN users AS u ON (p.user_id = u.id)
                  WHERE user_id = :userId AND title LIKE '%$keyword%'
                  ORDER BY p.created_at DESC
                  ";

        $this->db->query($query);
        $this->db->bind('userId', $_SESSION['user_id']);
        $this->db->execute();

        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllCommentsByPostUserId($userId) {
        $query = "SELECT p.id AS 'post_id', p.user_id, p.title AS 'post_title', u.id, u.username, c.id AS 'comment_id', c.user_id, SUBSTRING(c.comment, 1, 200) AS comment, c.created_at
                  FROM comments AS c
                  JOIN posts AS p ON (c.post_id = p.id)
                  JOIN users AS u ON (c.user_id = u.id)
                  WHERE p.user_id = :userId
                  ORDER BY created_at DESC
                  ";

        $this->db->query($query);
        $this->db->bind('userId', $userId);
        $this->db->execute();

        $results = $this->db->resultSet();

        return $results;
    }

    public function getCommentById($id) {
        $query = "SELECT * FROM comments WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        $row = $this->db->single();

        return $row;
    }

    public function deleteComment($id) {
        $query = "DELETE FROM comments WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editProfile($data) {
        $query = "UPDATE users SET username = :username, profile_picture = :profilePicture WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $data['user_id']);
        $this->db->bind('username', $_POST['username']);
        $this->db->bind('profilePicture', $_FILES['profilePicture']['name']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
