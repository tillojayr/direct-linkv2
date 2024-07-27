<?php

session_start();
// main.php
include '../FirestoreService.php';

$firestoreService = new FirestoreService();

function fetchEmployerData($document_id){

    $firestoreService1 = new FirestoreService();

    $employers_data = $firestoreService1->fetchData('employers', $document_id);

    return $employers_data;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $jobpost_id = $_POST['jobpost_id'];
    $jobPosting = $firestoreService->fetchData('job_postings', $jobpost_id);

    $employers_data = fetchEmployerData($jobPosting['posted_by']);
    foreach($employers_data as $key => $value){
        $jobPosting[$key] = $value;
    }
    echo json_encode($jobPosting);
}
?>