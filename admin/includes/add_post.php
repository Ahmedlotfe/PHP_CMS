<?php

if (isset($_POST["create_post"])) {
    $post_title = $_POST["title"];
    $post_author = $_POST["author"];
    $post_category_id = $_POST["post_category"];
    $post_status = $_POST["post_status"];

    $post_image = $_FILES["image"]["name"];
    $post_image_temp = $_FILES["image"]["tmp_name"];

    $post_tags = $_POST["post_tags"];
    $post_content = $_POST["post_content"];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "./images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,
    post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(),
    '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

    $query_add_post = mysqli_query($connection, $query);

    if (!$query_add_post) {
        die("QUERY FIALED " . mysqli_error($connection));
    }
    header("Location: posts.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label> <br>
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
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label> <br>
        <select name="post_status" id="">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10">

        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>