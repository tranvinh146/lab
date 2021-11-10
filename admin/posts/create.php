<?php
    include("../../path.php");
    include(ROOT_PATH . "/app/controllers/posts.php");
    adminOnly();
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

        <title>Admin Section - Add Post</title>
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
                    <a href="create.php" class="btn btn-big">Add Post</a>
                    <a href="index.php" class="btn btn-big">Manage Posts</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Add Post</h2>

                    <?php include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>

                    <form action="create.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label>Title</label>
                            <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Body</label>
                            <textarea name="body"id="body"><?php echo $body ?></textarea>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image" class="text-input">
                        </div>
                        <div>
                            <label>Topic</label>
                            <select name="topic_id" class="text-input">
                                <option value=""></option>
                                
                                <?php foreach ($topics as $key => $topic): ?>
                                    <?php if(!empty($topic_id) && $topic_id == $topic['id']): ?>
                                        <option selected value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </select>
                        </div>              
                        <div>               
                            <?php if(empty($published)): ?>             
                                <input type="checkbox" name="published" id="published">
                            <?php else: ?>
                                <input type="checkbox" name="published" id="published" checked>
                            <?php endif; ?>
                            <label for="published">Publish</label>
                        </div>
                        <div>
                            <button type="submit" name='add-post' class="btn btn-big">Add Post</button>
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