<?php

function validateEmail($email) {
    $errors = array();

    if (empty($email['email'])) {
        array_push($errors, 'Your email is required');
    }

    if (empty($email['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($email['body'])) {
        array_push($errors, 'Body is required');
    }

    return $errors;
}

?>