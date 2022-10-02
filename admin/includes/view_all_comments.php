<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_comments)) :
        ?>
            <tr>
                <td><?php echo $row["comment_id"] ?></td>
                <td><?php echo $row["comment_author"] ?></td>
                <td><?php echo $row["comment_content"] ?></td>
                <td><?php echo $row["comment_email"] ?></td>
                <td><?php echo $row["comment_status"] ?></td>
                <?php
                $post_query = "SELECT * FROM posts WHERE post_id = {$row["comment_post_id"]}";
                $select_post_of_comment = mysqli_query($connection, $post_query);
                $the_post = mysqli_fetch_assoc($select_post_of_comment);
                ?>
                <td><a href="../post.php?post_id=<?php echo $the_post["post_id"] ?>"><?php echo $the_post["post_title"] ?></a></td>

                <td><?php echo $row["comment_date"] ?></td>

                <td><a href="comments.php?approve=<?php echo $row["comment_id"]; ?>">Approve</a></td>
                <td><a href="comments.php?unapprove=<?php echo $row["comment_id"]; ?>">Unapprove</a></td>

                <td><a href="comments.php?delete=<?php echo $row["comment_id"]; ?>">Delete</a></td>
            </tr>
        <?php endwhile; ?>

        <?php

        if (isset($_GET["approve"])) {
            $the_comment_id = $_GET['approve'];
            $unapprove_query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = $the_comment_id";
            $unapprove_comment_query = mysqli_query($connection, $unapprove_query);
            header("Location: comments.php");
        }

        if (isset($_GET["unapprove"])) {
            $the_comment_id = $_GET['unapprove'];
            $unapprove_query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = $the_comment_id";
            $unapprove_comment_query = mysqli_query($connection, $unapprove_query);
            header("Location: comments.php");
        }

        if (isset($_GET["delete"])) {
            $the_comment_id = $_GET['delete'];
            $delete_query = "DELETE FROM comments WHERE comment_id = $the_comment_id";
            $delete_comment_query = mysqli_query($connection, $delete_query);
            header("Location: comments.php");
        }
        ?>
    </tbody>
</table>