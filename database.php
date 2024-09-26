<?php
	include_once 'config.php';

	class Database extends Config {
	
	  public function fetch($id = 0) {
	    $query = 'SELECT * FROM users';
	    if ($id != 0) {
	      $query .= ' WHERE id = :id';
	    }
	    $stmt = $this->connection->prepare($query);
		if($id !=0){
			$stmt->execute(['id' => $id]);
		}	   
		$stmt->execute();
	    $rows = $stmt->fetchAll();
	    return $rows;
	  }

	  public function insert($name, $email, $phone, $password) {
	    $query = 'INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)';
	    $stmt = $this->connection->prepare($query);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password]);
		return true;	
	  }	

	  public function checkUser($email, $password) {
	    $query = 'SELECT email, password FROM users WHERE email = :email AND password = :password';
	    $stmt = $this->connection->prepare($query);
	    $stmt->execute(['email' => $email, 'password' => $password]);
		$row = $stmt->rowCount();
		if($row > 0){
		return true;
		}		
	  }

	  public function update($name, $email, $phone, $password, $id) {
	    $query = 'UPDATE users SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id';
	    $stmt = $this->connection->prepare($query);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password, 'id' => $id]);
	    return true;
	  }

	  public function delete($id) {
	    $query = 'DELETE FROM users WHERE id = :id';
	    $stmt = $this->connection->prepare($query);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }
	}
?>

