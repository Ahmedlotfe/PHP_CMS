<?php
include "includes/db.php";
$query = "SELECT * FROM categories";
$select_all_categories = mysqli_query($connection, $query);
?>

<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <?php if (!isset($_SESSION["username"])) : ?>
        <div class="well">
            <h4>Login</h4>
            <form action="includes/login.php" method="POST">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter Your Username">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Your Password">
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">
                        Login
                    </button>
                </span>
            </form>
            <!-- /.input-group -->
        </div>
    <?php endif; ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php while ($row = mysqli_fetch_assoc($select_all_categories)) : ?>
                        <li><a href='category.php?category=<?php echo $row["cat_id"]; ?>'><?php echo "{$row['cat_title']}" ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>