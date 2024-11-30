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