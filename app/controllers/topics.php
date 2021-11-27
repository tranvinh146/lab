<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateTopic.php");
include(ROOT_PATH . "/app/helpers/permission.php");

$table = 'Topics';

$errors = array();

$id = '';
$name = '';
$description = '';

$topics = selectAll($table);

if(isset($_POST['add-topic'])) {
    adminOnly();

    $errors = validateTopic($_POST);

    if (count($errors) === 0 && preventCSRF($_POST['csrf-token'])) {
        unset($_POST['add-topic'], $_POST['csrf-token']);

        $topic_id = create('Topics', $_POST);
        $_SESSION['message'] = 'Topic created successfully.';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');
    
        exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }    

}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();

    $id = $_GET['del_id'];
    $count = delete($table, $id);

    $_SESSION['message'] = 'Topic is deleted sucessfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/index.php');

    exit();
}

if (isset($_POST['update-topic'])) {
    
    adminOnly();

    $errors = validateTopic($_POST);    

    if (count($errors) === 0 && preventCSRF($_POST['csrf-token'])) {
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id'], $_POST['csrf-token']);
        $topic_id = update($table, $id, $_POST);

        $_SESSION['message'] = 'Topic is updated sucessfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/index.php');

        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }   

}