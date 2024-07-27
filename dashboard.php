<?php

session_start();
// if (isset($_SESSION['seeker_has_login'])) {
//   if($_SESSION['seeker_has_login'] == false || $_SESSION['role'] != 'JOB SEEKER'){
//     if($_SESSION['role'] == 'ADMIN'){
//       header('Location: login-admin.php');
//     }
//     else if($_SESSION['role'] == 'EMPLOYER'){
//       header('Location: login-employer.php');
//     }
//     else{
//       header('Location: page-not-found.html');
//     }
//     exit();
//   }
// }
// else{
//   header('Location: login-jobseeker.php');
//   exit();
// }

?>

<!DOCTYPE html>

<html lang="en-us">

<head>
  <meta charset="utf-8" />
  <title>Direct Link</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
  <meta name="description" content="This is meta description" />
  <meta name="author" content="Themefisher" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
  <link rel="icon" href="images/favicon.png" type="image/x-icon" />

  <!-- theme meta -->
  <meta name="theme-name" content="wallet" />

  <!-- # Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet" />

  <!-- # CSS Plugins -->
  <!-- <link rel="stylesheet" href="plugins/slick/slick.css" />
    <link rel="stylesheet" href="plugins/font-awesome/fontawesome.min.css" />
    <link rel="stylesheet" href="plugins/font-awesome/brands.css" />
    <link rel="stylesheet" href="plugins/font-awesome/solid.css" /> -->

  <!-- # Main Style Sheet -->
  <!-- <link rel="stylesheet" href="css/style.css" /> -->
  <link rel="stylesheet" href="css/profile.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- <style>
      body {
        background: linear-gradient(to right, #a8e5b8, #a2d0ea);
      }
    </style> -->
</head>

<body>
  <!-- navigation -->
  <nav style="height: 80px" class="search-button mb-5 d-flex justify-content-between align-items-center bg-primary">
    <div class="d-flex">
      <input type="text" id="search_job" name="search_job" class="form-control form-control-lg" required style="width: 400px" />
      <button class="button1 btn btn-secondary mx-3">Search</button>
      <button class="button2 btn  btn-secondary mx-3" data-toggle="modal" data-target="#searchModal">Search</button>

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
  <div class="container mt-4">
    <div class="row">

      <div class="col-lg-6 col-md-12 mb-sm-5 px-5 border-end border-dark border-2" id="job_posting_container">
        <h2 class="text-center">Job Offers</h2>
        <div class="shadow p-3 mb-5 bg-white rounded job-listing bg-white mt-5">
          <div class="col p-3">
            <div class="row">
              <div class="d-flex justify-content-between">
                <div class="col-md-2 ">
                  <img src="https://shmector.com/_ph/13/188552034.png" alt="Company Logo" class="img-fluid">
                </div>
                <div>
                  <button class="btn btn-primary mx-3" data-toggle="modal" data-target="#jobModal">Apply Now</button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h2>Front End Developer</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p><i class="fa-solid fa-map-location p-2"></i>Ramos, Cebu City</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p><i class="fa-solid fa-building p-2"></i>Engineering - Software (Information & Communication
                  Technology)</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p><i class="fa-solid fa-money-bill p-2"></i>10,000-15,000</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p><i class="fa-regular fa-clock p-2"></i>Full Time</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3>Descriptions:</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex eius harum odit, minima quo culpa, magni
                  maxime exercitationem commodi doloribus nostrum, corporis adipisci recusandae necessitatibus? Mollitia
                  dolor rem dolorum deserunt.</p>
              </div>
            </div>
          </div>
        </div>
        <div class=" mt-5">
          <div class="col job-listing p-3">
            <div class="col-md-2">
              <img src="https://shmector.com/_ph/13/188552034.png" alt="Company Logo" class="img-fluid">
            </div>
            <div class="col-md-8">
              <h3>Front End Developer</h3>
            </div>
            <div class="col-md-4">
              <p>Ramos, Cebu City</p>
            </div>
            <div class="col-md-4">
              <p>10,000-15,000</p>
            </div>
            <div class="col-md-6">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus
                ante dapibus diam.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <h1 class="text-center mb-lg-4">Reports</h1>
        <div class=" m-5" style="background-color: #eee;">content 1</div>
        <div class="row justify-content-around">
          <div class="col-sm-4 col-6 mb-3" style="background-color: #eee; height: 200px;">content 2</div>
          <div class="col-sm-4 col-6 mb-3" style="background-color: #eee; height: 200px;">content 3</div>
        </div>
      </div>
    </div>
  </div>
  <div class="line my-4" style="height: 2px;
      background-color: #333;"></div>

  <!-- Modal -->
  <div class="modal modal-xl fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class="w-100">
                <img src="https://shmector.com/_ph/13/188552034.png" alt="Company Logo" class="img-fluid mb-2"
                  style="max-height: 200px;">
                <h2 class="modal-title text-success mb-3" id="jobModalLabel">Front End Developer</h2>
              </div>
              <p><i class="fa-solid fa-map-location p-2"></i>Ramos, Cebu City</p>
              <p><i class="fa-solid fa-building p-2"></i>Engineering - Software (Information & Communication Technology)
              </p>
              <p><i class="fa-solid fa-money-bill p-2"></i>10,000-15,000</p>
              <p><i class="fa-regular fa-clock p-2"></i>Full Time</p>
              <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt nunc lorem, at
                pharetra nisl scelerisque ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                cubilia curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                egestas.</p>
                <h3 class="text-primary">Basic Requirements:</h3>
                <ul>
                    <div class="list-group-item ">
                      <li><strong>Philippine Statistic Authority</strong></li>  
                      (PSA) Birth Certificate
                      <li><strong>National Bureau of Investigation</strong></li>  
                      (NBI) Clearance
                      <li><strong>Philippine National Pollice</strong></li>  
                      (PNP) Clearance
                    </div>
                </ul>
              <button type="button" class="btn btn-outline-success">Apply Now</button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="add_job_posting_modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-white">
          <h5 class="modal-title" id="exampleModalLabel1">Add Job Posting</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="job_posting_form">
          <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <div class="form-group col mb-3">
                  <label class="form-label" for="job_title">Job Title</label>
                  <input type="text" class="form-control" id="job_title" name="job_title" required />
                </div>
                <div class="form-group col mb-3">
                  <label class="form-label" for="location">Location</label>
                  <input type="text" class="form-control" id="location" name="location" required />
                </div>
                <div class="form-group col mb-3">
                  <label class="form-label" for="type">Type</label>
                  <select class="form-select" name="type" id="type" required>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                  </select>
                </div>
                <div class="form-group col mb-3">
                  <label class="form-label" for="type1">Type1</label>
                  <select class="form-select" name="type1" id="type1" required>
                    <option value="Onsite">Onsite</option>
                    <option value="Remote">Remote</option>
                  </select>
                </div>
                <div class="form-group col mb-3">
                  <label class="form-label" for="salary_range">Salary Range</label>
                  <input type="text" class="form-control" id="salary_range" name="salary_range" required />
                </div>
                <div class="mb-3">
                  <label for="job_details" class="form-label">Job Details</label>
                  <textarea class="form-control" id="job_details" name="job_details" rows="8" required></textarea>
                </div>
                <hr class="my-4" />
                <label for="requirements" class="form-label">Add Requirements</label>
                <div id="newinput"></div>
                <!-- <button id="rowAdder" type="button" class="btn btn-dark">
                        <span class="bi bi-plus-square-dotted">
                        </span> ADD
                    </button> -->
                <div class="d-grid gap-2 mb-3">
                  <button class="btn btn-primary" id="rowAdder" type="button">Add Job Posting</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="add_job_posting_save_btn" class="btn btn-success px-4">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Javascript -->
  <script>
    function navClose() {
      $('#navLinks').addClass('d-none');
    }

    function navOpen() {
      $('#navLinks').addClass('d-none');
    }
  </script>

  <!-- # JS Plugins -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <script src="plugins/slick/slick.min.js"></script>
  <script src="plugins/scrollmenu/scrollmenu.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css "></script>

  <!-- Main Script -->
  <script src="js/script.js"></script>
  <script src="js/register/index.js"></script>
  <script src="js/job_seeker/index.js"></script>

  <!-- validation -->
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>