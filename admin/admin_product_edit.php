<?php
include('config.php');

if (isset($_POST['submit'])) {
    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $p_description = $_POST['p_description'];
    $p_current_price = $_POST['p_current_price'];
    $p_old_price = $_POST['p_old_price'];
    $p_qty = $_POST['p_qty'];
    $p_is_active = isset($_POST['p_is_active']) ? 1 : 0;
    $p_is_featured = isset($_POST['p_is_featured']) ? 1 : 0;
    $category_id = $_POST['category_id'];
    
    $p_featured_photo = $_FILES['p_featured_photo']['name'];
    $p_featured_photo_tmp = $_FILES['p_featured_photo']['tmp_name'];
    
    if ($p_featured_photo != '') {
        move_uploaded_file($p_featured_photo_tmp, "assets/uploads/".$p_featured_photo);
        $statement = $pdo->prepare("UPDATE tbl_product SET p_name=?, p_description=?, p_current_price=?, p_old_price=?, p_qty=?, p_is_active=?, p_is_featured=?, category_id=?, p_featured_photo=? WHERE p_id=?");
        $statement->execute([$p_name, $p_description, $p_current_price, $p_old_price, $p_qty, $p_is_active, $p_is_featured, $category_id, $p_featured_photo, $p_id]);
    } else {
        $statement = $pdo->prepare("UPDATE tbl_product SET p_name=?, p_description=?, p_current_price=?, p_old_price=?, p_qty=?, p_is_active=?, p_is_featured=?, category_id=? WHERE p_id=?");
        $statement->execute([$p_name, $p_description, $p_current_price, $p_old_price, $p_qty, $p_is_active, $p_is_featured, $category_id, $p_id]);
    }

    header('Location: admin_product_list.php');
}

$p_id = $_GET['id'];
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
$statement->execute([$p_id]);
$product = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Edit Product</title>
    <!-- Add your CSS here -->
</head>
<body>

<h1>Edit Product</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="p_id" value="<?php echo $product['p_id']; ?>">
    <p>
        <label for="p_name">Name:</label>
        <input type="text" name="p_name" id="p_name" value="<?php echo $product['p_name']; ?>">
    </p>
    <p>
        <label for="p_description">Description:</label>
        <textarea name="p_description" id="p_description"><?php echo $product['p_description']; ?></textarea>
    </p>
    <p>
        <label for="p_current_price">Current Price:</label>
        <input type="text" name="p_current_price" id="p_current_price" value="<?php echo $product['p_current_price']; ?>">
    </p>
    <p>
        <label for="p_old_price">Old Price:</label>
        <input type="text" name="p_old_price" id="p_old_price" value="<?php echo $product['p_old_price']; ?>">
    </p>
    <p>
        <label for="p_qty">Quantity:</label>
        <input type="text" name="p_qty" id="p_qty" value="<?php echo $product['p_qty']; ?>">
    </p>
    <p>
        <label for="p_is_active">Is Active:</label>
        <input type="checkbox" name="p_is_active" id="p_is_active" value="1" <?php echo $product['p_is_active'] ? 'checked' : ''; ?>>
    </p>
    <p>
        <label for="p_is_featured">Is Featured:</label>
        <input type="checkbox" name="p_is_featured" id="p_is_featured" value="1" <?php echo $product['p_is_featured'] ? 'checked' : ''; ?>>
    </p>
    <p>
        <label for="category_id">Category ID:</label>
        <input type="text" name="category_id" id="category_id" value="<?php echo $product['category_id']; ?>">
    </p>
    <p>
        <label for="p_featured_photo">Featured Photo:</label>
        <input type="file" name="p_featured_photo" id="p_featured_photo">
    </p>
    <p>
        <input type="submit" name="submit" value="Update Product">
    </p>
</form>

</body>
</html>
