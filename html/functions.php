<?php
session_start();
$errors = array();

// Connect to the database
$db = mysqli_connect('<RDS_Hostname>', '<RDS_Username>', '<RDS_Password>', '<RDS_DB_Name>', '<RDS_Port>');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['register_btn'])) {
    register();
}

// LOGIN USER
if (isset($_POST['login_btn'])) {
    login();
}

function register(){
    global $db, $errors;

    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);
    $user_type = e($_POST['user_type']) ?? 'user';

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $query = "INSERT INTO users (username, email, user_type, password) VALUES('$username', '$email', '$user_type', '$password')";
        if (mysqli_query($db, $query)) {
            $_SESSION['user'] = getUserById(mysqli_insert_id($db));
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Failed to register user: " . mysqli_error($db));
        }
    }
}

function login(){
    global $db, $username, $errors;

    $username = e($_POST['username']);
    $password = e($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $logged_in_user = mysqli_fetch_assoc($results);
            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success'] = "You are now logged in";

            if ($logged_in_user['user_type'] == 'admin') {
                header('location: admin_tooling.php');
            } else {
                header('location: index.php');
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

function isLoggedIn(){
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function isAdmin(){
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function display_error() {
    global $errors;
    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error .'<br>';
        }
        echo '</div>';
    }
}

function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
?>