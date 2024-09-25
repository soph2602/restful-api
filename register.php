<?php
	// Include CORS headers
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Content-Type: application/json');

	// Include action.php file
	include_once 'database.php';
	// Create object of Users class
	$user = new Database();

	// create a api variable to get HTTP method dynamically
	$api = $_SERVER['REQUEST_METHOD'];

	// Register a new user into database
	if ($api == 'POST') {
         if(
        !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])
        && !empty($_POST['password'])
        ) {
	  $name = $user->test_input($_POST['name']);
	  $email = $user->test_input($_POST['email']);
	  $phone = $user->test_input($_POST['phone']);
	  $password = $user->test_input($_POST['password']);

      if($user->checkUser($email,$password)){
        echo $user->message('User already registered!',true);
      }     
	  else {
         $user->insert($name,$email,$phone,$password);
         echo $user->message('User added successfully!',false);
        } 	 
	}
      else {
	     echo $user->message('Name, email, contact and password cannot be empty!',true);
	  }
}
?>

