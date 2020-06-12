<?php require('config.php'); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
    <body>
        <form id="login_form" action="middleware/authenticate_user.php">
            
            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username">
            
            <br>           
            
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password">

            <br>

            <input type="submit" value="Submit">

        </form>
    </body>
    <script>
        window.addEventListener( "load", function () {

            const form = document.getElementById("login_form");
            form.addEventListener( "submit", function ( event ) {
                event.preventDefault();
                sendData();
            });
            function sendData() {
                const XHR = new XMLHttpRequest();
                // Bind the FormData object and the form element
                const FD = new FormData(form);
                // Define what happens on successful data submission
                XHR.addEventListener( "load", function(event) {
                    var json = JSON.parse(event.target.responseText);
                    if(json.success){
                        alert(json.msg);
                        window.location.href = "secure_page.php";
                    } else {
                        alert(json.msg);
                    }
                });
                // Define what happens in case of error
                XHR.addEventListener( "error", function( event ) {
                    alert( 'Oops! Something went wrong.' );
                });
                // Set up our request
                XHR.open( "POST", form.action );
                // The data sent is what the user provided in the form
                XHR.send( FD );
            }
        });
    </script>
</html>