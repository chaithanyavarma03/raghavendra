<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;
    $error_message = '';

    if(empty($_POST['title'])) {
        $valid = 0;
        $error_message .= 'Title cannot be empty<br>';
    }

    if(empty($_POST['content'])) {
        $valid = 0;
        $error_message .= 'Content cannot be empty<br>';
    }

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $error_message .= 'You must upload a jpg, jpeg, gif, or png file<br>';
        }
    }

    if($valid == 1) {
        if($path == '') {
            $statement = $pdo->prepare("UPDATE tbl_service SET title=?, content=?, button_url=? WHERE id=?");
            $statement->execute(array($_POST['title'], $_POST['content'], $_POST['button_url'], $_REQUEST['id']));
        } else {
            // Ensure the file path is valid before attempting to unlink
            if(file_exists('../assets/uploads/' . $_POST['current_photo'])) {
                unlink('../assets/uploads/' . $_POST['current_photo']);
            }

            // Move the new photo
            $final_name = 'service-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

            // Update the database with the new photo
            $statement = $pdo->prepare("UPDATE tbl_service SET title=?, content=?, photo=?, button_url=? WHERE id=?");
            $statement->execute(array($_POST['title'], $_POST['content'], $final_name, $_POST['button_url'], $_REQUEST['id']));
        }

        $success_message = 'Service is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check if the ID is valid
    $statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Service</h1>
    </div>
    <div class="content-header-right">
        <a href="service.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $title = $row['title'];
    $content = $row['content'];
    $photo = $row['photo'];
    $button_url = $row['button_url'];
}
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if(!empty($error_message)): ?>
            <div class="callout callout-danger">
                <p><?php echo $error_message; ?></p>
            </div>
            <?php endif; ?>

            <?php if(!empty($success_message)): ?>
            <div class="callout callout-success">
                <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="title" value="<?php echo $title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Number of Products <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="content" style="height:140px;"><?php echo $content; ?></textarea>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Existing Photo</label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <img src="../assets/uploads/<?php echo $photo; ?>" alt="Service Photo" style="width:180px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Photo</label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" name="photo">(Only jpg, jpeg, gif, and png are allowed)
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button URL</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="button_url" value="<?php echo $button_url; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
