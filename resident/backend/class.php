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


    public function updateResident(
        $r_id, $fname, $mname, $lname, $r_suffix, $r_gender, $r_civil_status, 
        $r_bday, $r_contact_number, $region, $province, $city, $barangay, 
        $r_street, $r_email, $newPassword, $profileImgName
    ) {
        // Initialize query string
        $query = "UPDATE `resident` 
                  SET `r_fname` = ?, `r_mname` = ?, `r_lname` = ?, `r_suffix` = ?, `r_gender` = ?, 
                      `r_civil_status` = ?, `r_bday` = ?, `r_contact_number` = ?, `r_region` = ?, 
                      `r_province` = ?, `r_municipality` = ?, `r_barangay` = ?, `r_street` = ?, 
                      `r_email` = ?";
    
        // If a new password is provided, add `r_password` to the query
        if (!empty($newPassword)) {
            $query .= ", `r_password` = ?";
        }
    
        // If a profile image is provided, add `r_profile` to the query
        if (!empty($profileImgName)) {
            $query .= ", `r_profile` = ?";
        }
    
        // Add the WHERE clause
        $query .= " WHERE `r_id` = ?";
    
        // Prepare the query using the connection object
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            // Default bind types for 14 parameters
            $bindTypes = "ssssssssssssss";
            $params = [
                $fname, $mname, $lname, $r_suffix, $r_gender, $r_civil_status, $r_bday, 
                $r_contact_number, $region, $province, $city, $barangay, $r_street, $r_email
            ];
    
            // If a new password is provided, hash it with SHA-256 and include it in the parameters
            if (!empty($newPassword)) {
                $hashedPassword = hash('sha256', $newPassword); // Hash password using SHA-256
                $bindTypes .= "s"; // Add string for the password
                $params[] = $hashedPassword; // Add the hashed password to the parameters
            }
    
            // If a profile image is provided, include it in the parameters
            if (!empty($profileImgName)) {
                $bindTypes .= "s"; // Add string for the profile image
                $params[] = $profileImgName; // Add the profile image filename to the parameters
            }
    
            // Add the resident ID as the last parameter
            $bindTypes .= "i"; // r_id is an integer
            $params[] = $r_id;
    
            // Bind parameters
            $stmt->bind_param($bindTypes, ...$params);
    
            // Execute the statement
            if ($stmt->execute()) {
                return "Resident updated successfully.";
            } else {
                return "Error executing the query: " . $stmt->error;
            }
        } else {
            return "Error preparing the statement: " . $this->conn->error;
        }
    }
    
    
    



public function check_account($r_id) {

        $query = "SELECT * FROM resident WHERE r_id = $r_id";
    
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }


    public function RequestClearance($purpose, $address, $payment, $validId, $proofResidency, $r_id, $documentPrice, $shippingFee, $totalPrice) {
        // Generate a unique code (example: timestamp + random string)
        $uniqueCode = uniqid('CR-', true); // Generates a unique code like CR-5f847ac3b5361
    
        // Prepare the SQL query
        $query = "INSERT INTO `centralize_request` 
                  (`cr_code`, `cr_purpose`, `cr_address`, `cr_payment`, `cr_validId`, `cr_proofResidency`, `cr_r_id`, `cr_price`, `cr_shipping_fee`, `cr_total`, `cr_formtype`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->conn->error);
        }
    
        // Bind the parameters
        $formType = 'Barangay Clearance';
        $stmt->bind_param("ssssssiddds", $uniqueCode, $purpose, $address, $payment, $validId, $proofResidency, $r_id, $documentPrice, $shippingFee, $totalPrice, $formType);
    
        // Execute the query
        if ($stmt->execute()) {
            // Return a success message
            return "Clearance request successfully submitted";
        } else {
            throw new Exception("Failed to submit clearance request: " . $stmt->error);
        }
    }
    
    
    
    public function RequestBarangayID($purpose, $address, $payment, $validId, $proofResidency, $pic, $signature, $r_id, $documentPrice, $shippingFee, $totalPrice) {
        // Generate a unique code (example: timestamp + random string)
        $uniqueCode = uniqid('CR-', true); // Generates a unique code like CR-5f847ac3b5361
    
        // Prepare the SQL query
        $query = "INSERT INTO `centralize_request` 
                  (`cr_code`, `cr_purpose`, `cr_address`, `cr_payment`, `cr_validId`, `cr_proofResidency`, `cr_1X1_pic`, `cr_Signature`, `cr_r_id`, `cr_price`, `cr_shipping_fee`, `cr_total`, `cr_formtype`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->conn->error);
        }
    
        // Bind the parameters
        $formType = 'Barangay ID';
        $stmt->bind_param("ssssssssiddds", $uniqueCode, $purpose, $address, $payment, $validId, $proofResidency, $pic, $signature, $r_id, $documentPrice, $shippingFee, $totalPrice, $formType);
    
        // Execute the query
        if ($stmt->execute()) {
            // Return a success message
            return "Barangay ID request successfully submitted";
        } else {
            throw new Exception("Failed to submit Barangay ID request: " . $stmt->error);
        }
    }




    public function RequestResidency(
        $purpose, 
        $address, 
        $payment, 
        $validIdFilename,
        $r_id,
        $documentPrice,
        $shippingFee,
        $totalPrice) {
        // Generate a unique code (example: timestamp + random string)
        $uniqueCode = uniqid('CR-', true); // Generates a unique code like CR-5f847ac3b5361
    
        // Prepare the SQL query
        $query = "INSERT INTO `centralize_request` 
                  (`cr_code`, `cr_purpose`, `cr_address`, `cr_payment`, `cr_validId`, `cr_r_id`, `cr_price`, `cr_shipping_fee`, `cr_total`, `cr_formtype`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->conn->error);
        }
    
        // Bind the parameters
        $formType = 'Barangay Residency';
        $stmt->bind_param("sssssiddds", $uniqueCode, $purpose, $address, $payment, $validIdFilename, $r_id, $documentPrice, $shippingFee, $totalPrice, $formType);
    
        // Execute the query
        if ($stmt->execute()) {
            // Return a success message
            return "Barangay ID request successfully submitted";
        } else {
            throw new Exception("Failed to submit Barangay ID request: " . $stmt->error);
        }
    }
    








    public function RequestIndigency(
        $purpose, 
        $address, 
        $payment, 
        $validIdFilename,
        $r_id,
        $documentPrice,
        $shippingFee,
        $totalPrice) {
        $uniqueCode = uniqid('CR-', true); 
    
        // Prepare the SQL query
        $query = "INSERT INTO `centralize_request` 
                  (`cr_code`, `cr_purpose`, `cr_address`, `cr_payment`, `cr_validId`, `cr_r_id`, `cr_price`, `cr_shipping_fee`, `cr_total`, `cr_formtype`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->conn->error);
        }
    
        // Bind the parameters
        $formType = 'Barangay Indigency';
        $stmt->bind_param("sssssiddds", $uniqueCode, $purpose, $address, $payment, $validIdFilename, $r_id, $documentPrice, $shippingFee, $totalPrice, $formType);
    
        // Execute the query
        if ($stmt->execute()) {
            // Return a success message
            return "Barangay ID request successfully submitted";
        } else {
            throw new Exception("Failed to submit Barangay ID request: " . $stmt->error);
        }
    }
    

    
    public function fetch_all_clearance_request($r_id){
        $query = "SELECT * FROM centralize_request WHERE cr_r_id = '$r_id'";
    
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }



}




?>