<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_users)) :
        ?>
            <tr>
                <td><?php echo $row["user_id"] ?></td>
                <td><?php echo $row["username"] ?></td>
                <td><?php echo $row["user_firstname"] ?></td>
                <td><?php echo $row["user_lastname"] ?></td>
                <td><?php echo $row["user_email"] ?></td>
                <td><?php echo $row["user_role"] ?></td>
                <td><?php echo $row["user_image"] ?></td>

                <td><a href="users.php?change_to_admin=<?php echo $row["user_id"] ?>">Admin</a></td>
                <td><a href="users.php?change_to_sub=<?php echo $row["user_id"] ?>">Subscriber</a></td>

                <td><a href="users.php?source=edit_user&user_id=<?php echo $row["user_id"] ?>">Edit</a></td>
                <td><a href="users.php?delete=<?php echo $row["user_id"] ?>">Delete</a></td>
            </tr>
        <?php endwhile; ?>

        <?php

        if (isset($_GET["change_to_admin"])) {
            $the_user_id = $_GET['change_to_admin'];
            $admin_query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
            $admin_user_query = mysqli_query($connection, $admin_query);
            header("Location: users.php");
        }

        if (isset($_GET["change_to_sub"])) {
            $the_user_id = $_GET['change_to_sub'];
            $sub_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
            $sub_user_query = mysqli_query($connection, $sub_query);
            header("Location: users.php");
        }

        if (isset($_GET["delete"])) {
            $the_user_id = $_GET['delete'];
            $delete_query = "DELETE FROM users WHERE user_id = $the_user_id";
            $delete_comment_query = mysqli_query($connection, $delete_query);
            header("Location: users.php");
        }
        ?>
    </tbody>
</table>