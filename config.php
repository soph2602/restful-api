<?php
	class Config {
	
	  private const DBHOST = 'localhost';
	  private const DBUSER = 'root';
	  private const DBPASS = '';
	  private const DBNAME = 'restfulapidb';
	  
	  private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';
	
	  protected $connection = null;

	  public function __construct() {
	    try {
	      $this->connection = new PDO($this->dsn, self::DBUSER, self::DBPASS);
	      $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    } catch (PDOException $e) {
	      die('Connectionn Failed : ' . $e->getMessage());
	    }
	    return $this->connection;
	  }

	  public function test_input($data) {
	    $data = strip_tags($data);
	    $data = htmlspecialchars($data);
	    $data = stripslashes($data);
	    $data = trim($data);
	    return $data;
	  }

	  public function message($content, $status) {
	    return json_encode(['message' => $content, 'error' => $status]);
	  }
	}

?>
