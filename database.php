<?php

class database
{
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "native_oop";
    protected $connect = "";

    public function __construct()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }

    public function login($email, $password)
    {
        session_start();
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->connect, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);
            if (password_verify($password, $row['password'])) {
                $name = $row['name'];
                $id = $row['id'];
                $_SESSION['username'] = $name;
                $_SESSION['success'] = "Welcome $name";
                header("Location: users/index.php");
            } else {
                $_SESSION['failed'] = "Email or password invalid, please try again";
                header("Location: index.php");
            }
        } else {
            $_SESSION['failed'] = "Email or password invalid, please try again";
            header("Location: index.php");
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header("Location: index.php");
    }

    public function showData()
    {
        $data = mysqli_query($this->connect, "select * from users");
        if ($data->num_rows > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function addData($name, $email, $password)
    {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($this->connect, "INSERT INTO users VALUES('','$name','$email','$hash_password')");
    }

    public function getData($id)
    {
        $data = mysqli_query($this->connect, "select * from users where id='$id'");
        return $data->fetch_array();
    }

    public function updateData($name, $email, $id)
    {
        $data = mysqli_query($this->connect, "update users set name='$name',email='$email' where id ='$id'");
    }

    public function deleteData($id)
    {
        $data = mysqli_query($this->connect, "delete from users where id='$id'");
    }

    public function checkPassword($id, $password)
    {
        $data = mysqli_query($this->connect, "select * from users where id='$id'");
        $get = $data->fetch_array();
        $hash_password = $get['password'];
        if (password_verify($password, $hash_password)) {
            $response = [
                'status' => 1,
                'message' => 'Password valid'
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 2,
                'message' => 'Password invalid'
            ];
            echo json_encode($response);
        }
    }

    public function changePassword($id, $current, $new)
    {
        $new_password = password_hash($new, PASSWORD_DEFAULT);
        $data = mysqli_query($this->connect, "select * from users where id='$id'");
        $get = $data->fetch_array();
        $hash_password = $get['password'];
        if (password_verify($current, $hash_password)) {
            mysqli_query($this->connect, "update users set password='$new_password' where id ='$id'");
            $response = [
                'status' => 1,
                'message' => 'Change Password Succesfully'
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 2,
                'message' => "Current password doesn't match"
            ];
            echo json_encode($response);
        }
    }
}
