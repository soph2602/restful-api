<?php	
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Content-Type: application/json');
	
	include_once 'database.php';
	
	$user = new Database();

	
	$api = $_SERVER['REQUEST_METHOD'];

	
	if ($api == 'POST') {
         if(
        !empty($_POST['email']) && !empty($_POST['password'])
        ) {
	  $email = $user->test_input($_POST['email']);
	  $password = $user->test_input($_POST['password']);

      if($user->checkUser($email,$password)){
        echo $user->message('User login successful!',false);
      }     
	  else {
         echo $user->message('Incorrect login or password!',true);
        } 	 
	}
      else {
	     echo $user->message('Email and password cannot be empty!',true);
	  }
}
?>



