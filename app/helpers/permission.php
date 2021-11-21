<?php

function preventCSRF($token) {
    if (hash_equals($_SESSION['value'],$token)) {
        return true;
    }
    return false;
}

function userOnly() {
    if (empty($_SESSION['key'])) {
        $_SESSION['message'] = 'You need to login first';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . '/index.php');
        exit(0);
    }
}

function adminOnly() {
    if (empty($_SESSION['key']) || empty($_SESSION['admin'])) {
        $_SESSION['message'] = 'You are not authorized!';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . '/index.php');
        exit(0);
    }
}

function guestOnly() {
    if (isset($_SESSION['id'])) {
        header('location: ' . BASE_URL . '/index.php');
        exit(0);
    }
}