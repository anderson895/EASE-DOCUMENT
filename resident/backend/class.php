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


    public function RequestClearance($purpose, $address, $payment, $validId, $proofResidency, $r_id) {
        // Prepare the SQL query
        $query = "INSERT INTO `request_clearance` 
                  (`rcl_purpose`, `rcl_address`, `rcl_payment`, `rcl_validId`, `rcl_proofResidency`, `rcl_r_id`, `rcl_price`) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Database error: " . $this->conn->error);
        }
    
        // Bind the parameters
        $stmt->bind_param("sssssid", $purpose, $address, $payment, $validId, $proofResidency, $r_id, $price);
    
        // Assign the price value
        $price = 50;
    
        // Execute the query
        if ($stmt->execute()) {
            // Return a success message
            return "Clearance request successfully submitted";
        } else {
            throw new Exception("Failed to submit clearance request: " . $stmt->error);
        }
    }
    


    
    public function fetch_all_clearance_request($r_id){
        $query = "SELECT * FROM request_clearance WHERE rcl_r_id = '$r_id'";
    
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