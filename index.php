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
if( isset($_POST['submit'])){
	// The data we're posting.
	$dataArray = array(
		"login_username" => $_POST['username'],
		"login_password" => $_POST['password'],
        // Enter your token.
		"token" => ""
		);
	// Initialize a curl session.
	$curlHandler = curl_init();
	// Set the curl URL.
	curl_setopt($curlHandler, CURLOPT_URL, "http://global.gq/serviceLogin.php");
	curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlHandler, CURLOPT_POST, 1);
	curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $dataArray);
	// Executing.
	$execute = curl_exec($curlHandler);
	$returnData = $execute;
	$decode = json_decode($returnData, true);
	/**
	Status types:
	- "loggedIn": User is logged in.
	- "accountPasswordWrong": Password is incorrect.
	- "accountNotCreated": Account not does exist.
	**/
	switch($decode['Data']['Status']){
		case "loggedIn":
		echo "You have been logged in.";
		echo "Your email is ".$decode['Data']['Email'];
		break;
		case "accountPasswordWrong":
		echo "You entered an invalid password.";
		break;
		case "accountNotCreated":
		echo "That account does not exist.";
print_r($execute);
		break;
	}
	curl_close($curlHandler);
}
?>
