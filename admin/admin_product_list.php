<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Product List</title>
    <!-- Add your CSS here -->
</head>
<body>

<h1>Product List</h1>
<p><a href="admin_product_add.php">Add New Product</a></p>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Current Price</th>
            <th>Old Price</th>
            <th>Quantity</th>
            <th>Is Active</th>
            <th>Is Featured</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $statement = $pdo->prepare("SELECT * FROM tbl_product ORDER BY p_id DESC");
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
            echo '<tr>';
            echo '<td>'.$product['p_id'].'</td>';
            echo '<td>'.$product['p_name'].'</td>';
            echo '<td>'.$product['p_current_price'].'</td>';
            echo '<td>'.$product['p_old_price'].'</td>';
            echo '<td>'.$product['p_qty'].'</td>';
            echo '<td>'.($product['p_is_active'] ? 'Yes' : 'No').'</td>';
            echo '<td>'.($product['p_is_featured'] ? 'Yes' : 'No').'</td>';
            echo '<td>';
            echo '<a href="admin_product_edit.php?id='.$product['p_id'].'">Edit</a> | ';
            echo '<a href="admin_product_delete.php?id='.$product['p_id'].'">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

</body>
</html>
