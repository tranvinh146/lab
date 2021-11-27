<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateEmail.php");
include(ROOT_PATH . "/app/helpers/permission.php");

$errors = array();

$table = 'Emails';
$emails = selectAll($table);

$id = '';
$from_email = '';
$title = '';
$body = '';

if(isset($_POST['send-email'])) {

    $errors = validateEmail($_POST);

    if(count($errors) === 0) {
        unset($_POST['send-email']);
        $_POST['body'] = htmlentities($_POST['body']);
    
        $email_id = create($table, $_POST);
        $_SESSION['message'] = 'Your email sent successfully';
        $_SESSION['type'] = 'success';
        header("location: " . BASE_URL . "/index.php");
    } else {
        $from_email = $_POST['email'];
        $title = $_POST['title'];
        $body = $_POST['body'];
    }

}

if (isset($_GET['id'])) {
    adminOnly();
    $email = selectOne($table, ['id' => $_GET['id']]);
    
    $id = $email['id'];
    $from_email = $email['email'];
    $title = $email['title'];
    $body = $email['body'];

}

if(isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);

    $_SESSION['message'] = "Email deleted successfully";
    $_SESSION['type'] = 'success';
    header("location: " . BASE_URL . "/admin/emails/index.php");
}
