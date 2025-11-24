<?php 

session_start(); //start php session
require_once 'config.php'; //import config.php

if (isset($_POST['register'])) { //check if register button is clicked
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if($checkEmail->num_rows > 0) { //if num_rows is greater than 0 in the database
        $_SESSION['register_error'] = 'Email is already registered!'; //$_SESSION = temporary storage, $_SESSION[variable]
        $_SESSION['active_form'] = 'register';
    }else {
        $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
    }

    header("Location: index.php"); //redirect user to the main page
    exit();
}

if(isset($_POST['login'])) { //check if login button is clicked
    $name = $_POST['name']; //temporary stores the values
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'"); //query the user with the given email
    if($result->num_rows > 0) { //checker to see if there is match
        $user = $result->fetch_assoc(); //retrive users data using fetch_assoc
        if(password_verify($password, $user['password'])) { //password_verify(entered password, password in database)
            $SESSION['name'] = $user['name'];
            $SESSION['email'] = $user['email'];

            if ($user['role'] == 'admin') {
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}
?>