<?php
include('config.php');

if (isset($_POST['submit'])) {
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
    
    move_uploaded_file($p_featured_photo_tmp, "assets/uploads/".$p_featured_photo);

    $statement = $pdo->prepare("INSERT INTO tbl_product (p_name, p_description, p_current_price, p_old_price, p_qty, p_is_active, p_is_featured, category_id, p_featured_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->execute([$p_name, $p_description, $p_current_price, $p_old_price, $p_qty, $p_is_active, $p_is_featured, $category_id, $p_featured_photo]);
    
    header('Location: admin_product_list.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Add Product</title>
    <!-- Add your CSS here -->
</head>
<body>

<h1>Add Product</h1>
<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label for="p_name">Name:</label>
        <input type="text" name="p_name" id="p_name">
    </p>
    <p>
        <label for="p_description">Description:</label>
        <textarea name="p_description" id="p_description"></textarea>
    </p>
    <p>
        <label for="p_current_price">Current Price:</label>
        <input type="text" name="p_current_price" id="p_current_price">
    </p>
    <p>
        <label for="p_old_price">Old Price:</label>
        <input type="text" name="p_old_price" id="p_old_price">
    </p>
    <p>
        <label for="p_qty">Quantity:</label>
        <input type="text" name="p_qty" id="p_qty">
    </p>
    <p>
        <label for="p_is_active">Is Active:</label>
        <input type="checkbox" name="p_is_active" id="p_is_active" value="1">
    </p>
    <p>
        <label for="p_is_featured">Is Featured:</label>
        <input type="checkbox" name="p_is_featured" id="p_is_featured" value="1">
    </p>
    <p>
        <label for="category_id">Category ID:</label>
        <input type="text" name="category_id" id="category_id">
    </p>
    <p>
        <label for="p_featured_photo">Featured Photo:</label>
        <input type="file" name="p_featured_photo" id="p_featured_photo">
    </p>
    <p>
        <input type="submit" name="submit" value="Add Product">
    </p>
</form>

</body>
</html>
