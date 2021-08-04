<?php

class Post_model {
    private $table = 'posts';
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addPost($data) {
        $query = "INSERT INTO $this->table (user_id, title, content) VALUES (:user_id, :title, :content)";

        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('title', $data['title']);
        $this->db->bind('content', $data['content']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPostById($id) {
        $query = "SELECT u.id AS 'user_id', u.username, u.profile_picture, p.id, p.title, p.content, p.created_at
                  FROM $this->table AS p
                  JOIN users AS u ON (p.user_id = u.id)
                  WHERE p.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        $row = $this->db->single();

        return $row;
    }

    public function updatePost($data) {
        $query = "UPDATE $this->table SET title = :title, content = :content WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('title', $data['title']);
        $this->db->bind('content', $data['content']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deletePost($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
