<?php ob_start() ?>
<?php include "./includes/db.php" ?>

<?php
$message = '';
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $body = $_POST["body"];
    // Always set content-type when sending HTML email
    $SMTP = "smtp.secureserver.net";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <ahmedlotfe132@gmail.com>' . "\r\n";

    // send email
    mail($email, $subject, $body, $headers);
    echo "Email Sent";
}

?>


<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php



?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" cols="50" rows="10">

                                </textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>