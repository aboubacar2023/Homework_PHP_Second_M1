<?php
require __DIR__ . '/../conf/Database.php';

class Auth
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function login($email, $password)
    {
        $password = hash('sha256', $password);
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $recuperation = $this->db->prepare($query);
        $recuperation->execute([
            'email'=>  $email, 
            'password' => $password
        ]);
        $data = $recuperation->fetch();
        if ($data && $data['etat'] === 1) {
            $_SESSION['user'] = $data;
            return true;
        }
        if ($data['etat'] === 0) {
            $_SESSION['error'] = "Cet utilisateur n'est pas active !!!";
        }
        return false;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function logout()
    {
        session_destroy();
        header('Location: /Homework_PHP_Second_M1/views/login.php');
        exit;
    }
    public function getUser()
    {
        return $_SESSION['user'] ?? null;
    }
}