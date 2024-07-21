<?php

session_start();
// main.php
include 'FirebaseService.php';
include 'FirestoreService.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $firebaseService = new FirebaseService();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $userData = [
        'name' => $_POST['name'],
        'contact_number' => $_POST['contact_number'],
        'role' => $_POST['role'],
    ];

    $uid = $firebaseService->registerUser($email, $password, $userData);

    if ($uid) {
        
        if(str_contains($uid, 'Error')){
            $response = $uid;
            echo json_encode($response);
        }
        else{

            $firestoreService = new FirestoreService();

            if($userData['role'] == 'JOB SEEKER'){
                $collection = 'job_seekers';
            }
            if($userData['role'] == 'EMPLOYER'){
                $collection = 'employers';
            }
            if($userData['role'] == 'ADMIN'){
                $collection = 'admin';
            }

            $documentId = $firestoreService->insertData($collection, $userData, $uid);

            if($documentId){
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        }

    } else {
        echo json_encode(false);
    }
}


?>