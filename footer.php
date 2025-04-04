<?php require_once('header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.social-icons {
    list-style: none;
    padding: 0;
    margin: 0;
}

.social-icons li {
    display: inline;
    margin-right: 10px;
}

.social-icons a {
    text-decoration: none;
    font-size: 20px;
    color: #333;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #007bff; /* Change this to your desired hover color */
}

</style>


<?php
// Fetch settings from the database
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    $footer_about = $row['footer_about'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $contact_address = $row['contact_address'];
    $total_recent_post_footer = $row['total_recent_post_footer'];
    $total_popular_post_footer = $row['total_popular_post_footer'];
}
?>

<?php $newsletter_on_off = isset($newsletter_on_off) ? $newsletter_on_off : 'off'; ?>

<section class="home-newsletter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="single">
                    <?php
                    require 'vendor/autoload.php';

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\SMTP;
                    use PHPMailer\PHPMailer\Exception;

                    if (isset($_POST['form_subscribe'])) {
                        if (empty($_POST['email_subscribe'])) {
                            $valid = 0;
                            $error_message1 .= LANG_VALUE_131;
                        } else {
                            if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false) {
                                $valid = 0;
                                $error_message1 .= LANG_VALUE_134;
                            } else {
                                $statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=?");
                                $statement->execute(array($_POST['email_subscribe']));
                                $total = $statement->rowCount();
                                if ($total) {
                                    $valid = 0;
                                    $error_message1 .= LANG_VALUE_147;
                                } else {
                                    // Sending email to the requested subscriber for email confirmation
                                    // Getting activation key to send via email. also it will be saved to database until user click on the activation link.
                                    $key = md5(uniqid(rand(), true));

                                    // Getting current date
                                    $current_date = date('Y-m-d');

                                    // Getting current date and time
                                    $current_date_time = date('Y-m-d H:i:s');

                                    // Inserting data into the database
                                    $statement = $pdo->prepare("INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)");
                                    $statement->execute(array($_POST['email_subscribe'], $current_date, $current_date_time, $key, 0));

                                    // Sending Confirmation Email
                                    $to = $_POST['email_subscribe'];
                                    $subject = 'Subscriber Email Confirmation';

                                    // Getting the url of the verification link
                                    $verification_url = BASE_URL . 'verify.php?email=' . $to . '&key=' . $key;

                                    $message = '
                                    Thanks for your interest to subscribe our newsletter!<br><br>
                                    Please click this link to confirm your subscription:
                                    ' . $verification_url . '<br><br>
                                    This link will be active only for 24 hours.
                                    ';

                                    $headers = 'From: ' . $contact_email . "\r\n" .
                                        'Reply-To: ' . $contact_email . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion() . "\r\n" .
                                        "MIME-Version: 1.0\r\n" .
                                        "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                    // PHPMailer integration
                                    $mail = new PHPMailer(true);

                                    try {
                                        // Server settings
                                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                        $mail->isSMTP();                                            // Send using SMTP
                                        $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
                                        $mail->SMTPAuth = true;                                     // Enable SMTP authentication
                                        $mail->Username = 'your-email@gmail.com';                   // SMTP username
                                        $mail->Password = 'your-email-password';                    // SMTP password
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
                                        $mail->Port = 587;                                          // TCP port to connect to

                                        // Recipients
                                        $mail->setFrom('your-email@gmail.com', 'Mailer');
                                        $mail->addAddress($to);                                     // Add a recipient

                                        // Content
                                        $mail->isHTML(true);                                        // Set email format to HTML
                                        $mail->Subject = $subject;
                                        $mail->Body = $message;

                                        $mail->send();
                                        $success_message1 .= 'Message has been sent';
                                    } catch (Exception $e) {
                                        $error_message1 .= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                    }
                                }
                            }
                        }
                    }
                    if ($error_message1 != '') {
                        echo "<script>alert('" . $error_message1 . "')</script>";
                    }
                    if ($success_message1 != '') {
                        echo "<script>alert('" . $success_message1 . "')</script>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <h2><?php echo LANG_VALUE_93; ?></h2>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="<?php echo LANG_VALUE_95; ?>" name="email_subscribe">
                            <span class="input-group-btn">
                                <button class="btn btn-theme" type="submit" name="form_subscribe"><?php echo LANG_VALUE_92; ?></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div  class="footer">
    <div class="container">
        <div class="row">
            <!-- About Us Section -->
            <div class="col-md-3">
                <h4 style="color:aliceblue;"><u>About Us</u></h4>
                <p style="color:aliceblue;"></p>
            </div>
            <!-- Quick Links Section -->
            <div class="col-md-3">
                <h4 style="color:aliceblue;"><u>Quick Links</u></h4>
                <ul>
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="about.php">About Us</a></li>
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="contact.php">Contact Us</a></li>
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="faq.php">FAQ</a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;"href="terms.php">Terms & Conditions</a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;"href="privacy.php">Privacy Policy</a></li>
                </ul>
            </div>
            <!-- Site Links Section -->
            <div class="col-md-3">
                <h4 style="color:aliceblue;"><u>Site links</u></h4>
                <ul>
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="index.php">Home</u></li>
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="shop.php">Shop</a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;"href="blog.php">Blog</a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;"href="cart.php">Cart</a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;" href="checkout.php">Checkout</a></li>
                </ul>
            </div>
            <!-- Contact Us Section -->
            <div class="col-md-3">
                <h4 style="color:aliceblue;"><u>Contact Us</u></h4>
                <p style="color:aliceblue;"><strong>Email:</strong> Raghavendratextiles2023@gmail.com</p>
                <p style="color:aliceblue;"><strong>Phone:</strong> +919014200295</p>
                <p style="color:aliceblue;"><strong>Address:</strong>Gunturvari thota,5th Lane,Guntur-522 001.AP.<br>GSTIN:37AJSPP2413J1ZT </p>
				<ul class="social-icons">
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="<?php echo $social_facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="<?php echo $social_twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;"href="<?php echo $social_linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li style="color:aliceblue;"><a  style="color:aliceblue;"href="<?php echo $social_instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12 copyright">
                <?php echo $footer_copyright = isset($footer_copyright) ? $footer_copyright : 'Copyright Â© 2024 - Ragavendra Textiles by <a>"Cs_Space"</a>.'; ?>
            </div>
        </div>
    </div>
</div>

<a href="#" class="scrollup">
    <i class="fa fa-angle-up"></i>
</a>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $stripe_public_key = $row['stripe_public_key'];
    $stripe_secret_key = $row['stripe_secret_key'];
}
?>

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    function confirmDelete() {
        return confirm("Sure you want to delete this data?");
    }

    $(document).ready(function () {
        advFieldsStatus = $('#advFieldsStatus').val();

        $('#paypal_form').hide();
        $('#stripe_form').hide();
        $('#bank_form').hide();

        $('#advFieldsStatus').on('change', function () {
            advFieldsStatus = $('#advFieldsStatus').val();
            if (advFieldsStatus == '') {
                $('#paypal_form').hide();
                $('#stripe_form').hide();
                $('#bank_form').hide();
            } else if (advFieldsStatus == 'PayPal') {
                $('#paypal_form').show();
                $('#stripe_form').hide();
                $('#bank_form').hide();
            } else if (advFieldsStatus == 'Stripe') {
                $('#paypal_form').hide();
                $('#stripe_form').show();
                $('#bank_form').hide();
            } else if (advFieldsStatus == 'Bank Deposit') {
                $('#paypal_form').hide();
                $('#stripe_form').hide();
                $('#bank_form').show();
            }
        });
    });

    $(document).on('submit', '#stripe_form', function () {
        // createToken returns immediately - the supplied callback submits the form if there are no errors
        $('#submit-button').prop("disabled", true);
        $("#msg-container").hide();
        Stripe.card.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        return false;
    });

    Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#submit-button').prop("disabled", false);
            $("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
            $("#msg-container").show();
        } else {
            var form$ = $("#stripe_form");
            var token = response['id'];
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
</script>
<?php $before_body = isset($before_body) ? $before_body : ''; ?>
</body>
</html>
