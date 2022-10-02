<?php

if (isset($_POST["checkBoxArray"])) {
    foreach ($_POST["checkBoxArray"] as $checkBoxValue) {
        $bulk_option = $_POST["bulk_options"];
        if ($bulk_option === 'delete') {
            $bulk_query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
            $delete_posts = mysqli_query($connection, $bulk_query);
        } else {
            $bulk_query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$checkBoxValue}";
            $update_posts = mysqli_query($connection, $bulk_query);
        }
    }
}

?>



<form action="" method="POST">

    <table class="table table-bordered table-hover">


        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>



        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>View Post</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_posts)) :
            ?>
                <tr>
                    <td><input name="checkBoxArray[]" class="checkBoxes" type="checkbox" value="<?php echo $row["post_id"] ?>"></td>
                    <td><?php echo $row["post_id"] ?></td>
                    <td><?php echo $row["post_author"] ?></td>
                    <td><a href="../post.php?post_id=<?php echo $row["post_id"]; ?>"><?php echo $row["post_title"] ?></a></td>
                    <td>
                        <?php
                        $query = "SELECT * FROM categories WHERE cat_id = {$row["post_category_id"]}";
                        $select_category_by_id = mysqli_query($connection, $query);
                        $category = mysqli_fetch_assoc($select_category_by_id);
                        echo $category["cat_title"];
                        ?>
                    </td>
                    <td><?php echo $row["post_status"] ?></td>
                    <td><img width='100' src="./images/<?php echo $row["post_image"] ?>" alt=""></td>
                    <td><?php echo $row["post_tags"] ?></td>
                    <td><?php echo $row["post_comment_count"] ?></td>
                    <td><?php echo $row["post_date"] ?></td>
                    <td><a onclick="javascript: return confirm('Are you want to delete this post?');" href="posts.php?delete=<?php echo $row["post_id"]; ?>">Delete</a></td>
                    <td><a href="posts.php?source=edit&post_id=<?php echo $row["post_id"]; ?>">Edit</a></td>
                    <td><a href="../post.php?post_id=<?php echo $row["post_id"] ?>">View Post</a></td>
                </tr>
            <?php endwhile; ?>

            <?php
            if (isset($_GET["delete"])) {
                $the_post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = $the_post_id";
                $delete_query = mysqli_query($connection, $query);
                header("Location: posts.php");
            }
            ?>
        </tbody>
    </table>

</form>