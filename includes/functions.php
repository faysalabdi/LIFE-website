<?php

require_once('database-functions.php');

// Constants.
const USER_SESSION_KEY = 'user';

// Always call session_start.
session_start();

// --- Utils ----------------------------------------------------------------------------------

 
//This function checks if there is a key in the $errors array that matches the value
//of the $name parameter.If there is, the function echoes out a div element with 
//a class of "text-danger" and the value of the key in the $errors array.
// This is likely being used to display error messages in a web page in the event 
//of an error in form validation or similar.
function displayError($errors, $name) {
    if(isset($errors[$name]))
        echo "<div class='text-danger'>{$errors[$name]}</div>";
}


//This function first checks to see if the element in the array $form with the key of 
//$name exists (using the isset() function). If it does, it echo's out the value of that element
// with the key of $name, wrapped in double quotes, and preceded by the string "value=". 
//The value is also passed through the htmlspecialchars() function,
// which converts special characters to their HTML entities, to prevent cross-site scripting (XSS) attacks.
// This is used to set the value of an input field in a form, so that when the form is submitted, 
//the user does not have to re-enter the data.
function displayValue($form, $name) {
    if(isset($form[$name]))
        echo 'value="' . htmlspecialchars($form[$name]) . '"';
}


//This function first checks if the element with name $name is set in the $form array,
// and if it is, it checks if the value of that element is equal to the given $value. 
//If both conditions are true, then it adds the 'checked' attribute to the element,
// which will make it selected by default. This is typically used in checkboxes and
// radio buttons in HTML forms to preselect a certain option.
function displayChecked($form, $name, $value) {
    if(isset($form[$name]) && $form[$name] === $value)
        echo 'checked';
}



//This function is used to redirect the user to a different webpage. 
//The function takes one argument, which is the location of the webpage that the user 
//should be redirected to. The function uses the header function to set the "Location" 
//header to the provided location. This tells the browser to redirect the user to the new 
//location. The exit() function is then called to stop the execution of the script, 
//so that the user is not redirected after the rest of the script is executed.
function redirect($location) {
    header("Location: $location");
    exit();
}

// --- User -----------------------------------------------------------------------------------


//This function is checking if the user is logged in by checking if the "USER_SESSION_KEY" 
//is set in the $_SESSION superglobal. The $_SESSION superglobal is an array that stores data 
//across multiple requests, and is used to maintain the user's session.
// If the key is set, the function returns true, indicating that the user is logged in. 
//If the key is not set, the function returns false, indicating that the user is not logged in.
function isUserLoggedIn() {
    return isset($_SESSION[USER_SESSION_KEY]);
}


//This function first checks if the user is logged in by calling the "isUserLoggedIn()" function.
// If the user is logged in, the function returns the value stored in the session variable 
//"USER_SESSION_KEY". If the user is not logged in, the function returns "null". 
//The purpose of this code is likely to return the information of the currently logged-in user,
// so that it can be used throughout the application to personalize the experience 
//or to check if certain actions are allowed based on user role or other properties.
function getLoggedInUser() {
    return isUserLoggedIn() ? $_SESSION[USER_SESSION_KEY] : null;
}


//This function "loginUser" is responsible for validating the user's input when they submit the login form. 
//It checks if the email is in the correct format using the FILTER_VALIDATE_EMAIL filter, 
//and that the password is at least 6 characters long. If no errors are found,
// it attempts to find a user with the provided email in the database. If a user is found,
// it checks if the provided password matches the one stored in the database.
// If it matches, it sets a session variable to indicate that the user is logged in. 
//If the login fails, it adds an error message to indicate that the email and/or password is incorrect.
function loginUser($form) {
    $errors = [];

    $key = 'email';
    if(!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_EMAIL) === false)
        $errors[$key] = 'Email is invalid.';

    $key = 'password';
    if(!isset($form[$key]) || strlen($form[$key]) < 6)
        $errors[$key] = 'Password is required and must contain at least 6 characters.';

    if(count($errors) === 0) {
        $user = getUser($form['email']);

        if($user !== false && $form['password'] === $user['password'])
            // Set session variable to login user.
            $_SESSION[USER_SESSION_KEY] = $user;
        else
            $errors[$key] = 'Login failed, email and / or password incorrect. Please try again.';
    }

    return $errors;
}


//This function logs out the user by unsetting all session variables,
// effectively ending the user's session. This allows the user to log out of the application.
function logoutUser() {
    // Unset all session variables.
    session_unset();
}

function registerUser($form) {
    $errors = [];

    $key = 'firstname';
    if(!isset($form[$key]) || preg_match('/^\s*$/', $form[$key]) === 1)
        $errors[$key] = 'First name is required.';

    $key = 'lastname';
    if(!isset($form[$key]) || preg_match('/^\s*$/', $form[$key]) === 1)
        $errors[$key] = 'Last name is required.';

    $key = 'email';
    if(!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_EMAIL) === false)
        $errors[$key] = 'Email is invalid.';
    else if(getUser($form[$key]) !== false)
        $errors[$key] = 'Email is already registered.';

    $key = 'confirmEmail';
    if(!isset($form[$key]) || $form[$key] !== $form['email'])
        $errors[$key] = 'Email confirmation does not match.';
    
    $key = 'phone';
    if (isset($form[$key])) {
        $phone = preg_replace("/\s+/", "", $form[$key]);
        if(!isset($phone) || preg_match('/^\+614\d{8}$/', $phone) !== 1)
            $errors[$key] = 'Phone number is invalid. Must be in the format: +614xxxxxxxx';
    }
    
    $currentYear = date("Y");
    $key = 'age';
    if(!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_INT,
        ['options' => ['min_range' => $currentYear-100, 'max_range' => $currentYear-16]]) === false)
        $errors[$key] = 'Minimum age is 16.';

    $key = 'student-status';
    if(!isset($form[$key]) || preg_match('/^true|false$/', $form[$key]) !== 1)
        $errors[$key] = 'Must select student status.';

    $key = 'employment-status';
    if(!isset($form[$key]) || preg_match('/^true|false$/', $form[$key]) !== 1)
        $errors[$key] = 'Must select employment status.';
    
    $key = 'password';
    if(isset($form[$key]) && !preg_match("/^(?=.*[A-Z])(?=.*[-_])(?=.*[0-9])[A-Za-z0-9-_]{8,}$/", $form[$key])) {
        $errors[$key] = "Password must start with a capital alphabet, must have at least 8 characters, must have a hyphen or underscore (i.e. - or _) and must end with a number.";
    }
        
    $key = 'confirmPassword';
    if(isset($form['password']) && (!isset($form[$key]) || $form['password'] !== $form[$key]))
        $errors[$key] = 'Passwords do not match.';
    
    if(count($errors) === 0) {
        // Add user.
        $user = [
            'firstname' => htmlspecialchars(trim($form['firstname'])),
            'lastname' => htmlspecialchars(trim($form['lastname'])),
            'email' => trim($form['email']),
            'phone' => htmlspecialchars(trim($form['phone'])),
            'age' => filter_var($form['age'], FILTER_VALIDATE_INT),
            'student_status' => (int) filter_var($form['student-status'], FILTER_VALIDATE_BOOLEAN),
            'employment_status' => (int) filter_var($form['employment-status'], FILTER_VALIDATE_BOOLEAN),
            'password' => $form['password']
        ];

        // Insert user.
        insertUser($user);

        // Auto-login the registered user.
        loginUser([
            'email' => $user['email'],
            'password' => $form['password']
        ]);
    }

    return $errors;
}

// --- Services -------------------------------------------------------------------------------
function recordActivity($email, $serviceID, $form) {
    $errors = [];

    $key = 'duration';
    if(!isset($form[$key]) || filter_var($form[$key], FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1, 'max_range' => 480]]) === false)
        $errors[$key] = 'Duration must be a whole number and not be less than 1 or greater than 480.';
    
    if(count($errors) === 0) {
        // Prepare activity data.
        $activity = [
            'email' => $email,
            'service_id' => $serviceID,
            'service_type' => $form['type'],
            'duration_minutes' => filter_var($form['duration'], FILTER_VALIDATE_INT)
        ];
        // Insert activity into database.
        insertActivity($activity);
        
       
    }

    return $errors;
}

// --- Meal Planner -------
function generateMealPlan($form)
{

    $type = $form['mealType'];
    $numMeals = $form['numMeals'];
    $email = getLoggedInUser()['email'];
    $meals = getMealPlan($type);

    // insert to user_meal

    $newMeals = array();

    for ($mealNumber = 0; $mealNumber < $numMeals; $mealNumber++) {
        $meals = array();
        foreach ($meals as $meal) {
                array_push($meals, $meal);
            }
        }

        $randomMeals = array_rand($possibleMeals, 1);
        array_push($newMeals, $meals[$randomMeals]);
        $numServings = $newMeals[$mealNumber]['kilojoules'];

        $mealToInsert = [
            'email' => $email,
            'meal_id' => $newMeals[$mealNumber]['meal_id'],
            'servings' => $numServings
        ];

        insertMealPlan($mealToInsert);

    }
