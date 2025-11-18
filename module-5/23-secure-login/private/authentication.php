<?php

session_start();
require_once dirname(__DIR__, 3) . '/data/connect.php';
$connection = db_connect();

/** Authenticates user based on username and password.
 * @param string - Username
 * @param string - Password
 * @return mixed
 */
function authenticate($username, $password) {
    global $connection;
    $statement = $connection->prepare("SELECT `account_id`, `hashed_pass` FROM users WHERE `users` = ?;");
    if(!$statement) {
        die("Prepare failed: " . $connection->error);
    }

    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->store_result();

    if($statement->num_rows > 0) {
        $statement->bind_result($account_id, $hashed_pass);
        $statement->fetch();
        if(password_verify($password, $hashed_pass)){

            // to prevent session hijacking attacks, we can reset the session ID and data
            session_regenerate_id(TRUE);
            $_SESSION['user_id'] = $account_id;
            $_SESSION['username'] = $username;
            $_SESSION['last_regeneration'] = time();
            return TRUE;
        }
    }

    // if we have no results from the selected query
    return FALSE;
}

/** Checks if a user is logged in
 * 
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}


/** Redirect the user if they are not authenticated  
 * 
 */
function require_login() {
    if(!is_logged_in()) {
        // If the user is not logged in, we send them to the login page
        header("Location: login.php");
        // exit kills the rest of the script
        exit();
    }
}


/** Logs the user out 
 * 
 */
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}


?>