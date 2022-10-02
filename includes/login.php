<?php
include "db.php";
session_start();

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);


    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED " . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($select_user_query);
    if (!$row) {
        header("Location: ../index.php");
    } else if (password_verify($password, $row["user_password"])) {
        $_SESSION["username"] = $row["username"];
        $_SESSION["user_firstname"] = $row["user_firstname"];
        $_SESSION["user_lastname"] = $row["user_lastname"];
        $_SESSION["user_email"] = $row["user_email"];
        $_SESSION["user_role"] = $row["user_role"];
        $session_id = session_id();

        $login_user_query = "INSERT INTO users_online (username, user_status, session) VALUES ('{$_SESSION["username"]}', 'logged_in', '{$session_id}')";
        mysqli_query($connection, $login_user_query);

        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
