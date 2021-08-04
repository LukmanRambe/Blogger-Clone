<?php

class Users_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserInformation($userId) {
        $query = "SELECT * FROM $this->table WHERE id = :userId";

        $this->db->query($query);
        $this->db->bind("userId", $userId);
        $this->db->execute();

        $result = $this->db->single();

        return $result;
    }
}
