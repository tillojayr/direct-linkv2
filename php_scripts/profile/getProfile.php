<?php

session_start();
// main.php
include '../FirestoreService.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $FirestoreService = new FirestoreService();

    $table = $_SESSION['role_collection'];
    $key = $_SESSION['user_id'];
    
    $user_datas = $FirestoreService->fetchData($table, $key);

    echo json_encode($user_datas);
}

?>