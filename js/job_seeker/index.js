$(function(){
    fetchJobPostings();
})

function fetchJobPostings(){
    $.ajax({
        url: 'php_scripts/job-seeker/fetchJobPosting.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            for(let i=0; i < response.length; i++){
                $('#job_posting_container').append(`
                  <div class="mb-4" style="background-color: #eee;">
                  <div class="d-flex">
                    <div class="col-3 p-3" style="object-fit:cover;">
                      <img height="100" width="100"  src="assets/images/company_logos/${response[i]['path']}" alt="">
                      <!-- <div style="background-color: #000000; "></div> -->
                    </div>
                    <div class="col-9 p-3" >
                      <h3 class="text-center"  style="background-color: blue; ">${response[i]['job_title']}</h3>
                      <p style="background-color: red; ">
                      ${response[i]['job_details']}
                      </p>
                    </div>
                  </div>
                </div>
              `)
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Form submission failed!');
        }
    });
}