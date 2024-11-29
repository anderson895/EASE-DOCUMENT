$(document).ready(function () {

    $("#frmLogin").submit(function (e) {
      e.preventDefault();
      
  
      $('#spinner').show();
      $('#btnLogin').prop('disabled', true);
      
      var formData = $(this).serializeArray(); 
      formData.push({ name: 'requestType', value: 'Login' });
      var serializedData = $.param(formData);
  
      // Perform the AJAX request
      $.ajax({
        type: "POST",
        url: "backend/end-points/controller.php",
        data: serializedData,
        dataType: 'json', // Ensure the response is parsed as JSON
        success: function (response) {
            console.log(response);
    
            if (response.status === "success") {
                alertify.success('Login Successful');
    
                setTimeout(function () {
                    // Check user type for redirection
                    if (response.user.user_type === "admin") {
                        window.location.href = "admin/index.php"; // Redirect to admin
                    }
                }, 1000);
    
            } else {
                $('#spinner').hide();
                $('#btnLogin').prop('disabled', false);
                alertify.error(response.message);
            }
        },
        error: function () {
            $('#spinner').hide();
            $('#btnLogin').prop('disabled', false);
            alertify.error('An error occurred. Please try again.');
        }
    });
    
});
  
  
  
  
  
  
  
  
  
  });