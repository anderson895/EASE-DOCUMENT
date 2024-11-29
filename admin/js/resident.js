$(document).ready(function() {


// Handle form submission (Save Promo)
$("#frmAddResident").on("submit", function(e) {
    e.preventDefault(); 
  
    // Show the loading spinner
    $("#loadingSpinner").show();
  
    var formData = new FormData(this); 
  
    formData.append("requestType", 'addResident');  
  
    // Send the form data via AJAX
    $.ajax({
        url: "backend/end-points/controller.php",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',  // Corrected here
        success: function(response) {
            console.log(response['status']);


            if (response['status']) {
                alertify.success("Resident Added successfully!");
                $("#addResidentModal").fadeOut();

                // Delay the reload by 2 seconds (2000 milliseconds)
                setTimeout(function() {
                    location.reload();
                }, 2000);  // Change the value for a longer/shorter delay
            }
        },
        error: function(error) {
            // Hide the loading spinner in case of an error
            $("#loadingSpinner").hide();
            alert("Error adding Error.");
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
   $('#closeModal').click(function() {
       $('#addResidentModal').fadeOut();
   });

   // Search functionality
   $('#searchInput').on('input', function() {
       var value = $(this).val().toLowerCase();
       $('#userTable tbody tr').filter(function() {
           $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
       });
   });
});