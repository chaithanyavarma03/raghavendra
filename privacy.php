<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
   $privacy_title = $row['privacy_title'];
    $privacy_content = $row['privacy_content'];
    $privacy_banner = $row['privacy_banner'];
}
?>
<style>
    body{
        background-color: #aa7a76;
    }
</style>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $privacy_banner; ?>);">
    <div class="inner">
        <h1><?php echo $privacy_title; ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-12">
                
                <p>
                    <?php echo $privacy_content; ?>
                </p>

            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>