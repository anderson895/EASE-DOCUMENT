$(document).ready(function() {
    
   

    
   



    
    $("#frmRequest_Indigency").on("submit", function(e) {
        e.preventDefault(); 
        // Show the loading spinner
        $("#loadingSpinner_Indigency").show();
    
        var shippingFee = $("#shippingFee_Indigency").attr('data-shippingFee');
        var documentPrice = $("#documentPrice_Indigency").attr('data-documentPrice');
        var totalPrice = $("#totalPrice_Indigency").attr('data-totalPrice');
        var formData = new FormData(this);
    
        formData.append('shippingFee', shippingFee);
        formData.append('documentPrice', documentPrice);
        formData.append('totalPrice', totalPrice);
        formData.append("requestType", 'RequestIndigency');  
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
                    alertify.success("Clearance Added successfully!");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
            
        });
    });






    


    $("#frmUpdateAccountSetting").on("submit", function(e) {
        e.preventDefault(); 
        // Show the loading spinner
        $("#loadingSpinner_Indigency").show();
    
        var newPassword =$('#newPassword').val()
        var confirmNewPassword =$('#confirmNewPassword').val()


        if(newPassword){
            if(newPassword!=confirmNewPassword){

                if(!confirmNewPassword){
                    alertify.error('Confirm New password');
                    return;
                }

                alertify.error('Password Not Match');
                return;
            }
        }
      
       
        var formData = new FormData(this);

        formData.append("requestType", 'UpdateAccountSetting');  
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
                    alertify.success("Update successfully!");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
            
        });
    });
    







$("#frmRequest_Residency").on("submit", function(e) {
    e.preventDefault(); 
    // Show the loading spinner
    $("#loadingSpinner_Residency").show();

    var shippingFee = $("#shippingFee_Residency").attr('data-shippingFee');
    var documentPrice = $("#documentPrice_Residency").attr('data-documentPrice');
    var totalPrice = $("#totalPrice_Residency").attr('data-totalPrice');
    var formData = new FormData(this);

    formData.append('shippingFee', shippingFee);
    formData.append('documentPrice', documentPrice);
    formData.append('totalPrice', totalPrice);
    formData.append("requestType", 'RequestResidency');  
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
                alertify.success("Clearance Added successfully!");
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        }
        
    });
});


$("#frmRequestBrgyId").on("submit", function(e) {
    e.preventDefault(); 
    // Show the loading spinner
    $("#loadingSpinner_BrgyId").show();

    var shippingFee = $("#shippingFee_BrgyId").attr('data-shippingFee');
    var documentPrice = $("#documentPrice_BrgyId").attr('data-documentPrice');
    var totalPrice = $("#totalPrice_BrgyId").attr('data-totalPrice');
    var formData = new FormData(this);

    formData.append('shippingFee', shippingFee);
    formData.append('documentPrice', documentPrice);
    formData.append('totalPrice', totalPrice);
    formData.append("requestType", 'RequestBarangayID');  
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
                alertify.success("Clearance Added successfully!");
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        }
        
    });
});






$("#frmRequestClearance").on("submit", function(e) {
    e.preventDefault(); 
    // Show the loading spinner
    $("#loadingSpinner_Clearance").show();

    var shippingFee = $("#shippingFee_Clearance").attr('data-shippingFee');
    var documentPrice = $("#documentPrice_Clearance").attr('data-documentPrice');
    var totalPrice = $("#totalPrice_Clearance").attr('data-totalPrice');
    var formData = new FormData(this);

    formData.append('shippingFee', shippingFee);
    formData.append('documentPrice', documentPrice);
    formData.append('totalPrice', totalPrice);
    formData.append("requestType", 'RequestClearance');  
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
                alertify.success("Clearance Added successfully!");
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
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
$('#validId_Clearance').on('change', function () {
    previewImage(this, 'validIdPreview_Clearance');
});

// Handle Proof of Residency preview
$('#proofResidency_Clearance').on('change', function () {
    previewImage(this, 'proofResidencyPreview_Clearance');
});




$('#1x1pic_BrgyId').on('change', function () {
    previewImage(this, '1x1picPreview_BrgyId');
});

$('#signature_BrgyId').on('change', function () {
    previewImage(this, 'signaturePreview_BrgyId');
});

$('#validId_BrgyId').on('change', function () {
    previewImage(this, 'validIdPreview_BrgyId');
});


$('#proofResidency_BrgyId').on('change', function () {
    previewImage(this, 'proofResidencyPreview_BrgyId');
});



$('#validId_Residency').on('change', function () {
    previewImage(this, 'validIdPreview_Residency');
});



$('#validId_Indigency').on('change', function () {
    previewImage(this, 'validIdPreview_Indigency');
});





    // Open modal when the button is clicked
    $('#OpenClearanceModal').click(function() {
        $('#clearanceModal').fadeIn();
    });

    // Close modal when the Cancel button is clicked
    $('.closeModal').click(function() {
        $('#clearanceModal').fadeOut();
    });




    $('#OpenBrgyIdModal').click(function() {
        $('#BrgyIdModal').fadeIn();
    });

    // Close modal when the Cancel button is clicked
    $('#closeModal').click(function() {
        $('#BrgyIdModal').fadeOut();
    });


    $('#OpenResidencyModal').click(function() {
        $('#residencyModal').fadeIn();
    });

    // Close modal when the Cancel button is clicked
    $('.closeModal').click(function() {
        $('#residencyModal').fadeOut();
    });

    $('#OpenIndigencyModal').click(function() {
        $('#indigencyModal').fadeIn();
    });

    // Close modal when the Cancel button is clicked
    $('.closeModal').click(function() {
        $('#indigencyModal').fadeOut();
    });






    
    


    $('#searchInput').on('input', function() {
        var value = $(this).val().toLowerCase();
        $('#userTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });















});




