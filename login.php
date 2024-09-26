<?php	
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Content-Type: application/json');
	
	include_once 'database.php';
	
	$db = new Database();

	
	$api = $_SERVER['REQUEST_METHOD'];

	
	if ($api == 'POST') {
         if(
        !empty($_POST['email']) && !empty($_POST['password'])
        ) {
	  $email = $db->test_input($_POST['email']);
	  $password = $db->test_input($_POST['password']);

      if($db->checkUser($email,$password)){
        echo $db->message('User login successful!',false);
      }     
	  else {
         echo $db->message('Incorrect login or password!',true);
        } 	 
	}
      else {
	     echo $db->message('Email and password cannot be empty!',true);
	  }
}
?>



