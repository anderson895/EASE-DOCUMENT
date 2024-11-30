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