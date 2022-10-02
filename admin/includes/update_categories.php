<form action="" method="POST">
    <div class="form-group">
        <label for="cat-title">Update Category</label>
        <?php
        if (isset($_GET["edit"])) :
            $cat_id = $_GET["edit"];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $select_category_by_id = mysqli_query($connection, $query);
            $category = mysqli_fetch_assoc($select_category_by_id);
        ?>
            <input class="form-control" type="text" value="<?php if ($category) echo $category["cat_title"]; ?>" name="cat_title">
        <?php endif; ?>

        <?php
        if (isset($_POST["update_category"])) {
            $the_cat_title = $_POST["cat_title"];
            $query = "UPDATE categories SET cat_title = '$the_cat_title' WHERE cat_id = {$cat_id}";
            $update_query = mysqli_query($connection, $query);
            if (!$update_query) {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            header("Location: categories.php");
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>