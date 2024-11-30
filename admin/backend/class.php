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








    public function addResident(
        $fname, $mname, $lname, $r_suffix, $Gender, $r_civil_status, $r_bday, 
        $r_contact_number, $region, $r_province, $city, $r_barangay, $r_street, 
        $r_email, $r_password, $profileImgPathDb, $validIdPathDb,$r_longlive
    ) {
        // Hash the password using SHA-256
        $hashedPassword = hash('sha256', $r_password);
    
        // Prepare the SQL statement with placeholders
        $query = "INSERT INTO `resident` 
                  (`r_fname`, `r_mname`, `r_lname`, `r_suffix`, `r_gender`, `r_civil_status`, `r_bday`, 
                   `r_contact_number`, `r_region`, `r_province`, `r_municipality`, `r_barangay`, `r_street`, 
                   `r_email`, `r_password`, `r_profile`, `r_valid_ids`,`r_howlong_living`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        
        // Prepare the statement
        if ($stmt = $this->conn->prepare($query)) {
            // Bind the parameters to the prepared statement
            $stmt->bind_param(
                "ssssssssssssssssss", 
                $fname, $mname, $lname, $r_suffix, $Gender, $r_civil_status, $r_bday, 
                $r_contact_number, $region, $r_province, $city, $r_barangay, $r_street, 
                $r_email, $hashedPassword, $profileImgPathDb, $validIdPathDb,$r_longlive
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