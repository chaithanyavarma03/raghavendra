<?php
include('config.php');

$p_id = $_GET['id'];

$statement = $pdo->prepare("DELETE FROM tbl_product WHERE p_id = ?");
$statement->execute([$p_id]);

header('Location: admin_product_list.php');
?>
