 // Show the modal with fade-in effect
 $('.deleteResidentButton').click(function() {
    const residentId = $(this).data('r_id');
    console.log(residentId);

    $('#TargetdelResidentId').val(residentId);
    $('#deleteConfirmationModal').fadeIn(); // Show modal
});

// Close the modal
$('.cancelDeleteResident').click(function() {
    console.log('Close Modal');
    $('#deleteConfirmationModal').fadeOut(); // Hide modal
});

// Handle the confirm delete button click (not form submission)
$('#confirmDeleteResident').click(function() {
    // Show the loading spinner
    $("#DeleteResidentloadingSpinner").show();

    // Disable the button to prevent multiple clicks
    $(this).prop('disabled', true);

    // Get the resident ID from the input
    const residentId = $('#TargetdelResidentId').val();

    // Prepare data to send to the server
    const formData = new FormData();
    formData.append("requestType", 'DeleteResident');
    formData.append("residentId", residentId);

    $.ajax({
        url: "backend/end-points/controller.php",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            console.log(response);

            if (response.status) {
                alertify.success("Resident Deleted successfully!");
                setTimeout(function() {
                    location.reload(); // Reload page after success
                }, 2000);
            } else {
                alertify.error(response.message || "Failed to delete resident. Please try again.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            alertify.error("An error occurred while processing your request. Please try again.");
        },
        complete: function() {
            // Hide the loading spinner and re-enable the button
            $("#DeleteResidentloadingSpinner").hide();
            $('#confirmDeleteResident').prop('disabled', false);
        }
    });

    // Close the modal after initiating the request
    $('#deleteConfirmationModal').fadeOut();
});





$(document).ready(function() {




$("#frmAddResident").on("submit", function(e) {
    e.preventDefault(); 
    $("#loadingSpinner").show();
    var formData = new FormData(this); 
  
    formData.append("requestType", 'addResident');  
  
    $.ajax({
        url: "backend/end-points/controller.php",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json', 
        success: function(response) {
            console.log(response['status']);


            if (response['status']) {
                alertify.success("Resident Added successfully!");
              

                setTimeout(function() {
                    location.reload();
                }, 2000);  
            }
        }
        
    });
});






$("#frmEditResident").on("submit", function(e) {
    e.preventDefault(); 
    $("#editResidentloadingSpinner").show();
    var formData = new FormData(this); 
  
    formData.append("requestType", 'EditResident');  
  
    $.ajax({
        url: "backend/end-points/controller.php",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json', 
        success: function(response) {
            console.log(response);


            if (response['status']) {
                alertify.success("Resident Update successfully!");
              

                setTimeout(function() {
                    location.reload();
                }, 2000);  
            }
        }
        
    });
});























    // For Profile Image
$('#profileImg').on('change', function(event) {
   const file = event.target.files[0];
   const reader = new FileReader();
   
   reader.onload = function(e) {
       // Display the uploaded image in the preview area
       $('#profileImgPreview').html('<img src="' + e.target.result + '" class="max-w-full h-auto rounded-md" alt="Profile Image">');
   };
   
   if (file) {
       reader.readAsDataURL(file);
   }
});


// For Valid ID
$('#validId').on('change', function(event) {
   const file = event.target.files[0];
   const reader = new FileReader();
   
   reader.onload = function(e) {
       // Display the uploaded image in the preview area
       $('#validIdPreview').html('<img src="' + e.target.result + '" class="max-w-full h-auto rounded-md" alt="Valid ID Image">');
   };
   
   if (file) {
       reader.readAsDataURL(file);
   }
});












   // Show the modal with fade-in effect
   $('#addResidentButton').click(function() {
       $('#addResidentModal').fadeIn();
   });

   // Close the modal
   $('.addResidentCloseModal').click(function() {
       $('#addResidentModal').fadeOut();
   });


   $('.editResidentButton').click(function() {
    // Kunin ang lahat ng data attributes
    $('#r_id').val($(this).data('r_id'));
    $('#r_fname').val($(this).data('r_fname'));
    $('#r_mname').val($(this).data('r_mname'));
    $('#r_lname').val($(this).data('r_lname'));
    $('#r_suffix').val($(this).data('r_suffix'));
    $('#r_gender').val($(this).data('r_gender'));
    $('#r_civil_status').val($(this).data('r_civil_status'));
    $('#r_citizenship').val($(this).data('r_citizenship'));
    $('#r_bday').val($(this).data('r_bday'));
    $('#r_street').val($(this).data('r_street'));
    $('#r_region').val($(this).data('r_region'));
    $('#r_province').val($(this).data('r_province'));
    $('#r_municipality').val($(this).data('r_municipality'));
    $('#r_barangay').val($(this).data('r_barangay'));
    $('#r_contact_number').val($(this).data('r_contact_number'));
    $('#r_street').val($(this).data('r_street'));
    $('#r_email').val($(this).data('r_email'));
    $('#r_howlong_living').val($(this).data('r_howlong_living'));


     // Set current profile image in the preview
     const profileImage = $(this).data('r_profile');
     if (profileImage) {
         $('#r_profilePreview').html(`<img src="${profileImage}" class="max-w-full h-auto rounded-md" alt="Current Profile Image">`);
     } else {
         $('#r_profilePreview').html('<p class="text-gray-500">No profile image available</p>');
     }
 
     // Set current valid ID in the preview
     const validIdImage = $(this).data('r_valid_ids');
     if (validIdImage) {
         $('#r_valid_idsPreview').html(`<img src="${validIdImage}" class="max-w-full h-auto rounded-md" alt="Current Valid ID Image">`);
     } else {
         $('#r_valid_idsPreview').html('<p class="text-gray-500">No valid ID available</p>');
     }

    // Ipakita ang modal
    $('#editResidentModal').fadeIn();
});

// Close the modal
$('#EditcloseResidentModal').click(function() {
    $('#editResidentModal').fadeOut();
});

// For Profile Image Preview
$('#r_profile').on('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        // Display the uploaded image in the preview area
        $('#r_profilePreview').html('<img src="' + e.target.result + '" class="max-w-full h-auto rounded-md" alt="Profile Image">');
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});

// For Valid ID Preview
$('#r_valid_ids').on('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        // Display the uploaded image in the preview area
        $('#r_valid_idsPreview').html('<img src="' + e.target.result + '" class="max-w-full h-auto rounded-md" alt="Valid ID Image">');
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});










   // Search functionality
   $('#searchInput').on('input', function() {
       var value = $(this).val().toLowerCase();
       $('#userTable tbody tr').filter(function() {
           $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
       });
   });
});