$(function(){

})

$(document).on('change', '.file_checkbox', function(){
    let id = $(this).attr('id');
    $('#file_input_' + id).prop('disabled', !this.checked);
})

$('#submit_application_button').click(function(){

    Swal.fire({
        title: "Are you sure?",
        text: "Submit application?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then((result) => {
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
            
            const jobpostingDocumentID = $(this).val();
            let count = 0;
            var formData = new FormData();
            $('.file-input-container input[type="file"]').each(function() {
                const index = $(this).data('index');
                var fileInput = $(this)[0].files[0];
        
                if (fileInput) {
                    formData.append('file'+index, fileInput);
                }
                count++;
            });
            formData.append('jobpostingDocumentID', jobpostingDocumentID);
            submitApplication(formData);
        }
      });
})

function submitApplication(formData){
    $.ajax({
        url: 'php_scripts/job-seeker/submitApplication.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if(response != false){
            swal.close();
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Application submitted successfully!",
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