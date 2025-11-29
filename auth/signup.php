<?php
/**
 * User signup page
 * Handle user registration with hashed passwords
 */
require '../config/db.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    // validation
    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error ="All fields are required";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif(strlen($password) < 6) {
        $error = "Passwords must be at least 6 characters";
    }elseif($password !== $confirm_password) {
        $error = "Passwords do not match";
    }else {
        // check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0) {
            $error = "Email already registered";
        } else {
            try{
                $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if($stmt->fetch()){
                    $error = "Email already registered.Please log in";
                } else {
                    // hash password
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    // insert new user
                    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                    $stmt->execute([$name, $email, $password_hash]);
                    // redirect to login page
                    $success = "Registration Successfull!You can now log in.";                }
            }
            catch(PDOException $e) {
                error_log("Sign Up error: ". $e->getMessage());
                $error = "Registration failed. Please try again later.";
            
        }
    }
}
}
?>
