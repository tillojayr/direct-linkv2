<?php

session_start();
// main.php
include '../FirestoreService.php';

$firestoreService = new FirestoreService();

function fetchJobPosting($document_id){

    $firestoreService1 = new FirestoreService();

    $employers_data = $firestoreService1->fetchData('job_postings', $document_id);

    return $employers_data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $job_postings = $firestoreService->fetchData('employers', $_SESSION['user_id']);

    // var_dump($job_postings['posted_jobs']);
    $data = array();
    foreach($job_postings['posted_jobs'] as $posting){
        $result = fetchJobPosting($posting);
        foreach($job_postings as $key => $value){
            $result[$key] = $value;
        }
        $data[] = $result;
    }

    echo json_encode($data);
}
?>