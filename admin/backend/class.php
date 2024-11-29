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