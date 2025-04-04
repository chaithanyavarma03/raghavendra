
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Slick CSS from CDN -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<!-- Include Slick CSS from CDN -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

<!-- Include jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Slick JS from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<!-- Include jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Slick JS from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>



        <title>Raghavendra textiles</title>
    </head>
<?php
require_once('header.php');

// Define the custom n12br function to convert newlines to <br> tags
function n12br($text) {
    // Replace newline characters with <br> tags
    return str_replace("\n", "<br>", $text);
}

// Fetch settings from the database
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];
    
}
?>

<div class="preloader">
  <img src="/RTS/RTS/assets/uploads/preloder.gif" alt="Loading...">
</div>
<style>
.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff; /* Change background color as needed */
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

.preloader img {
  width: 700px; /* Adjust size as needed */
  height: auto;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<script>
window.addEventListener("load", function() {
  var preloader = document.querySelector(".preloader");
  preloader.style.display = "none";
});
</script>
<div id="bootstrap-touch-slider" class="carousel bs-slider fade control-round indicators-line" data-ride="carousel" data-pause="false" data-interval="5000">

    <!-- Indicators -->
    <div class="carousel-inner" role="listbox">
        <?php
        $i = 0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {            
        ?>
        <div class="item <?php if($i == 0) {echo 'active';} ?>" style="background-image:url(assets/uploads/<?php echo $row['photo']; ?>);">
            <div class="bs-slider-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="slide-text <?php if($row['position'] == 'Left') {echo 'slide_style_left';} elseif($row['position'] == 'Center') {echo 'slide_style_center';} elseif($row['position'] == 'Right') {echo 'slide_style_right';} ?>">
                        <h1 data-animation="animated <?php if($row['position'] == 'Left') {echo 'zoomInLeft';} elseif($row['position'] == 'Center') {echo 'flipInX';} elseif($row['position'] == 'Right') {echo 'zoomInRight';} ?>"><?php echo $row['heading']; ?></h1>
                        <p data-animation="animated <?php if($row['position'] == 'Left') {echo 'fadeInLeft';} elseif($row['position'] == 'Center') {echo 'fadeInDown';} elseif($row['position'] == 'Right') {echo 'fadeInRight';} ?>"><?php echo nl2br($row['content']); ?></p>
                        <a href="<?php echo $row['button_url']; ?>" target="_blank"  class="btn btn-primary" data-animation="animated <?php if($row['position'] == 'Left') {echo 'fadeInLeft';} elseif($row['position'] == 'Center') {echo 'fadeInDown';} elseif($row['position'] == 'Right') {echo 'fadeInRight';} ?>"><?php echo $row['button_text']; ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
        }
        ?>
    </div>

    <!-- Slider Left Control -->
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <!-- Slider Right Control -->
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>





<?php if($home_service_on_off == 1): ?>
<div class="container-fluid pt-5" id="shop">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
    <div class="row px-xl-5 pb-3">
        <?php
        $statement = $pdo->prepare("SELECT * FROM tbl_service");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="<?php echo $row['button_url']; ?>">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        <img class="img-fluid photo" src="assets/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['title']; ?>" width="150px">
                    </div>
                    <div class="flex-fill pl-3">
                        <h6><?php echo $row['title']; ?></h6>
                        <small class="text-body"><?php echo n12br($row['content']); ?></small>
                    </div>
                </div>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
</div>       
<?php endif; ?>

<?php if($home_featured_product_on_off == 1): ?>
<div class="product pt_70 pb_70 owlCarousel owl.carousel.min">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2 style="color:aliceblue;"><?php echo $featured_product_title; ?></h2>
                    <h3 style="color:aliceblue;"><?php echo $featured_product_subtitle; ?></h3>
                    <!-- Adding a hyperlink to view all featured products -->
                    <p><a href="all_featured_products.php" style="color:aliceblue;">View All Featured Products</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="product-carousel">
    <?php
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT ".$total_featured_product_home);
    $statement->execute(array(1, 1));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
    ?>
    <div class="item">
        <div class="thumb">
            <a href="product.php?id=<?php echo $row['p_id']; ?>">
                <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                <div class="overlay"></div>
            </a>
        </div>
        <div class="text">
            <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
            <h4>
                ₹<?php echo $row['p_current_price']; ?> 
                <?php if($row['p_old_price'] != ''): ?>
                <del>
                    ₹<?php echo $row['p_old_price']; ?>
                </del>
                <?php endif; ?>
            </h4>
            <div class="rating">
                <?php
                $t_rating = 0;
                $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                $statement1->execute(array($row['p_id']));
                $tot_rating = $statement1->rowCount();
                if($tot_rating == 0) {
                    $avg_rating = 0;
                } else {
                    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result1 as $row1) {
                        $t_rating = $t_rating + $row1['rating'];
                    }
                    $avg_rating = $t_rating / $tot_rating;
                }
                ?>
                <?php
                if($avg_rating == 0) {
                    echo '';
                } elseif($avg_rating == 1.5) {
                    echo '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                } elseif($avg_rating == 2.5) {
                    echo '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                } elseif($avg_rating == 3.5) {
                    echo '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                    ';
                } elseif($avg_rating == 4.5) {
                    echo '
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    ';
                } else {
                    for($i = 1; $i <= 5; $i++) {
                        ?>
                        <?php if($i > $avg_rating): ?>
                            <i class="fa fa-star-o"></i>
                        <?php else: ?>
                            <i class="fa fa-star"></i>
                        <?php endif; ?>
                        <?php
                    }
                }
                ?>
            </div>
            <?php if($row['p_qty'] == 0): ?>
            <div class="out-of-stock">
                <div class="inner">
                    Out Of Stock
                </div>
            </div>
            <?php else: ?>
            <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</a></p>
            <?php endif; ?>
            
        </div>
    </div>
    <?php
    }
    ?>
</div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if($home_latest_product_on_off == 1): ?>
<div class="product bg-gray pt_70 pb_30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $latest_product_title; ?></h2>
                    <h3><?php echo $latest_product_subtitle; ?></h3>
                    
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel">

                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT ".$total_latest_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="item">
                            <div class="thumb">
                                <a href="product.php?id=<?php echo $row['p_id']; ?>">
                                    <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                    <div class="overlay"></div>
                                </a>
                            </div>
                            <div class="text">
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                <h4>
                                ₹<?php echo $row['p_current_price']; ?> 
                                    <?php if($row['p_old_price'] != ''): ?>
                                    <del>
                                    ₹<?php echo $row['p_old_price']; ?>
                                    </del>
                                    <?php endif; ?>
                                </h4>
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</a></p>
                                <?php endif; ?>
                                <!-- Adding a hyperlink to related products -->
                                
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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

<section class="home-newsletter ">
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
                    <li style="color:aliceblue;"><a style="color:aliceblue;" href="#shop">Shop</a></li>
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
