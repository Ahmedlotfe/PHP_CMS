<?php include "includes/admin_header.php"; ?>
<?php include "../includes/db.php"; ?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php
                                if (isset($_SESSION["username"])) {
                                    echo $_SESSION["username"];
                                } ?></small>
                    </h1>

                    <div class="col-xs-6">
                        <?php insert_categories(); ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php
                        // Update AND INCLUDE QUERY
                        if (isset($_GET["edit"])) {
                            $cat_id = $_GET["edit"];
                            include "includes/update_categories.php";
                        }
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $categories = get_all_categories();
                                while ($row = mysqli_fetch_assoc($categories)) : ?>
                                    <tr>
                                        <td><a href='#'><?php echo "{$row['cat_id']}" ?></a></td>
                                        <td><a href='#'><?php echo "{$row['cat_title']}" ?></a></td>
                                        <td><a href="categories.php?delete=<?php echo "{$row['cat_id']}"; ?>">Delete</a></td>
                                        <td><a href="categories.php?edit=<?php echo "{$row['cat_id']}"; ?>">Edit</a></td>
                                    </tr>
                                <?php endwhile; ?>

                                <?php   // DELETE QUERY
                                if (isset($_GET["delete"])) {
                                    delete_category($_GET["delete"]);
                                }
                                ?>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script src="js/scripts.js"></script>

</body>

</html>