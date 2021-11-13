<?php

// include(ROOT_PATH . "/app/database/db.php");
// include(ROOT_PATH . "/app/helpers/permission.php");


$table = 'Comments';
$user_id = '';
$date = '';
$content = '';


if(isset($_POST['send-comment'])) {

    if(!empty($_POST['content'])) {

        unset($_POST['send-comment']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['content'] = $_POST['content'];
    
        $comment_id = create($table, $_POST);

        unset($_POST['content']);

    } 
}