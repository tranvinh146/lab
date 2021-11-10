<?php

function validateUser($user) {
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Password do not match');
    }

    $existingUser = selectOne('Users', ['email' => $user['email']]);
    if (isset($existingUser)) {
        if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
            array_push($errors, 'Email already exists!');
        } else if (!isset($user['update-user'])) {
            array_push($errors, 'Email already exists!');
        }
    }

    return $errors;
}

function validateLogin($user) {
    $errors = array();

    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    return $errors;
}

?>