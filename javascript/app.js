$(document).ready(function () {

    $("#frmLoginResident").submit(function (e) {
      e.preventDefault();
      $('#spinner').show();
      $('#btnLoginAdminResident').prop('disabled', true);
      var formData = $(this).serializeArray(); 
      formData.push({ name: 'requestType', value: 'LoginResident' });
      var serializedData = $.param(formData);
      // Perform the AJAX request
      $.ajax({
        type: "POST",
        url: "backend/end-points/controller.php",
        data: serializedData,
        // dataType: 'json', // Ensure the response is parsed as JSON
        success: function (response) {
            console.log(response);
    
            if (response.status === "success") {
                alertify.success('Login Successful');
    
                setTimeout(function () {
                  
                        window.location.href = "resident/index.php"; 
                  
                }, 1000);
    
            } else {
                $('#spinner').hide();
                $('#btnLoginAdminResident').prop('disabled', false);
                alertify.error(response.message);
            }
        },
            error: function () {
                $('#spinner').hide();
                $('#btnLoginAdminResident').prop('disabled', false);
                alertify.error('An error occurred. Please try again.');
            }
        });
        
    });













    $("#frmLoginAdmin").submit(function (e) {
        e.preventDefault();
        $('#spinner').show();
        $('#btnLoginAdmin').prop('disabled', true);
        var formData = $(this).serializeArray(); 
        formData.push({ name: 'requestType', value: 'LoginAdmin' });
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
                  $('#btnLoginAdmin').prop('disabled', false);
                  alertify.error(response.message);
              }
          },
              error: function () {
                  $('#spinner').hide();
                  $('#btnLoginAdmin').prop('disabled', false);
                  alertify.error('An error occurred. Please try again.');
              }
          });
          
      });
  
  
  
  
  
  
  
  
  
  });