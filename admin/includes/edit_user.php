<?php

if (isset($_GET["user_id"])) {
    $user_query = "SELECT * FROM users WHERE user_id = {$_GET['user_id']}";
    $select_user = mysqli_query($connection, $user_query);
    $user = mysqli_fetch_assoc($select_user);
}

if (isset($_POST["edit_user"])) {
    $user_id = $_GET["user_id"];
    $username = $_POST["username"];
    $user_password = $_POST["user_password"];

    $user_password = password_hash("{$user_password}", PASSWORD_DEFAULT);

    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    $user_email = $_POST["user_email"];
    $user_role = $_POST["user_role"];

    $edit_user_query = "UPDATE users SET username = '{$username}',
    user_password = '{$user_password}', user_firstname = '{$user_firstname}',
    user_lastname = '{$user_lastname}', user_email = '{$user_email}',
    user_role = '{$user_role}' WHERE user_id = {$user_id}";
    $edit_user = mysqli_query($connection, $edit_user_query);

    if (!$edit_user) {
        die("QUERY FAILED " . mysqli_error($connection));
    }

    header("Location: users.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user["user_firstname"] ?>">
    </div>
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user["user_lastname"] ?>">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user["user_role"]; ?>"><?php echo ucwords($user["user_role"]); ?></option>
            <?php
            if ($user["user_role"] == "admin") :
            ?>
                <option value="subscriber">Subscriber</option>
            <?php
            else :
            ?>
                <option value="admin">Admin</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $user["username"] ?>">
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user["user_email"] ?>">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>