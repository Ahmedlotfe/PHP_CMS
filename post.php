<?php include_once "includes/header.php"; ?>
<!-- Navigation -->
<?php include_once "includes/navigation.php" ?>

<?php

include "includes/db.php";

if (isset($_GET["post_id"])) {
    $query = "SELECT * FROM posts WHERE post_id = {$_GET['post_id']}";
    $select_specific_post = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($select_specific_post);
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
            <h2>
                <a href="#"><?php echo $row["post_title"]; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $row["post_author"]; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row["post_date"]; ?></p>
            <hr>
            <img class="img-responsive" src="./images/<?php echo $row["post_image"]; ?>" alt="">
            <hr>
            <p>
                <?php echo $row["post_content"]; ?>
            </p>

            <?php
            if (isset($_SESSION["username"])) {
                if ($_SESSION["username"] === $row["post_author"]) :
            ?>
                    <a class="btn btn-primary" href="edit_post.php?post_id=<?php echo $row["post_id"] ?>">Edit Post <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php
                endif;
            }
            ?>


            <hr>

            <!-- Blog Comments -->
            <?php

            if (isset($_POST["create_comment"])) {

                $the_post_id = $_GET["post_id"];
                $comment_author = $_SESSION["username"];
                $comment_email = $_SESSION["user_email"];
                $comment_content = $_POST["comment_content"];

                $comment_query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, 
                comment_content, comment_status, comment_date) ";
                $comment_query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', 
                '{$comment_content}', 'approve', now())";

                $create_comment_query = mysqli_query($connection, $comment_query);

                if (!$create_comment_query) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }

                $update_post_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $update_post_query .= "WHERE post_id = $the_post_id";
                $update_comment_count = mysqli_query($connection, $update_post_query);
            }

            ?>

            <!-- Comments Form -->
            <?php if (isset($_SESSION["username"])) : ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST">
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            <?php endif ?>

            <hr>

            <!-- Posted Comments -->

            <?php
            $post_id = $_GET["post_id"];
            $comments_query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approve' ORDER BY comment_id DESC";
            $all_comments = mysqli_query($connection, $comments_query);
            if (!$all_comments) {
                die("QUERY FIALED " . mysqli_error($connection));
            }
            while ($comment = mysqli_fetch_assoc($all_comments)) :
            ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment["comment_author"] ?>
                            <small><?php echo $comment["comment_date"] ?></small>
                        </h4>
                        <?php echo $comment["comment_content"] ?>
                    </div>
                </div>

            <?php endwhile; ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include_once "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include_once "includes/footer.php"; ?>