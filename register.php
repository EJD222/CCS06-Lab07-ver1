<?php
require "vendor/autoload.php";
session_start();

// 2. Why do you think the session variable assignments are wrapped inside an if-else and try-catch statements?
/* This practice is to avoid errors that may occur in the session. The if-else statement checks to see if the required 
   fields are filled out. Try-catch, on the other hand, catches exceptions that may be thrown while setting 
   the session variables.*/

try {
    if (isset($_POST['complete_name']) && isset($_POST['email']) && isset($_POST['birthdate'])) {
        $_SESSION['user_fullname'] = $_POST['complete_name'];
        $_SESSION['user_email'] = $_POST['email'];
        $_SESSION['user_birthdate'] = $_POST['birthdate'];

        header('Location: quiz.php');
        exit;
    } else {
        throw new Exception('There is a missing basic information.');
    }
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
}