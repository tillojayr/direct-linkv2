<?php
session_start();
// main.php
include 'php_scripts/FirestoreService.php';

$firestoreService = new FirestoreService();

$count = 0;
function fetchEmployerData($document_id){

    $firestoreService1 = new FirestoreService();

    $employers_data = $firestoreService1->fetchData('employers', $document_id);

    return $employers_data;

}

function fetchAppliedJobs(){

    $firestoreService1 = new FirestoreService();

    $users_data = $firestoreService1->fetchData('job_seekers', $_SESSION['user_id']);

    return $users_data['applied_jobs'];
}


if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    $documentid = $_GET['documentid'];
    $jobPosting = $firestoreService->fetchData('job_postings', $documentid);

    $employers_data = fetchEmployerData($jobPosting['posted_by']);
    $applied_jobs = fetchAppliedJobs();
    (in_array($documentid, $applied_jobs)) ? $already_applied = true : $already_applied = false;
    foreach($employers_data as $key => $value){
        $jobPosting[$key] = $value;
    }
    $jobPosting['id'] = $documentid;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $jobPosting['job_title'] ?> - <?php echo $jobPosting['company_name'] ?></title>
    <!-- <link rel="shortcut icon" type="image/x-icon" href="pictures/logo.png"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <nav style="height: 80px" class="search-button mb-5 d-flex justify-content-between align-items-center bg-primary">
        <div class="d-flex">
        </div>
        <div class="navbar-links">
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 text-white" style="height: 3rem; width: 3rem">
                <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
                <path fill-rule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10 text-white" style="height: 3rem; width: 3rem">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-white" style="height: 3rem; width: 3rem">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </a>
            <a class="text-white" style="text-decoration: none ;" href="#" id="logout_btn">Logout</a>
        </div>
    </nav>

    <div class="container mb-5">
        <?php if ($already_applied) { echo '<div class="alert alert-warning" role="alert">You already applied to this job post.</div>'; } ?>
        <div class="card p-2">
            <div class="card-body">
                <div class="d-flex">
                    <div class="mx-5">
                      <img src="assets/images/company_logos/<?php echo $jobPosting['path'] ?>" alt="Company Logo" class="img-fluid mb-2"
                        style="max-height: 200px;">
                    </div>
                    <div>
                        <h2 class="modal-title text-success mb-3" id="jobModalLabel"><?php echo $jobPosting['job_title'] ?></h2>
                        <p class="mb-1"><i class="fa-solid fa-map-location p-2"></i><?php echo $jobPosting['location'] ?></p>
                        <p class="mb-1"><i class="fa-solid fa-building p-2"></i><?php echo $jobPosting['company_name'] ?></p>
                        <p class="mb-1"><i class="fa-solid fa-money-bill p-2"></i><?php echo $jobPosting['salary_range'] ?></p>
                        <p class="mb-1"><i class="fa-regular fa-clock p-2"></i><?php echo $jobPosting['type'] ?></p>
                        <p><i class="fa-solid fa-house-laptop p-2"></i><?php echo $jobPosting['type1'] ?></p>
                    </div>
                </div>
                <h3>Description:</h3>
                <p style="text-indent: 50px;"><?php echo $jobPosting['job_details'] ?></p>
                <h3 class="text-primary mb-4">Basic Requirements:</h3>
                <div class="container px-lg-5">
                    <ul class="list-group list-group-flush">
                        <div class="px-lg-5">
                            <?php foreach($jobPosting['requirements'] as $requirement){ ?>
                                <li class="list-group-item mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <input class="form-check-input me-1 file_checkbox" type="checkbox" id="<?php echo $count ?>" value="">
                                            <strong><?php echo $requirement ?></strong>
                                        </div>
                                        <div class="file-input-container">
                                            <input class="form-control w-100" data-index="<?php echo $count ?>" type="file" id="file_input_<?php echo $count ?>" disabled>
                                        </div>
                                    </div>
                                </li>
                            <?php $count++; ?>
                            <?php } ?>
                        </div>
                    </ul>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-success" id="submit_application_button" value="<?php echo $documentid ?>" <?php if ($already_applied) { echo 'disabled'; } ?>>Submit Application</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/job_seeker/apply.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>