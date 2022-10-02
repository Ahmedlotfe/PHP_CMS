<?php
include "db.php";
session_start();

$_SESSION["username"] = null;
$_SESSION["user_firstname"] = null;
$_SESSION["user_lastname"] = null;
$_SESSION["user_role"] = null;
$session_id = session_id();

$logout_user_query = "UPDATE users_online SET user_status = 'logged_out' WHERE session = '{$session_id}'";
$logout = mysqli_query($connection, $logout_user_query);
session_regenerate_id($delete_old_session = false);

header("Location: ../index.php");
