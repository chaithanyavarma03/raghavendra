<?php require_once('header.php'); ?>

<?php
if (isset($_REQUEST['email']) && isset($_REQUEST['token'])) {
    try {
        // Initialize a variable for conditional checks
        $isValid = false;

        // Check if the token is correct and matches with the database
        $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
        $statement->execute([$_REQUEST['email']]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            if ($_REQUEST['token'] === $row['cust_token']) {
                $isValid = true;
                break; // Exit the loop if a matching token is found
            }
        }

        if ($isValid) {
            // User is valid; update the customer status in the database
            $statement = $pdo->prepare("UPDATE tbl_customer SET cust_token=?, cust_status=? WHERE cust_email=?");
            $statement->execute(['', 1, $_REQUEST['email']]);

            $success_message = '<p style="color:green;">Your email is verified successfully. You can now login to our website.</p><p><a href="' . BASE_URL . 'login.php" style="color:#167ac6;font-weight:bold;">Click here to login</a></p>';
        } else {
            // Handle the case where the token doesn't match
            throw new Exception("Invalid verification token.");
        }
    } catch (Exception $e) {
        // Log the error or perform any necessary error handling
        error_log("Email verification failed: " . $e->getMessage());
        
        // Display an error message to the user
        $error_message = '<p style="color:red;">Email verification failed. Please try again later.</p>';
    }
} else {
    // Redirect or show an error if 'email' or 'token' is missing
    header('location: ' . BASE_URL . 'error.php');
    exit;
}
?>

<!-- Display success or error message -->
<?php if (isset($success_message)) : ?>
    <div class="success-message"><?php echo $success_message; ?></div>
<?php elseif (isset($error_message)) : ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>