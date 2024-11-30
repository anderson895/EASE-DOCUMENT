$(document).ready(function() {



$("#frmRequestClearance").on("submit", function(e) {
    e.preventDefault(); 
  
    // Show the loading spinner
    $("#loadingSpinner").show();


    var shippingFee = $("#shippingFee").attr('data-shippingFee');
    var documentPrice = $("#documentPrice").attr('data-documentPrice');
    var totalPrice = $("#totalPrice").attr('data-totalPrice');
    
    var formData = new FormData(this);
    
    // Append specific attributes
    formData.append('shippingFee', shippingFee);
    formData.append('documentPrice', documentPrice);
    formData.append('totalPrice', totalPrice);
  
    formData.append("requestType", 'RequestClearance');  
  
    // Send the form data via AJAX
    $.ajax({
        url: "backend/end-points/controller.php",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',  // Corrected here
        success: function(response) {
            console.log(response);


            if (response['status']) {
                alertify.success("Clearance Added successfully!");
              

                // Delay the reload by 2 seconds (2000 milliseconds)
                setTimeout(function() {
                    location.reload();
                }, 2000);  // Change the value for a longer/shorter delay
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Hide the loading spinner in case of an error
            $("#loadingSpinner").hide();
        
            // Display error message in alert
            alert("Error occurred while adding the resident: " + textStatus);
        
            // Log detailed error information to the console
            console.error("AJAX Error:", textStatus, errorThrown);
            console.error("Response Text:", jqXHR.responseText);
        }
        
    });
});











 // Preview image function
 function previewImage(input, previewElementId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $(`#${previewElementId}`).html(`<img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover rounded-md border">`);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Handle Valid ID preview
$('#validId').on('change', function () {
    previewImage(this, 'validIdPreview');
});

// Handle Proof of Residency preview
$('#proofResidency').on('change', function () {
    previewImage(this, 'proofResidencyPreview');
});




    // Open modal when the button is clicked
    $('#requestClearanceModal').click(function() {
        $('#clearanceModal').fadeIn();
    });

    // Close modal when the Cancel button is clicked
    $('#closeModal').click(function() {
        $('#clearanceModal').fadeOut();
    });










    $('#searchInput').on('input', function() {
        var value = $(this).val().toLowerCase();
        $('#userTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });








});