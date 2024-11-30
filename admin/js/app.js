$(document).ready(function() {


    $("#frmUpdateInfo").on("submit", function(e) {
        e.preventDefault(); 
        $("#loadingSpinner").show();
        var formData = new FormData(this); 
      
        formData.append("requestType", 'UpdateAdminInfo');  
      
        $.ajax({
            url: "backend/end-points/controller.php",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', 
            success: function(response) {
                console.log(response);
    
    
                    alertify.success("Update successfully!");
                  
    
                    setTimeout(function() {
                        location.reload();
                    }, 1000);  
                
            }
            
        });
    });
    




















    $("#frmUpdatePassword").on("submit", function(e) {
        e.preventDefault(); 
    
        var new_password = $("#new_password").val(); // Get the new password value
        var confirm_password = $("#confirm_password").val(); // Get the confirm password value
        
        // Check if passwords match
        if (new_password !== confirm_password) {
            alertify.error("Passwords do not match.");
            return; // Stop form submission if passwords don't match
        }
    
        $("#loadingSpinner").show();
        var formData = new FormData(this); 
        formData.append("requestType", 'UpdatePassword');  
    
        $.ajax({
            url: "backend/end-points/controller.php",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', 
            success: function(response) {
                console.log(response);
        
                if(response['status'] == "200"){
                    alertify.success("Updated successfully!");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);  
                } else {
                    alertify.error(response['message']);
                }
            }
        });
    });
    
    
    
    
    });