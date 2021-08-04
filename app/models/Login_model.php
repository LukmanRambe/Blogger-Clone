<?php

class Login_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM $this->table WHERE username = :username";

        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->execute();

        $row = $this->db->single();

        if ($row > 0) {
            $hashedPassword = $row['password'];
        } else {
            return false;
        }

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}
