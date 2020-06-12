<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

session_destroy();

echo json_encode(array( 
    'success' => true,
    'msg' => 'You have logged out.'
));