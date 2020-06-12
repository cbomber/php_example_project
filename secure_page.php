<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('config.php');

if(empty($_SESSION['authenticated'])){
    die('You are not permitted to view this page. Please <a href="index.php">Login</a> to proceed.');
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
    <body>
        <h1>Everything worked as expected!</h1>
        <p>Javascript was able to take user input from the front end and pass it to the middleware using AJAX. The middleware was then able to 
        connect to the database backend and retrieve the user information including the hashed password. </p>
        <p>The middleware was then able to verify the password, set the session for the user and respond to the front end with its results (success!).
        The set session signifies to secure pages like this one that the user is authenticated and can view this page and interact with anything on it. 
        </p>

        <p>There have two options to logout. <a href="logout.php">Option 1</a> is just a link to the logout script that will terminate the page 
        upon navigating to it. <a href="javascript:logout();">Option 2</a> utilizes the middleware and Javascript to do the same thing to 
        show a full middleware solution.<p>

        <script>
            function logout(){
                const XHR = new XMLHttpRequest();
                // Define what happens on successful data submission
                XHR.addEventListener( "load", function(event) {
                    var json = JSON.parse(event.target.responseText);
                    if(json.success){
                        alert(json.msg);
                        window.location.href = "index.php";
                    } else {
                        alert("Problem processing quote. Please make sure the form is complete.");
                    }
                });
                // Define what happens in case of error
                XHR.addEventListener( "error", function( event ) {
                    alert( 'Oops! Something went wrong.' );
                });
                // Set up our request
                XHR.open( "GET", "middleware/logout_user.php" );
                // The data sent is what the user provided in the form
                XHR.send();
            }


        </script>
    </body>
</html>

