<?php

session_start();
require("connect.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');

function dd($value) {
    echo "<pre>" . print_r($value, true) . "</pre>";
    die();
}

function executeQuery($sql, $data) {

    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;

}

function selectAll($table, $conditions = []) {
    global $conn;
    $sql = "SELECT * FROM $table";
    if(empty($conditions)) {

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;

    } else {

        $i = 0;
        foreach ($conditions as $key => $value) {

            if($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;

        }
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;

    }
        
}

// SQL injection 


function selectSQLi($table, $email, $password) {
    global $conn;
    $sql = "SELECT * FROM $table WHERE email='" . $email . "and password='" . $password . "' LIMIT 1";
    // SELECT*FRON table WHERE email '' or ''='' #
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}


// Prevent

// function selectPreventSQLi($table, $conditions) {
//     global $conn;
//     $sql = "SELECT * FROM $table";
//     $i = 0;
//     foreach ($conditions as $key => $value) {
//         if($i === 0) {
//             $sql = $sql . " WHERE $key=?";
//         } else {
//             $sql = $sql . " AND $key=?";
//         }
//         $i++;

//     }
//     $sql = $sql . " LIMIT 1";    
//     $stmt = $conn->prepare($sql);
//     $values = array_values($conditions);
//     $types = str_repeat('s', count($values));
//     $stmt->bind_param($types, ...$values);
//     $stmt->execute();
//     $records = $stmt->get_result()->fetch_assoc();
//     return $records;        
// }


function selectOne($table, $conditions) {

    $sql = "SELECT * FROM $table";
    $i = 0;

    foreach ($conditions as $key => $value) {

        if($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;

    }

    $sql = $sql . " LIMIT 1";

    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();

    return $records;
        
}

function create($table, $data) {
    
    $sql = "INSERT INTO $table SET";

    $i = 0;
    foreach ($data as $key => $value) {

        if($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;

    }

    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;

}

function update($table, $id, $data) {
    
    $sql = "UPDATE $table SET";

    $i = 0;
    foreach ($data as $key => $value) {

        if($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;

    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;

}

function delete($table, $id) {
    
    $sql = "DELETE FROM $table WHERE id=?";

    $data = ['id' => $id];
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;

}

function getFullPosts() {
    global $conn;
    $sql = "SELECT p.*, u.username 
            FROM Posts AS p 
            JOIN Users AS u 
            ON p.user_id=u.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPublishedPosts() {

    $sql = "SELECT p.*, u.username 
            FROM Posts AS p 
            JOIN Users AS u 
            ON p.user_id=u.id 
            WHERE p.published = ?";

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPostByTopicId($topic_id) {
    global $conn;
    $sql = "SELECT p.*, u.username 
            FROM Posts AS p 
            JOIN Users AS u 
            ON p.user_id=u.id 
            WHERE p.published = ? AND p.topic_id = ?";

    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term) {

    $match = '%' . $term . '%';
    $sql = "SELECT p.*, u.username 
            FROM Posts AS p 
            JOIN Users AS u 
            ON p.user_id=u.id 
            WHERE p.published = ?
            AND p.title LIKE ? OR p.body LIKE ?";

    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function showComments($post_id) {
    global $conn;
    $sql = "SELECT cmt.*, u.username 
            FROM Comments AS cmt 
            JOIN Users AS u 
            ON cmt.user_id = u.id 
            WHERE cmt.post_id = ?";

    $stmt = executeQuery($sql, ['post_id' => $post_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

?>