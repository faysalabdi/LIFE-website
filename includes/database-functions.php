<?php
//This code defines some constants that are used to connect to a MySQL database,
// such as the server name, database name, username, and password. 
//It then defines several functions that can be used to interact with the database.


// Constants.
const SERVER_NAME = 'rmit.australiaeast.cloudapp.azure.com';
const DB_NAME = 's3920007_wp_a2';
const USERNAME = DB_NAME;
const PASSWORD = 'abc123';
const DNS = 'mysql:host=' . SERVER_NAME . ';dbname=' . DB_NAME;



 // UTILS /////

//this function creates a new PDO connection to the MySQL database 
function createConnection() {
    return new PDO(DNS, USERNAME, PASSWORD);
}

function prepareAndExecute($query, $params = null) {
    $pdo = createConnection();
    $statement = $pdo->prepare($query);
    $statement->execute($params);

    return $statement;
}

function prepareExecuteAndFetchAll($query, $params = null) {
    $statement = prepareAndExecute($query, $params);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function prepareExecuteAndFetch($query, $params = null) {
    $statement = prepareAndExecute($query, $params);

    return $statement->fetch(PDO::FETCH_ASSOC);
}


//USERS /////

//getUsers function retrieves all the users from the user table in the database.
//The results are then returned.
function getUsers() {
    $pdo = createConnection();
    $statement = $pdo->prepare('select * from user');
    $statement->execute();


    return $statement->fetchAll();
}


//getUser function retrieves a single user from the user table in the database by their email.
//The result is then returned.
function getUser($email) {
    $pdo = createConnection();
    $statement = $pdo->prepare('select * from user where email = :email');
    $statement->execute(['email' => $email]);


    return $statement->fetch();
}


//insertUser function inserts a new user into the user table in the database.
//The function will return true if the insert is successful and false otherwise.
function insertUser($user) {
    $pdo = createConnection();
    $statement = $pdo->prepare(
        'insert into user
        (email, password, first_name, last_name, phone, age, is_student, is_employed) values
        (:email, :password, :firstname, :lastname, :phone,2023- :age, :student_status, :employment_status)');

    return $statement->execute($user);
}

// SERVICES ///
function getServices() {
    return prepareExecuteAndFetchAll('select * from service');
}

function getService($id) {
    return prepareExecuteAndFetch('select * from service where service_id = :id', ['id' => $id]);
}

function getServiceInstructions($id) {
    return prepareExecuteAndFetchAll('select * from service_instruction where service_id = :id', ['id' => $id]);
}

function getServiceInstruction($id, $type) {
    return prepareExecuteAndFetch(
        'select * from service_instruction where service_id = :id and service_type = :type',
        ['id' => $id, 'type' => $type]);
}

function insertActivity($activity) {
    return prepareAndExecute(
        'insert into user_service
        (email, service_id, service_type, date_performed, duration_minutes) values
        (:email, :service_id, :service_type, now(), :duration_minutes)', $activity);
}
//retrieve all the different types of meals from the meal table:
function getMealOptions() {
    return prepareExecuteAndFetchAll('SELECT DISTINCT type FROM meal');
}
//retrieve all the rows from the meal table
function getMealPlan($type) {
    return prepareExecuteAndFetchAll('SELECT type, name, kilojoules FROM meal WHERE type = :type', ['type' => $type]);
}

function insertMealPlan($meal) {
    return prepareAndExecute(
        'insert into user_meal
        (email, meal_id, servings) values
        (:email, :meal_id, :servings)', $meal);
}

