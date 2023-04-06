<?php require_once('includes/functions.php'); ?>
<?php
    $errors = [];
    if(isset($_POST['register'])) {
        $errors = registerUser($_POST);

        if(count($errors) === 0)
            redirect('myServices.php');
    }
?>


<!DOCTYPE html>
<html lang="en">


<script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  
<link rel="stylesheet" type="text/css" href="./css/style.css">
<link rel="stylesheet" type="text/css" href="./css/register.css">
<head>
    <?php require_once('includes/head.php'); ?>

</head>
<body>
    <?php require_once('includes/header.php'); ?>

    <div class="container">
        <h1 class="mb-3">Register</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="firstname">*First name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            <?php displayValue($_POST, 'firstname'); ?> />
                        <?php displayError($errors, 'firstname'); ?>
                    </div>

                    <div class="form-group">
                        <label for="lastname">*Last name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                            <?php displayValue($_POST, 'lastname'); ?> />
                        <?php displayError($errors, 'lastname'); ?>
                    </div>

                    <div class="form-group">
                        <label for="email">*Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            <?php displayValue($_POST, 'email'); ?> />
                        <?php displayError($errors, 'email'); ?>
                    </div>

                    <div class="form-group">
                        <label for="confirmEmail">*Confirm Email</label>
                        <input type="text" class="form-control" id="confirmEmail" name="confirmEmail"
                            <?php displayValue($_POST, 'confirmEmail'); ?> />
                        <?php displayError($errors, 'confirmEmail'); ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">*Phone number <small class="text-muted">format: +61 4xx xxx xxx</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            <?php displayValue($_POST, 'phone'); ?> />
                        <?php displayError($errors, 'phone'); ?>
                    </div>


                    <!--age dropdown-->
                    
                    <?php $errors = registerUser($_POST); 
                    displayError($errors, 'age'); ?>

                    <div>
                    <select id="age" name="age">
                        <?php
                        for($i = 2023; $i >= 1913; $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <!---->


                    <div class="form-group">
                        <div>*Student</div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                id="student-status-yes" name="student-status" value="true"
                                <?php displayChecked($_POST, 'student-status', 'true'); ?> />
                            <label class="form-check-label" for="student-status-yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                id="student-status-no" name="student-status" value="false"
                                <?php displayChecked($_POST, 'student-status', 'false'); ?> />
                            <label class="form-check-label" for="student-status-no">No</label>
                        </div>
                        <?php displayError($errors, 'student-status'); ?>
                    </div>

                    <div class="form-group">
                        <div>*Employed</div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                id="employment-status-yes" name="employment-status" value="true"
                                <?php displayChecked($_POST, 'employment-status', 'true'); ?> />
                            <label class="form-check-label" for="employment-status-yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                id="employment-status-no" name="employment-status" value="false"
                                <?php displayChecked($_POST, 'employment-status', 'false'); ?> />
                            <label class="form-check-label" for="employment-status-no">No</label>
                        </div>
                        <?php displayError($errors, 'employment-status'); ?>
                    </div>

                    <div class="form-group">
                        <label for="password">*Password <small class="text-muted">Must have correct format</small></label>
                        <input type="password" class="form-control" id="password" name="password" />
                        <?php displayError($errors, 'password'); ?>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">*Confirm password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" />
                        <?php displayError($errors, 'confirmPassword'); ?>
                    </div>

                    <button type="submit" class="btn btn-primary mr-5" name="register" value="register">Register</button>
                    <a href="index.php" class="btn btn-outline-dark">Cancel</a>
                </form>
            </div>
        </div>

        
    </div>
    <?php require_once('includes/footer.php'); ?>
    <script src="header.js"></script>
</body>
</html>
