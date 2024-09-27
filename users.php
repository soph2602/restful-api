<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Content-Type: application/json');

	include_once 'database.php';

	$db = new Database();

	$api = $_SERVER['REQUEST_METHOD'];

	$id = intval($_GET['id'] ?? '');

	if ($api == 'GET') {
	  if ($id != 0) {
	    $data = $db->fetch($id);
	  } else {
	    $data = $db->fetch();
	  }
	  echo json_encode($data);
	}

	if ($api == 'DELETE') {
	  if ($id != null) {
	    if ($db->delete($id)) {
	      echo $db->message('User deleted successfully!', false);
	    } else {
	      echo $db->message('Failed to delete an user!', true);
	    }
	  } else {
	    echo $db->message('User not found!', true);
	  }
	}

?>