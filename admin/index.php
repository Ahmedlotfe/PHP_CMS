<?php include "includes/admin_header.php" ?>


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
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $posts_query = "SELECT * FROM posts";
                                        $select_all_posts = mysqli_query($connection, $posts_query);
                                        $posts_count = mysqli_num_rows($select_all_posts);
                                        echo $posts_count;
                                        ?>
                                    </div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $comments_query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connection, $comments_query);
                                        $comments_count = mysqli_num_rows($select_all_comments);
                                        echo $comments_count;
                                        ?>
                                    </div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $users_query = "SELECT * FROM users";
                                        $select_all_users = mysqli_query($connection, $users_query);
                                        $users_count = mysqli_num_rows($select_all_users);
                                        echo $users_count;
                                        ?>
                                    </div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <?php
                                        $categories_query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($connection, $categories_query);
                                        $categories_count = mysqli_num_rows($select_all_categories);
                                        echo $categories_count;
                                        ?>
                                    </div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
            $published_posts_query = "SELECT * FROM posts WHERE post_status = 'published'";
            $select_all_published_posts = mysqli_query($connection, $published_posts_query);
            $published_posts_count = mysqli_num_rows($select_all_published_posts);

            $drafted_posts_query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_all_drafted_posts = mysqli_query($connection, $drafted_posts_query);
            $drafted_posts_count = mysqli_num_rows($select_all_drafted_posts);

            $unapprove_comment_query = "SELECT * FROM comments WHERE comment_status = 'unapprove'";
            $select_all_unapprove_comment = mysqli_query($connection, $unapprove_comment_query);
            $unapprove_comment_count = mysqli_num_rows($select_all_unapprove_comment);

            $subscriber_users_query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $select_all_subscriber_users = mysqli_query($connection, $subscriber_users_query);
            $subscriber_users_count = mysqli_num_rows($select_all_subscriber_users);
            ?>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawVisualization);

                    function drawVisualization() {
                        // Some raw data (not necessarily accurate)
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Count'],
                            <?php
                            $element_text = ['Active Posts', 'Published Posts', 'Drafted Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Pending Comments'];
                            $element_count = [$posts_count, $published_posts_count, $drafted_posts_count, $categories_count, $users_count, $subscriber_users_count, $comments_count, $unapprove_comment_count];

                            for ($i = 0; $i < count($element_text); $i++) {
                                echo "['{$element_text[$i]}', $element_count[$i]],";
                            };
                            ?>
                        ]);


                        var options = {
                            title: '',
                            vAxis: {
                                title: ''
                            },
                            hAxis: {
                                title: ''
                            },
                            seriesType: 'bars',
                            series: {
                                5: {
                                    type: 'line'
                                }
                            }
                        };

                        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                    }
                </script>
                <div id="chart_div" style="width: auto; height: 500px;"></div>
            </div>


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