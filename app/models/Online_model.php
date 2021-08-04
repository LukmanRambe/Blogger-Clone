<?php

class Online_model {
    private $table = 'comments';
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addComment($data) {
        $query = "INSERT INTO $this->table (user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)";

        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('post_id', $data['post_id']);
        $this->db->bind('comment', $data['comment']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPostComments($id) {
        $query = "SELECT p.content, u.id, u.profile_picture AS 'profile_picture', u.username, c.comment, c.created_at
                  FROM $this->table AS c
                  JOIN posts AS p ON (c.post_id = p.id)
                  JOIN users AS u ON (c.user_id = u.id)
                  WHERE c.post_id = :id
                  ORDER BY created_at DESC
                  ";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        $results = $this->db->resultSet();

        return $results;
    }
}
