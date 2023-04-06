<?php require_once('includes/authorise.php'); ?>
<?php $services = getServices(); ?>
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
        <div class="mb-3">
            <h1 class="display-1">myServices</h1>
            <p class="lead font-weight-bold">Welcome to LIFE (Living It Fully Everyday)!</p>
            <p>We offer many great services.</p>
        </div>


        <div class="grid-container">
    <?php foreach($services as $service) { ?>
        <div class="grid-item">
            <a href="service.php?id=<?php echo $service['service_id']; ?>">
                <img src="<?php echo $service['image_path']; ?>" class="service" />
                <h3><?php echo $service['name']; ?></h3>
            </a>
        </div>
    <?php } ?>
</div>
    

        <?php require_once('includes/footer.php'); ?>
    </div>
</body>
</html>
