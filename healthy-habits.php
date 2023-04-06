<p>Start making meal plans for a healthier lifestyle right away by choosing from the wide variety of healthy meal options below,
     including non-vegetarian, seafood, vegetarian, and vegan options. With so many options available, 
    it's simple to find the ideal meal plan to satisfy your dietary requirements and preferences. 
    Whether you're looking for plant-based or high-protein options, we've got you covered.
     Take the first step towards a healthier you by starting to plan your meals right away!</p>

<?php // The form below is displayed if type has not been submitted. ?>
<?php if(!isset($_POST['type'])) { ?>
    <?php $mealOptions = getMealOptions(); ?>

    <form method="post">
        <div class="form-group">
            <?php // Loop through the meal options and display them as radio buttons ?>
            <?php foreach($mealOptions as $mealOption) { ?>
                <?php $t = $mealOption['type']; ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                        id="<?php echo $t; ?>" name="type" value="<?php echo $t; ?>" />
                    <label class="form-check-label" for="<?php echo $t; ?>"><?php echo $t; ?></label>
                </div>
            <?php } ?>
            <?php // If the form has been submitted but no meal option is selected, display an error message ?>
            <?php if(isset($_POST['plan'])) { ?>
                <div class='text-danger'>You must select a meal option.</div>
            <?php } ?>
        </div>

        <button type="submit" class="btn btn-primary mr-5" name="plan">Plan Meal</button>
    </form>
<?php } else { ?>

    <?php // Get the selected meal plan from the database ?>
    <?php $mealPlan = getMealPlan($_POST['type']); ?>

    <h3><?php echo $mealPlan[0]['type']; ?> Meal Plan</h3>
<ul>
    <?php // Display the meals in the selected plan ?>
    <?php foreach ($mealPlan as $meal) { ?>
        <li>
            <?php echo $meal['name']; ?> - <?php echo $meal['kilojoules']; ?> kJ
        </li>
    <?php } ?>
</ul>
    <?php // If the form to select the servings of the meal plan has not been submitted or there are errors, display the form ?>
    <?php if(!isset($_POST['servings']) || count($errors) > 0) { ?>
        <form method="post">
            <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>" />

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="servings">Servings</label>
                    <input type="text" class="form-control d-inline-block" id="servings" name="servings"
                        <?php displayValue($_POST, 'servings'); ?> />
                    <?php displayError($errors, 'servings'); ?>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary mr-5" name="plan">Plan Meal</button>
    </form>
<?php 

?>
<?php } else { ?>
        <div class="alert alert-success">
            You have successfully started a <strong><?php echo $_POST['servings']; ?> day</strong>
            <strong><?php echo $_POST['type']; ?> Meal Plan</strong>.
        </div>
        <div>
                <a href="" class="btn btn-outline-dark mr-5">More Meal Plans</a>
                <a href="myServices.php" class="btn btn-outline-dark">Back to myServices</a>
            </div>
        <?php } ?>
    <?php } ?>

