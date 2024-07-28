<?php

date_default_timezone_set("Asia/Manila");
session_start();

include '../FirestoreService.php';

$firestoreService = new FirestoreService();

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getIndex($input){
    $substring = "file";

    $position = strpos($input, $substring);

    if ($position !== false) {
        $start = $position + strlen($substring);

        $result = substr($input, $start);

        return $result;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file_paths = [];
    $job_posting_id = $_POST['jobpostingDocumentID'];
    foreach($_FILES as $key=>$value){
        if (isset($_FILES[$key]) && $_FILES[$key]['error'] == UPLOAD_ERR_OK) {
            $uploadDir = '../../assets/files/application_requirements/'; 
            $file_name = generateRandomString(10) . basename($_FILES[$key]['name']);
            $uploadFile = $uploadDir . $file_name;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($_FILES[$key]['tmp_name'], $uploadFile)) {
                $index = getIndex($key);
                $file_paths[$index] = $file_name;
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }
        }
    }

    // var_dump($file_paths);
    // exit(0);

    $datas['job_seeker_id'] = $_SESSION['user_id'];
    $datas['job_posting_id'] = $job_posting_id;
    $datas['applied_date'] = date("Y-m-d h:i:sa");
    $datas['status'] = 'PENDING';
    $datas['files'] = $file_paths;

    $collection = 'applications';

    $documentId = $firestoreService->insertData($collection, $datas);

    $firestoreService->addValueToArrayField('job_seekers', 'applied_jobs', $_SESSION['user_id'], [$job_posting_id]);
    echo json_encode($documentId);

} else {
    echo "Invalid request method.\n";
}

?>