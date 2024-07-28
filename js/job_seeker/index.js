let temp = true;
let rendered_job_postings = 0;
const number_of_rendered_posts = 5
let arr;

$(function () {
  fetchJobPostings();
});

function fetchAdditionalJobPostings(){
  for (let i = 0; i < number_of_rendered_posts; i++) {
    if(arr[rendered_job_postings]){
      $("#job_posting_container").append(`
      <div class="shadow p-3 mb-5 bg-white rounded job-listing bg-white mt-5" style="height: 500px; overflow: hidden;">
        <div class="col p-3">
          <div class="row">
            <div class="d-flex justify-content-between">
              <div class="col-md-2 ">
                <img src="assets/images/company_logos/${arr[rendered_job_postings]["path"]}" alt="Company Logo" class="img-fluid">
              </div>
              <div>
                <button class="btn btn-primary mx-3 apply_now_btn" value="${arr[rendered_job_postings]["id"]}">Apply Now</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <h2>${arr[rendered_job_postings]["job_title"]}</h2>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-1"><i class="fa-solid fa-building p-2"></i>${arr[rendered_job_postings]["company_name"]}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-1"><i class="fa-solid fa-map-location p-2"></i>${arr[rendered_job_postings]["location"]}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-1"><i class="fa-solid fa-money-bill p-2"></i>${arr[rendered_job_postings]["salary_range"]}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-1"><i class="fa-regular fa-clock p-2"></i>${arr[rendered_job_postings]["type"]}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p><i class="fa-solid fa-house-laptop p-2"></i>${arr[rendered_job_postings]["type1"]}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <h3>Description:</h3>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p style="display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
                overflow: hidden;
                text-overflow: ellipsis;
                height: 4.5em;
                line-height: 1.5em; /* Adjust to match the line height */">${arr[rendered_job_postings]["job_details"]}</p>
            </div>
          </div>
        </div>
      </div>
          `);
    }
    temp = true;
    rendered_job_postings++;
  }
}

function fetchJobPostings() {
  $.ajax({
    url: "php_scripts/job-seeker/fetchJobPosting.php",
    type: "POST",
    dataType: "json",
    success: function (response) {
      arr = response;
      fetchAdditionalJobPostings();
      // rendered_job_postings += number_of_rendered_posts;
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Form submission failed!");
    },
  });
}

$(document).on("click", ".apply_now_btn", function () {
  const jobpost_id = $(this).val();
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
        $("#apply").attr("href", "apply.php?documentid="+response['id']);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Form submission failed!");
    },
  });
}

window.onscroll = function(ev) {
  if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
    if(temp){
      temp = false;
      setTimeout(function(){
        fetchAdditionalJobPostings();
      }, 1000);
    }
  }
};
