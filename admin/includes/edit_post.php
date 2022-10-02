<?php

if (isset($_GET["post_id"])) {
    $post_id = $_GET["post_id"];
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $select_post = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($select_post);
}

if (isset($_POST["edit_post"])) {
    $post_title = $_POST["title"];
    $post_author = $_POST["author"];

    $post_category_id = $_POST["post_category"];
    $post_status = $_POST["post_status"];

    $post_image = $_FILES["image"]["name"];
    $post_image_temp = $_FILES["image"]["tmp_name"];

    $post_tags = $_POST["post_tags"];
    $post_content = $_POST["post_content"];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "./images/$post_image");

    $query = "UPDATE posts SET post_category_id = {$post_category_id}, post_title = '{$post_title}', 
    post_author = '{$post_author}', post_image = '{$post_image}', post_content = '{$post_content}', 
    post_tags = '{$post_tags}', post_comment_count = '{$post_comment_count}', post_status = '{$post_status}' 
    WHERE post_id = {$post_id}";

    $query_edit_post = mysqli_query($connection, $query);

    confirmQuery($query_edit_post);
    header("Location: posts.php");
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post["post_title"] ?>">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category Id</label> <br>
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) :
            ?>
                <option value="<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_title"]; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post["post_author"] ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label> <br>
        <select name="post_status" id="">
            <option value="<?php echo $post["post_status"] ?>"><?php echo ucwords($post["post_status"]); ?></option>
            <?php
            if ($post["post_status"] == "published") :
            ?>
                <option value="draft">Draft</option>
            <?php
            else :
            ?>
                <option value="published">Published</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image">
        <img width="100" src="./images/<?php echo $post["post_image"]; ?>" alt="">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post["post_tags"] ?>">
    </div>
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
        <?php echo $post["post_content"] ?>
        </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
    </div>
</form>