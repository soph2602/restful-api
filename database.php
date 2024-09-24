<?php
	// Include config.php file
	include_once 'config.php';

	// Create a class Users
	class Database extends Config {
	  // Fetch all or a single user from database
	  public function fetch($id = 0) {
	    $sql = 'SELECT * FROM users';
	    if ($id != 0) {
	      $sql .= ' WHERE id = :id';
	    }
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    $rows = $stmt->fetchAll();
	    return $rows;
	  }

	  // Insert an user in the database
	  public function insert($name, $email, $phone, $password) {
	    $sql = 'INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password]);
		$row = $stmt->rowCount();
	    if($row > 0){
			return true;
		}		
	  }

	  // Login a user in the database
	  public function checkUser($email, $password) {
	    $sql = 'SELECT email, password FROM users WHERE email = :email AND password = :password';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email, 'password' => $password]);
		$row = $stmt->rowCount();
		if($row > 0){
			return true;
		}		
	  }

	  // Update an user in the database
	  public function update($name, $email, $phone, $password, $id) {
	    $sql = 'UPDATE users SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password, 'id' => $id]);
	    return true;
	  }

	  // Delete an user from database
	  public function delete($id) {
	    $sql = 'DELETE FROM users WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }
	}
?>

