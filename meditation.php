<p>Choose a meditation technique from the list below to get started. 
    <br>To find the best fit for you, select from audio-guided meditations or video classes.</p>

            <?php // The form below is displayed if type has not been submitted. ?>
            <?php if(!isset($_POST['type'])) { ?>
                <?php $serviceInstructions = getServiceInstructions($id); ?>

                <form method="post">
                    <div class="form-group">
                        <?php foreach($serviceInstructions as $serviceInstruction) { ?>
                            <?php $t = $serviceInstruction['service_type']; ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                    id="<?php echo $t; ?>" name="type" value="<?php echo $t; ?>" />
                                <label class="form-check-label" for="<?php echo $t; ?>"><?php echo $t; ?></label>
                            </div>
                        <?php } ?>
                        <?php if(isset($_POST['service'])) { ?>
                            <div class='text-danger'>You must select a meditation type.</div>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary mr-5" name="service">Go</button>
                    <a href="myServices.php" class="btn btn-outline-dark">Back to myServices</a>
                </form>
            <?php } else { ?>
                <?php $serviceInstruction = getServiceInstruction($id, $_POST['type']); ?>

                <h3><?php echo $serviceInstruction['service_type']; ?></h3>
                <video class="my-3 service" height="400" controls>
                    <source src="<?php echo $serviceInstruction['path']; ?>" type="video/mp4">
                </video>

                <?php if(!isset($_POST['activity']) || count($errors) > 0) { ?>
                    <form method="post">
                        <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>" />

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="duration">Duration (minutes)</label>
                                <input type="text" class="form-control d-inline-block" id="duration" name="duration"
                                    <?php displayValue($_POST, 'duration'); ?> />
                                <?php displayError($errors, 'duration'); ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-5" name="activity">Record Activity</button>
                        <a href="" class="btn btn-outline-dark">Cancel</a>
                    </form>
                <?php } else { ?>
                    <div class="alert alert-success">
                        You have successfully recorded <strong><?php echo $_POST['duration']; ?> minutes</strong> of
                        <strong><?php echo $_POST['type']; ?> Meditation</strong>.
                    </div>
                    <div>
                        <a href="" class="btn btn-outline-dark mr-5">More <?php echo $service['name']; ?></a>
                        <a href="myServices.php" class="btn btn-outline-dark">Back to myServices</a>
                    </div>
                <?php } ?>
            <?php } ?>