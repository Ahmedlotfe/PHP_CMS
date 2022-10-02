<?php

include "../includes/db.php";

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim(strip_tags($string)));
}

function users_online()
{
    if (isset($_GET["onlineusers"])) {
        global $connection;
        $select_online_users = mysqli_query($connection, "SELECT * FROM users_online WHERE user_status = 'logged_in'");
        $count = mysqli_num_rows($select_online_users);
        echo $count;
    }
}

users_online();


function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FIALED " . mysqli_error($connection));
    }
}

function insert_categories()
{
    global $connection;
    if (isset($_POST["submit"])) {
        $cat_title = $_POST["cat_title"];
        if ($cat_title) {
            $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("QUERY FAILED " . mysqli_error($connection));
            }
            header("Refresh:0");
        } else {
            echo "This field should not be empty";
        }
    }
}


function get_all_categories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);
    return $select_all_categories;
}

function delete_category($cat_id)
{
    global $connection;
    $query = "DELETE FROM categories WHERE cat_id = $cat_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: categories.php");
}
