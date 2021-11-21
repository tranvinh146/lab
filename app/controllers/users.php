<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");
include(ROOT_PATH . "/app/helpers/permission.php");

$errors = array();

$username = '';
$id = '';
$email = '';
$password = '';
$admin = '';
$table = 'Users';

$admin_users = selectAll($table, ['admin' => 1]);

$users = selectAll($table);

function loginUser($user) {
    $_SESSION['key'] = bin2hex(random_bytes(32));
    $_SESSION['value'] = hash_hmac('sha256', md5(rand()) ,$_SESSION['key']);
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';

    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . '/admin/dashboard.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit() ;
}

if(isset($_POST['register-btn'])) {
    
    $errors = validateUser($_POST);

    if(count($errors) === 0) {

        unset($_POST['register-btn'], $_POST['passwordConf']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_id = create($table, $_POST);
        $user = selectOne($table, ['id' => $user_id]);
        loginUser($user);      
    
    } else {            
        $username = $_POST['username'];
        $email = $_POST['email'];
    }

}

if(isset($_POST['create-admin'])) {    
    adminOnly();
    $errors = validateUser($_POST);
    if(count($errors) === 0) {
        unset($_POST['csrf-token'], $_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);        
        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $user_id = create($table, $_POST);
        $_SESSION['message'] = 'Admin user created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php');               
    
    } else {            
        $username = $_POST['username'];
        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
    }

}

if (isset($_POST['update-user'])) {

    adminOnly();
    $errors = validateUser($_POST);

    if(count($errors) === 0 && preventCSRF($_POST['csrf-token'])) {
        $id = $_POST['id'];
        unset($_POST['csrf-token'], $_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
        $count = update($table, $id, $_POST);
        $_SESSION['message'] = 'Admin user updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
            
    } else {            
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $admin = isset($_POST['admin']) ? 1 : 0;
    }

}

if(isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);

    $id = $user['id'];
    $username = $user['username'];
    $email = $user['email'];
    $admin = $user['admin'];
}


// LOGIN
if(isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if(count($errors) === 0) {

        unset($_POST['login-btn']);
        $user = selectOne($table, ['email' => $_POST['email']]);
        
        // $user = selectSQLi('Users',$_POST['email']); #sql injection
        // $user = selectPreventSQLi('Users',$_POST['email']); #prevent sql injection

        if($user && password_verify($_POST['password'], $user['password'])) {          
           loginUser($user);
        } else {
            array_push($errors, 'Wrong credentials!');
        }  
    
    }         

    $email = $_POST['email'];
    $password = $_POST['password'];

}

if (isset($_GET['del_id'])) {
    adminOnly();
    if(preventCSRF($_GET['csrf-token'])) {
        $count = delete($table, $_GET['del_id']);

        $_SESSION['message'] = 'Admin user deleted';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
    }    
}

?>