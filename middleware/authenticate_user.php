<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../config.php');

//all mappers are designed to be persistent. 
$userMapper = new UserMapper($config['db']);

//try and retrieve the user by the username
$user = $userMapper->getUserByUsername($_POST['Username']);

if(isset($user)){

    if(evaluatePassword($_POST["Password"], $user->password)){
        echo json_encode(array( 
            'success' => true,
            'msg' => 'Login Successful!'
        ));

        $_SESSION['authenticated'] = true;

        exit();
    }

} 

echo json_encode(array( 
    'success' => false,
    'msg' => 'Login Failed!'
));


function evaluatePassword($password_from_front_end, $password_from_back_end){
    if (password_verify($password_from_front_end, $password_from_back_end)) {
        return true;
    } else {
        return false;
    }
}