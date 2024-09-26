<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Content-Type: application/json');

	include_once 'database.php';

	$user = new Database();

	$api = $_SERVER['REQUEST_METHOD'];

	$id = intval($_GET['id'] ?? '');

	if ($api == 'GET') {
	  if ($id != 0) {
	    $data = $user->fetch($id);
	  } else {
	    $data = $user->fetch();
	  }
	  echo json_encode($data);
	}

	if ($api == 'PUT') {
	  parse_str(file_get_contents('php://input'), $post_input);

	  $name = $user->test_input($post_input['name']);
	  $email = $user->test_input($post_input['email']);
	  $phone = $user->test_input($post_input['phone']);
	  $password = $user->test_input($_POST['password']);

	  if ($id != null) {
	    if ($user->update($name, $email, $phone, $password, $id)) {
	      echo $user->message('User updated successfully!',false);
	    } else {
	      echo $user->message('Failed to update an user!',true);
	    }
	  } else {
	    echo $user->message('User not found!',true);
	  }
	}

	if ($api == 'DELETE') {
	  if ($id != null) {
	    if ($user->delete($id)) {
	      echo $user->message('User deleted successfully!', false);
	    } else {
	      echo $user->message('Failed to delete an user!', true);
	    }
	  } else {
	    echo $user->message('User not found!', true);
	  }
	}

?>