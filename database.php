<?php
	include_once 'config.php';

	class Database extends Config {
	
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

	  public function insert($name, $email, $phone, $password) {
	    $sql = 'INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password]);
		return true;		
	  }

	  public function checkUser($email, $password) {
	    $sql = 'SELECT email, password FROM users WHERE email = :email AND password = :password';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['email' => $email, 'password' => $password]);
		$row = $stmt->rowCount();
		if($row > 0){
		return true;
		}		
	  }

	  public function update($name, $email, $phone, $password, $id) {
	    $sql = 'UPDATE users SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password, 'id' => $id]);
	    return true;
	  }

	  public function delete($id) {
	    $sql = 'DELETE FROM users WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    return true;
	  }
	}
?>

