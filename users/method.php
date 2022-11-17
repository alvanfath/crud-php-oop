<?php
session_start();
include '../database.php';
$db = new database();
$action = $_GET['action'];

if ($action == 'add') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
        $db->addData($name, $email, $password);
        $_SESSION['success'] = "Insert data successfully";
        header('location:index.php');
    } catch (\Throwable $th) {
        header('location:index.php');
    }
} elseif ($action == 'update') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    try {
        $db->updateData($name, $email, $id);
        $_SESSION['success'] = "Update data successfully";
        header('location:index.php');
    } catch (\Throwable $th) {
        header('location:index.php');
    }
} elseif ($action == 'delete') {
    $id = $_GET['id'];
    try {
        $db->deleteData($id);
        $_SESSION['success'] = "Delete data successfully";
        header('location:index.php');
    } catch (\Throwable $th) {
        header('location:index.php');
    }
} elseif ($action == 'check_password') {
    $id = $_POST['id'];
    $password = $_POST['password'];
    try {
        $db->checkPassword($id, $password);
    } catch (\Throwable $th) {
        header('location:index.php');
    }
} elseif ($action == 'change_password') {
    $id = $_POST['id'];
    $current = $_POST['current'];
    $new = $_POST['new_pass'];
    $db->changePassword($id, $current, $new);
} elseif ($action == 'logout') {
    $db->logout();
}
