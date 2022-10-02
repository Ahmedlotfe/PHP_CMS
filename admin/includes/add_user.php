<?php

if (isset($_POST["create_user"])) {
    $username = $_POST["username"];
    $user_password = $_POST["user_password"];
    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    $user_email = $_POST["user_email"];
    $user_role = $_POST["user_role"];

    $user_password = password_hash("{$user_password}", PASSWORD_DEFAULT);

    $add_user_query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $add_user_query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
    $add_user = mysqli_query($connection, $add_user_query);

    header("Location: users.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>