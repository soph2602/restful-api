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
        !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])
        && !empty($_POST['password'])
        ) {
	  $name = $db->test_input($_POST['name']);
	  $email = $db->test_input($_POST['email']);
	  $phone = $db->test_input($_POST['phone']);
	  $password = $db->test_input($_POST['password']);

      if($db->checkUser($email,$password)){
        echo $db->message('User already registered!',true);
      }     
	  else {
         $db->insert($name,$email,$phone,$password);
         echo $db->message('User added successfully!',false);
        } 	 
	}
      else {
	     echo $db->message('Name, email, contact and password cannot be empty!',true);
	  }
}
?>

