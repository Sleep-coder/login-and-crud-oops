<?php
// includes/models/User.php
class User {
    private $authConn; // Uses authentication DB
    
    public function __construct($authDb) {
        $this->authConn = $authDb;
    }

    public function register($name, $email, $number, $password) {
        // Check if email exists
        $stmt = $this->authConn->prepare("SELECT id FROM tbluser WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return "Email already registered.";
        }

        // Insert new user
        $stmt = $this->authConn->prepare(
            "INSERT INTO tbluser (name, email, number, password) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $name, $email, $number, $password);
        
        if ($stmt->execute()) {
            $stmt->close();
            return "Registration successful!";
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Registration failed. Error: " . $error;
        }
    }

    public function login($email, $password) {
        $stmt = $this->authConn->prepare(
            "SELECT id, password FROM tbluser WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['loggedin'] = true;
                $stmt->close();
                return true;
            }
        }
        
        $stmt->close();
        return false;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }
}