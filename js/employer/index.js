
$('#add_job_posting_btn').click(function(){
    $('#add_job_posting_modal').modal('show');
    
})

let count = 0;

$(function(){
    // $(this).scrollTop(0);
    window.scrollTo(0, 0);
    fetchJobPostings();
    fetchuserProfile();
  })
  
  function fetchuserProfile(){
    $.ajax({
      url: "php_scripts/profile/getProfile.php",
      dataType: "json",
      type: "GET",
    }).then(function (data) {
      if(data){
        for (var key in data) {
          if (data.hasOwnProperty(key)) {
              var val = data[key];
              if(key == 'description'){
                $('#'+key).text(val);
              }
              else if(key == 'path'){
                if(val != undefined){
                  $('#profileImage').attr('src', 'assets/images/company_logos/'+val);
                }
              }
              else{
                $('#'+key).val(val);
              }
          }
        }
        if(data['company_name'] == undefined || data['company_name'] == ''){
          $('#name').text(data['name']);
        }
        else{
          $('#name').text(data['company_name']);
        }
      }
    });
  }
  
  $("#company_profile_form").submit(function (e) {
      e.preventDefault();
    });
    
    $("#company_profile_submit_button").click(function () {
      if ($("#company_profile_form").valid()) {
        Swal.fire({
          title: "Do you want to save the changes?",
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: "Save",
          denyButtonText: `Don't save`
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Saving...',
              html: 'Please wait',
              allowEscapeKey: false,
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading()
              }
            });
            var formData = new FormData();
            var fileInput = $('#profile')[0].files[0];
  
            if (fileInput) {
                formData.append('profile', fileInput);
            }
  
            // Serialize the form data and append to the FormData object
            var formSerializedArray = $('#company_profile_form').serializeArray();
            $.each(formSerializedArray, function(index, field) {
                formData.append(field.name, field.value);
            });
            saveProfile(formData);
          } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
          }
        });
        
      }
    });
    
    function saveProfile(formData) {
      // $.ajax({
      //   url: "php_scripts/profile/profile.php",
      //   dataType: "json",
      //   type: "POST",
      //   data: $formData,
      // }).then(function (response) {
        
      // });
  
      $.ajax({
        url: 'php_scripts/employer/profile.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if(response != false){
            window.scrollTo(0, 0);
            swal.close();
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Your work has been saved",
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {
              location.reload();
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Form submission failed!');
        }
    });
  }
  
  $('#profile').change(function(event) {
    var input = event.target;
  
    if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function(e) {
            $('#profileImage').attr('src', e.target.result);
        }
  
        reader.readAsDataURL(input.files[0]);
    }
});


$("#rowAdder").click(function () {
  count ++;
  newRowAdd =
      '<div id="row"> <div class="input-group my-2">' +
      '<input type="text" class="form-control m-input" name="requirement'+count+'" id="requirement'+count+'" required><div class="input-group-prepend">' +
      '<button class="btn btn-danger" id="DeleteRow" type="button">' +
      '<i class="bi bi-trash"></i> X</button> </div>' +
      ' </div> </div>';

  $('#newinput').append(newRowAdd);
});

$("body").on("click", "#DeleteRow", function () {
  $(this).parents("#row").remove();
})

$("#job_posting_form").submit(function (e) {
  e.preventDefault();
});

$("#add_job_posting_save_btn").click(function () {
  if ($("#job_posting_form").valid()) {
    Swal.fire({
      title: "Do you want to add this job posting?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Yes",
      denyButtonText: `No`
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Saving...',
          html: 'Please wait',
          allowEscapeKey: false,
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading()
          }
        });
        var formData = new FormData();
        // var fileInput = $('#profile')[0].files[0];

        // if (fileInput) {
        //     formData.append('profile', fileInput);
        // }

        // Serialize the form data and append to the FormData object
        var formSerializedArray = $('#job_posting_form').serializeArray();
        $.each(formSerializedArray, function(index, field) {
            formData.append(field.name, field.value);
        });

        saveJobPosting(formData)
        console.log($('#job_posting_form').serialize());
      } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
      }
    });
    
  }
});

function saveJobPosting(formData) {
  // $.ajax({
  //   url: "php_scripts/profile/profile.php",
  //   dataType: "json",
  //   type: "POST",
  //   data: $formData,
  // }).then(function (response) {
    
  // });

  $.ajax({
    url: 'php_scripts/employer/add_job_posting.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      if(response != false){
        window.scrollTo(0, 0);
        swal.close();
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Your work has been saved",
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          location.reload();
        });
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        alert('Form submission failed!');
    }
});
}

function fetchJobPostings(){
  $.ajax({
    url: 'php_scripts/employer/fetchJobPostings.php',
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      for(let i=0; i<response.length; i++){
        $('#job_postings').append(`
          <div class="mb-4 btn btn-light shadow" style="background-color: #eee; width: 100%;">
            <div class="d-flex">
              <div class="col p-3" >
                <h3 class="">${response[i]['job_title']}</h3>
                <p>
                  ${response[i]['job_details']}
                </p>
              </div>
            </div>
          </div>
        `);
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        alert('Form submission failed!');
    }
  });
}