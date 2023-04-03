<?php

session_start();
require_once 'functions.php';

if (!empty($_POST)) {
    $db = connect();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userStmt = $db->prepare("SELECT * FROM users WHERE username=:username");
    $userStmt->execute([
        'username' => $username
    ]);
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    //TODO: Add errors to login page
    $isValidUser = $user && password_verify($password, $user['password']);
    if (!$isValidUser) {
        header('location: login-form.php?type=failure&message=invalid username or password');
    }

    if ($isValidUser) {
        $_SESSION['authenticated'] = true;
        $_SESSION['userRole'] = $user['role'];
        header('location: index.php?type=success&message=login successful');
    }

}
