<?php require_once('includes/authorise.php'); ?>
<?php
    $id = (int) $_GET['id'];
    $service = getService($id);

    $errors = [];
    if(isset($_POST['activity'])) {
        $email = getLoggedInUser()['email'];

        $errors = recordActivity($email, $id, $_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="./css/style.css">
<link rel="stylesheet" type="text/css" href="./css/myServices.css">
<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body>
    <?php require_once('includes/header.php'); ?>

    <div class="container">
        <div class="mb-5">
            <h1 class="display-1">
                <?php echo $service['name']; ?>
                <img src="<?php echo $service['image_path']; ?>" class="service ml-5" />
            </h1>
        </div>

        <?php if($id === 1) { ?>
            <?php require_once('yoga.php'); ?>

        <?php } elseif ($id === 2) { ?>
            <?php require_once('meditation.php'); ?>

        <?php } elseif ($id === 3) { ?>
            <?php require_once('stretching.php'); ?>

        <?php } elseif ($id === 4) { ?>
            <?php require_once('healthy-habits.php'); ?>
            
            </div>
        <?php } ?>
    </div>
    <br><br><br><br><br><br>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>
