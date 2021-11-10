<?php

include("path.php");
include(ROOT_PATH . "/app/controllers/emails.php");

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/fontawesome/css/all.css">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">


        <!-- Custom Styling -->
        <link rel="stylesheet" href="assets/css/style.css">

        <title>Contact -TranVinhLab Blogs</title>
    </head>

    <body>
        
        <!-- Header -->
        <?php 
            include(ROOT_PATH . "/app/includes/header.php");
        ?>

        <!-- Page Wrapper -->
        <div class="page-wrapper">  

            <!-- Contact -->
            <div class="contact">

                <div class="content">

                    <h1 class="title">Contact Us</h1>

                    <?php include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>

                    <form action="contact.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label>Your Email</label>
                            <input type="email" name="email" value="<?php echo $email ?>" class="text-input">
                        </div>
                        <div>
                            <label>Title</label>
                            <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Body</label>
                            <textarea name="body"id="body"><?php echo $body ?></textarea>
                        </div>  
                        <div>
                        <button type="submit" name='send-email' class="btn btn-big contact-btn" style="margin-top:20px;">
                            <i class="fas fa-envelope"></i>
                            Send
                        </button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Contact -->

        </div>
        <!-- // Page Wrapper -->

        <!-- footer -->
        <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

         <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <!-- Ckeditor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>

        <!-- Custom Script -->
        <script src="assets/js/scripts.js"></script>

    </body>

</html>