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

                    <?php include "includes/view_all_comments.php"; ?>
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