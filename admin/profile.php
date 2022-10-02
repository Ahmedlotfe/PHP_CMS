<?php include "includes/admin_header.php"; ?>
<?php include "../includes/db.php"; ?>

<?php

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user_query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user = mysqli_query($connection, $user_query);
    $user = mysqli_fetch_assoc($select_user);
    $user_id = $user["user_id"];
}

if (isset($_POST["edit_user"])) {
    $username = $_POST["username"];
    $user_password = $_POST["user_password"];
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

    $_SESSION["username"] = $username;
    $_SESSION["user_firstname"] = $user_firstname;
    $_SESSION["user_lastname"] = $user_lastname;
    $_SESSION["user_email"] = $user_email;
    $_SESSION["user_role"] = $user_role;

    header("Location: users.php");
}

?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php
                                if (isset($_SESSION["username"])) {
                                    echo $_SESSION["username"];
                                } ?></small>
                    </h1>

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
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>