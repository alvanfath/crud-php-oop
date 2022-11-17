<?php 
    include 'database.php';
    $db = new database();
    $action = $_GET['action'];

    if ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $db->login($email,$password);
    }
?>