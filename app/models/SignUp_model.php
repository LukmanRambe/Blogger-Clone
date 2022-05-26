<?php

class SignUp_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function signUp($data) {
        $query = "INSERT INTO $this->table (username, email, password, profile_picture) VALUES (:username, :email, :password, 'default.jpg')";

        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function findUserByEmail($email) {
        $query = "SELECT * FROM $this->table WHERE email = :email";

        $this->db->query($query);
        $this->db->bind('email', $email);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
