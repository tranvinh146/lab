<?php
    include("../../path.php");
    include(ROOT_PATH . "/app/controllers/users.php");
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">


        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../assets/css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">

        <title>Admin Section - Add User</title>
    </head>

    <body>
        
        <!-- Header -->
        <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

            <!-- Left Sidebar -->
            <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add User</a>
                    <a href="index.php" class="btn btn-big">Manage Users</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Add User</h2>
                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>

                    <form action="create.php" method="post">
                        <div>
                            <label>Username</label>
                            <input type="text" name="username" class="text-input" value="<?php echo $username; ?>">
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" class="text-input" value="<?php echo $email; ?>">
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" name="password" class="text-input">
                        </div>
                        <div>
                            <label>Password Confirmation</label>
                            <input type="password" name="passwordConf" class="text-input">
                        </div>
                        <div>
                            <?php if(isset($admin) && $admin == 1): ?>
                                <input type="checkbox" name="admin" id="admin" checked>
                            <?php else: ?>
                                <input type="checkbox" name="admin" id="admin">
                            <?php endif; ?>
                            <label for="admin">Admin</label>
                        </div>

                        <div>
                            <button type="submit" name="create-admin" class="btn btn-big">Add User</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->



         <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <!-- Ckeditor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>

        <!-- Custom Script -->
        <script src="../../assets/js/scripts.js"></script>

    </body>

</html>