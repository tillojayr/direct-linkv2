$(function () {
  fetchJobPostings();
});

function fetchJobPostings() {
  $.ajax({
    url: "php_scripts/job-seeker/fetchJobPosting.php",
    type: "POST",
    dataType: "json",
    success: function (response) {
      for (let i = 0; i < response.length; i++) {
        $("#job_posting_container").append(`
        <div class="shadow p-3 mb-5 bg-white rounded job-listing bg-white mt-5">
          <div class="col p-3">
            <div class="row">
              <div class="d-flex justify-content-between">
                <div class="col-md-2 ">
                  <img src="assets/images/company_logos/${response[i]["path"]}" alt="Company Logo" class="img-fluid">
                </div>
                <div>
                  <button class="btn btn-primary mx-3 apply_now_btn" value="${response[i]["id"]}">Apply Now</button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h2>${response[i]["job_title"]}</h2>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-1"><i class="fa-solid fa-building p-2"></i>${response[i]["company_name"]}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-1"><i class="fa-solid fa-map-location p-2"></i>${response[i]["location"]}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-1"><i class="fa-solid fa-money-bill p-2"></i>${response[i]["salary_range"]}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="mb-1"><i class="fa-regular fa-clock p-2"></i>${response[i]["type"]}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p><i class="fa-solid fa-house-laptop p-2"></i>${response[i]["type1"]}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h3>Descriptions:</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p>${response[i]["job_details"]}</p>
              </div>
            </div>
          </div>
        </div>
            `);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Form submission failed!");
    },
  });
}

$(document).on("click", ".apply_now_btn", function () {
  const jobpost_id = $(this).val();
  console.log(jobpost_id);
  $("#view_job_posting_modal").modal("show");
  fetchJobPost(jobpost_id);
});

function fetchJobPost(jobpost_id) {
  $.ajax({
    url: "php_scripts/job-seeker/fetchJobPost.php",
    type: "POST",
    data: {jobpost_id: jobpost_id},
    dataType: "json",
    success: function (response) {
        console.log(response);
        for (var key in response) {
            if (response.hasOwnProperty(key)) {
                var val = response[key];
                if(key == 'path'){
                  if(val != undefined){
                    $('#company_logo').attr('src', 'assets/images/company_logos/'+val);
                  }
                }
                else{
                  $('#'+key).text(val);
                }
            }
        }
        const requirements = response['requirements'];
        $('#basic_requirements').empty()
        for (let i = 0; i < requirements.length; i++) {
            $('#basic_requirements').append(`
                <li><strong>${requirements[i]}</strong></li>  
            `);
        }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Form submission failed!");
    },
  });
}
