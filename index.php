<html>
<!-- Simple HTML form for gaining user input -->
<form action="index.php" method="POST">
<!-- Only username and password are required to login -->
<input type="text" name="username" placeholder="Username">
<input type="text" name="password" placeholder="Password">
<input type="submit" name="submit">
</form>
</html>
<?php
if (isset($_POST['submit'])) {
// Get the returned JSON formatted data of the username and password being used in the variable below.
    $responder = file_get_contents("http://global.gq/serviceLogin.php?login_username=" . $_POST['username'] . "&login_password=" . $_POST['password']);
    // Decode the JSON
    $decode    = json_decode($responder, true);
    
    // Check the status of the login operation
    switch ($decode['Data']['Status']) {
    // When you are successfully logged in.
        case "loggedIn":
            echo "Hello and welcome to our site, ".$decode['Data']['Username']."!";
            break;
            // When the account username entered does not exist.
        case "accountNotCreated":
            echo "The account entered does not exist.";
            break;
            // When the password is incorrect.
        case "accountPasswordWrong":
            echo "Incorrect password.";
            break;
    }
}
?>
