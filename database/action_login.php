<?php
include_once(dirname(__FILE__) . '/connection.php');           // connects to the database
include_once(dirname(__FILE__) . '/users_database.php');      // loads the functions responsible for the users table
include_once(dirname(__FILE__) . '/../constants.php');

function check_creds(){
    if (session_status() == PHP_SESSION_NONE)
    session_start();
    global $login_errors;
    $WRONG_PASS = false;

    if (check_credentials($_POST['username'], $_POST['password'])){
        $_SESSION[$LOGGEDIN] = true;
        $_SESSION['username'] = $_POST['username'];
    } else if(is_registered($_POST['username'])) {
        $_SESSION[$LOGGEDIN] = false;
        $WRONG_PASS = true;
        $login_errors .= "Wrong password";
    } else {
        $login_errors .= "Wrong username";
    }
    $LOGGEDIN = "loggedin";

    if(isset($_SESSION[$LOGGEDIN])){
        if($_SESSION[$LOGGEDIN] == true){
            $referer = '../index.php';
            header('Location: ' . $referer);
        }
    }   // if login is correct redirects to index page
    else $referer = '../login_page.php';  // if login isn't correct stays on login page
    //
}
?>
