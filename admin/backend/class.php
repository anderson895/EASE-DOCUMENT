<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');
$getDateToday = date('Y-m-d H:i:s'); 


class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }



    public function updateOrderStatus($orderId, $newStatus) {
        // Use a parameterized query to prevent SQL injection
        $stmt = $this->conn->prepare("UPDATE `centralize_request` SET `cr_status` = ? WHERE `cr_id` = ?");
        
        // Bind the parameters to the query
        $stmt->bind_param("si", $newStatus, $orderId); // "si" means string and integer
        
        // Execute the query and return the result
        return $stmt->execute();
    }


    public function totalRequestbarangayID() {
        // Use a parameterized query to prevent SQL injection
        $stmt = $this->conn->prepare("
            SELECT 
                cr_formtype,
                COUNT(*) AS total
            FROM 
                centralize_request
            WHERE
                cr_formtype IN ('Barangay ID', 'Barangay Clearance', 'Barangay Residency', 'Barangay Indigency')
            GROUP BY 
                cr_formtype
        ");
      
        // Execute the query
        if ($stmt->execute()) {
            // Fetch the results
            $result = $stmt->get_result();
    
            // Format the results into an associative array
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[$row['cr_formtype']] = (int)$row['total'];
            }
    
            // Return the formatted data
            return $data;
        } else {
            // Handle errors (e.g., log them or throw an exception)
            return false;
        }
    }
    





    public function viewOrderDetails($cr_id)
    {
        // Prepare the query with sorting by order_date in descending order
        $query = "SELECT * FROM centralize_request
                  LEFT JOIN resident ON resident.r_id = centralize_request.cr_r_id
                  where cr_id = '$cr_id'
                  ORDER BY centralize_request.cr_request_date DESC
                  "; 
    
        $result = $this->conn->query($query);
        
        // Check if the query was successful
        if ($result === false) {
            // Log or handle the error
            error_log("Query execution failed: " . $this->conn->error);
            return false;
        }
    
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Fetch the results and return them as an associative array
            $order = [];
            while ($row = $result->fetch_assoc()) {
                $order[] = $row;
            }
            return $order;
        } else {
            return false;
        }
    }





    public function GetAllOrders()
    {
        // Prepare the query with sorting by order_date in descending order
        $query = "SELECT * FROM centralize_request
                  LEFT JOIN resident ON resident.r_id = centralize_request.cr_r_id
                  ORDER BY centralize_request.cr_request_date DESC"; 
    
        $result = $this->conn->query($query);
        
        // Check if the query was successful
        if ($result === false) {
            // Log or handle the error
            error_log("Query execution failed: " . $this->conn->error);
            return false;
        }
    
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Fetch the results and return them as an associative array
            $order = [];
            while ($row = $result->fetch_assoc()) {
                $order[] = $row;
            }
            return $order;
        } else {
            return false;
        }
    }



    public function updateResident(
        $r_id, $fname, $mname, $lname, $r_suffix, $r_gender, $r_civil_status, 
        $r_bday, $r_contact_number, $regionId, $provinceId, $cityId, $barangayId, 
        $r_street, $r_email, $newPassword, $profileImgPathDb, $IdImgPathDb
    ) {
        // Start building the query
        $query = "UPDATE `resident` SET 
            `r_fname` = '$fname', `r_mname` = '$mname', `r_lname` = '$lname', `r_suffix` = '$r_suffix', 
            `r_gender` = '$r_gender', `r_civil_status` = '$r_civil_status', `r_bday` = '$r_bday', 
            `r_contact_number` = '$r_contact_number', `r_region` = '$regionId', `r_province` = '$provinceId', 
            `r_municipality` = '$cityId', `r_barangay` = '$barangayId', `r_street` = '$r_street', 
            `r_email` = '$r_email'";
    
        // If a new password is provided, update `r_password`
        if (!empty($newPassword)) {
            $hashedPassword = hash('sha256', $newPassword); // Hash password using SHA-256
            $query .= ", `r_password` = '$hashedPassword'";
        }
    
        // If a profile image is provided, update `r_profile`
        if (!empty($profileImgPathDb)) {
            $query .= ", `r_profile` = '$profileImgPathDb'";
        }

         // If a profile image is provided, update `r_profile`
         if (!empty($IdImgPathDb)) {
            $query .= ", `r_valid_ids` = '$IdImgPathDb'";
        }
    
        // Add the WHERE clause with the resident ID
        $query .= " WHERE `r_id` = '$r_id'";
    
        // Execute the query
        $result = $this->conn->query($query);
    
        // Check if the update was successful
        if ($result) {
            return "Resident updated successfully.";
        } else {
            return "Error executing the query: " . $this->conn->error;
        }
    }
    

    public function DeleteResident($residentId) {
        // Prepare the query
        $query = "UPDATE `resident` SET `r_status` = '0' WHERE `r_id` = ?";
        
        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Bind parameters
            $stmt->bind_param("i", $residentId);
            
            // Execute the statement
            if ($stmt->execute()) {
                return "Resident removed successfully.";
            } else {
                return "Error executing the query: " . $stmt->error;
            }
        } else {
            return "Error preparing the query: " . $this->conn->error;
        }
    }
    
    
    
    
    public function check_resident($user_id ) {

        $query = "SELECT * FROM resident WHERE r_id = $user_id";
    
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }

    


public function check_account($user_id ) {

        $query = "SELECT * FROM user WHERE user_id = $user_id";
    
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }


public function fetch_all_resident() {

        $query = "SELECT * FROM resident WHERE r_status = '1'";
    
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }




    public function UpdateAdminInfo($user_fname, $user_mname, $user_lname, $email, $user_id){
        // Prepare the SQL statement with placeholders
        $query = "UPDATE `user` SET `user_fname`=?, `user_mname`=?, `user_lname`=?, `user_email`=? WHERE `user_id`=?";
        
        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Bind the parameters to the query
            $stmt->bind_param("ssssi", $user_fname, $user_mname, $user_lname, $email, $user_id);
            
            // Execute the statement
            if ($stmt->execute()) {
                // Success, return true or some success message
                return "Admin info updated successfully.";
            } else {
                // If execution fails, return error message
                return "Error executing the statement: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            // Return an error message if preparation fails
            return "Error preparing the statement: " . $this->conn->error;
        }
    }
    































    
    public function UpdateAdminPassword($current_password, $new_password, $user_id){
        // Get the current password from the database
        $query = "SELECT `user_password` FROM `user` WHERE `user_id`=?";
        
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->store_result();
            
            // Check if user exists
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($stored_password);
                $stmt->fetch();
                
                // Verify current password
                if (hash('sha256', $current_password) === $stored_password) {
                    // Hash and update new password
                    $new_password_hash = hash('sha256', $new_password);
                    $update_query = "UPDATE `user` SET `user_password`=? WHERE `user_id`=?";
                    
                    if ($update_stmt = $this->conn->prepare($update_query)) {
                        $update_stmt->bind_param("si", $new_password_hash, $user_id);
                        $update_stmt->execute();
                        $update_stmt->close();
                        return "Password updated successfully.";
                    } else {
                        return "Error updating password.";
                    }
                } else {
                    return "Current password is incorrect.";
                }
            } else {
                return "User not found.";
            }
            $stmt->close();
        } else {
            return "Error preparing the statement.";
        }
    }
    
    
    public function addResident(
        $fname, $mname, $lname, $r_suffix, $Gender, $r_civil_status, $r_bday, 
        $r_contact_number, $region, $r_province, $city, $r_barangay, $r_street, 
        $r_email, $r_password, $profileImgPathDb, $validIdPathDb
    ) {
        // Hash the password using SHA-256
        $hashedPassword = hash('sha256', $r_password);
    
        // Prepare the SQL statement with placeholders
        $query = "INSERT INTO `resident` 
                  (`r_fname`, `r_mname`, `r_lname`, `r_suffix`, `r_gender`, `r_civil_status`, `r_bday`, 
                   `r_contact_number`, `r_region`, `r_province`, `r_municipality`, `r_barangay`, `r_street`, 
                   `r_email`, `r_password`, `r_profile`, `r_valid_ids`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Bind the parameters to the prepared statement
            $stmt->bind_param(
                "sssssssssssssssss", 
                $fname, $mname, $lname, $r_suffix, $Gender, $r_civil_status, $r_bday, 
                $r_contact_number, $region, $r_province, $city, $r_barangay, $r_street, 
                $r_email, $hashedPassword, $profileImgPathDb, $validIdPathDb
            );
        
            // Execute the statement
            if ($stmt->execute()) {
                // Return success or the ID of the inserted resident
                return "Resident added successfully.";
            } else {
                // Return an error message if something goes wrong
                return "Error: " . $stmt->error;
            }
        
            // Close the statement
            $stmt->close();
        } else {
            // Return an error message if preparation fails
            return "Error preparing the statement: " . $this->conn->error;
        }
    }
    
    
    



}




?>