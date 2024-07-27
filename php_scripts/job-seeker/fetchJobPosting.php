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

    $jobPostings = $firestoreService->fetchDataWhere('job_postings');

    foreach($jobPostings as &$jobposting){

        $employers_data = fetchEmployerData($jobposting['posted_by']);

        foreach($employers_data as $key => $value){
            $jobposting[$key] = $value;
        }
    }
    echo json_encode($jobPostings);
}
?>