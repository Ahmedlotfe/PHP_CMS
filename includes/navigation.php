<?php
include "includes/db.php";
$query = "SELECT * FROM categories";
$select_all_categories = mysqli_query($connection, $query);
session_start();
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php while ($row = mysqli_fetch_assoc($select_all_categories)) : ?>
                    <li><a href='#'><?php echo "{$row['cat_title']}" ?></a></li>
                <?php endwhile; ?>

                <?php
                if (isset($_SESSION["username"])) {
                    if ($_SESSION["user_role"] === 'admin') :
                ?>
                        <li>
                            <a href="admin">Admin</a>
                        </li>
                <?php
                    endif;
                }
                ?>
                <?php
                if (isset($_SESSION["username"])) :
                ?>
                    <li>
                        <a href=""><i class="fa fa-fw fa-power-off"></i> <?php echo $_SESSION["username"]; ?></a>
                    </li>
                    <li>
                        <a href="./includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="registration.php"><i class="fa fa-fw fa-power-off"></i> Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>