<?php
require_once('config.php');
// Check if 'email' and 'token' are present in the URL
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Database query to select the user with the provided email and token
    $query = "SELECT * FROM tbl_customer WHERE cust_email = ? AND cust_token = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email, $token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User found, verify the account by updating 'cust_status' and clearing 'cust_token'
        $updateQuery = "UPDATE tbl_customer SET cust_status = 1, cust_token = '' WHERE cust_email = ?";
        $updateStmt = $pdo->prepare($updateQuery);
        if ($updateStmt->execute([$email])) {
            // Successfully verified the account
            echo '<p>Your account has been successfully verified. You can now <a href="login.php">login</a>.</p>';
        } else {
            // Handle errors, e.g., logging, custom error message
            echo '<p>There was an error verifying your account. Please contact support.</p>';
        }
    } else {
        // User not found or token does not match
        echo '<p>The verification link is invalid or expired. Please check your email and try again.</p>';
    }
} else {
    // Redirect to home page or show an error if 'email' or 'token' is missing
    echo '<p>Invalid request. Please use the link provided in your verification email.</p>';
    // Optionally, redirect to the home page or error page
    // header('Location: ' . BASE_URL . 'error.php');
    // exit;

// Optionally, include your footer here if you have a template system


    // Redirect or show an error if 'email' or 'token' is missing
    header('location: ' . BASE_URL . 'error.php'); // Adjust as necessary
    exit;
}
?>
<style>
    body{
        background-color: #aa7a76;
    }
</style>
