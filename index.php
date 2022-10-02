<?php include_once "includes/header.php"; ?>
<!-- Navigation -->
<?php include_once "includes/navigation.php" ?>

<?php

include "includes/db.php";

if (isset($_GET["page"])) {
    $page = $_GET["page"];
    $per_page = 2;
} else {
    $page = '';
}

if ($page == "" || $page == 1) {
    $page_1 = 0;
} else {
    $page_1 = ($page * $per_page) - 2;
}

$post_query_count = "SELECT * FROM posts";
$find_count = mysqli_query($connection, $post_query_count);
$count = mysqli_num_rows($find_count);
$per_page = 2;
$total_pages = ceil($count / $per_page);

$query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT {$page_1}, 2";
$select_all_posts = mysqli_query($connection, $query);


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
            <?php while ($row = mysqli_fetch_assoc($select_all_posts)) : ?>

                <h2>
                    <a href="post.php?post_id=<?php echo $row["post_id"] ?>"><?php echo $row["post_title"]; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $row["post_author"]; ?>"><?php echo $row["post_author"]; ?></a>
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

    <ul class="pager">
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if ($i == $page) : ?>
                <li><a class="active_link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php else : ?>
                <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endif ?>
        <?php endfor; ?>
    </ul>

    <?php include_once "includes/footer.php"; ?>