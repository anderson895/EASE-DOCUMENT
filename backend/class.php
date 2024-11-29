<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


    public function Login($email, $password)
    {
        $hashedPassword = hash('sha256', $password);
    
        $query = $this->conn->prepare("SELECT * FROM `user` WHERE `user_email` = ? AND `user_password` = ? AND user_status = 'Active'");
        $query->bind_param("ss", $email, $hashedPassword);
    
        // Execute the query
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
    
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_type'] = $user['user_type'];
    
                // Build JSON response
                $response = [
                    "status" => "success",
                    "message" => "Login successful.",
                    "user" => [
                        "user_id" => $user['user_id'],
                        "user_type" => $user['user_type'],
                        "user_email" => $user['user_email']
                    ]
                ];
    
                return json_encode($response);
            } else {
                return json_encode([
                    "status" => "error",
                    "message" => "Invalid email or password."
                ]);
            }
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Database query failed."
            ]);
        }
    }
    

    

}