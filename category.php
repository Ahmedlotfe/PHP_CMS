<?php include_once "includes/header.php"; ?>
<!-- Navigation -->
<?php include_once "includes/navigation.php" ?>

<?php

include "includes/db.php";


if (isset($_GET["category"])) {
    $query = "SELECT * FROM posts WHERE post_category_id = {$_GET["category"]}";
    $select_posts_by_category = mysqli_query($connection, $query);
}


?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php while ($row = mysqli_fetch_assoc($select_posts_by_category)) : ?>
                <h2>
                    <a href="post.php?post_id=<?php echo $row["post_id"] ?>"><?php echo $row["post_title"]; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row["post_author"]; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row["post_date"]; ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?php echo $row["post_image"]; ?>" alt="">
                <hr>
                <p>
                    <?php echo substr($row["post_content"], 0, 100); ?>
                </p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $row["post_id"] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php endwhile; ?>


            <hr>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include_once "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include_once "includes/footer.php"; ?>