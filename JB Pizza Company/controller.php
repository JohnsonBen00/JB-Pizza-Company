<?php
session_start();

include 'DataBaseAdaptor.php';

$_SESSION['message'] = '';

if (isset($_POST['amt']) && isset($_POST['pzID'])) {
    if (! isset($_SESSION['user'])) {
        header('Location: login.php');
    } else {
        $theDBA->addToCart($_SESSION['user'], $_POST['pzID'], $_POST['amt']);
        $_SESSION['message'] = "Added to cart!";
        header('Location: index.php');
    }
}

unset($_SESSION['registerError']);

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwords']) && $_POST['register'] === "Register") {
    
    if ($_POST['password'] != $_POST['passwords']) {
        $_SESSION['registerError'] = 'Passwords do not match.';
        header('Location: register.php');
    } else if ($theDBA->checkUser($_POST['username'])) {
        $theDBA->register($_POST['username'], $_POST['password']);
        $_SESSION['user'] = $_POST['username'];
        session_destroy();
        header('Location: index.php');
    } else {
        $_SESSION['registerError'] = 'Username is taken';
        header('Location: register.php');
    }
}

unset($_SESSION['loginError']);

if (isset($_POST['username']) && isset($_POST['password']) && $_POST['login'] === "Login") {
    
    if ($theDBA->verifyUser($_POST['username'], $_POST['password'])) {
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['message'] = "Welcome " . $_POST['username'];
        header('Location: index.php');
    } else {
        $_SESSION['loginError'] = 'Invalid credentials.';
        header('Location: login.php');
    }
}

if (isset($_POST['logout']) && $_POST['logout'] === 'Logout') {
    session_destroy();
    header('Location: index.php');
}

$var = $_GET ['function'];

if(strcmp($var, "getReviews")==0){
	$arr = $theDBA->getReviews();
	echo json_encode($arr);
	
}

?>