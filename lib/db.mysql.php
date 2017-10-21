<?php
class DB {
	// The database connection
	protected static $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {    
		$username = "inzoe";
		$password = "inzoe.1009";
		$dbname = "inzoe";
		
		// Try and connect to the database
		if(!isset(self::$connection)) {
			// Load configuration as an array. Use the actual location of your configuration file
			//$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/db_config.ini'); 
			//self::$connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
			self::$connection = mysqli_connect('localhost',$username, $password, $dbname);
		}
		
		// If connection was not successful, handle the error
		if(self::$connection === false) {
			// Handle error - notify administrator, log to a file, show an error screen, etc.
			return false;
		}
		self::$connection -> set_charset("utf8");

		return self::$connection;
    }

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
	public function close() {
		if(self::$connection === true) {
			mysqli_close(self::$connection);
			$this->is_connected = false;
		}
	}

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
		// Connect to the database
		//$connection = $this -> connect();
		$this -> connect();

		// Query the database
		$result = mysqli_query(self::$connection, $query);
		
		$this -> close();

		return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
		$rows = array();
		$result = $this -> query($query);

		// If query failed, return `false`
		if($result === false) {
			return false;
		}

		// If query was successful, retrieve all the rows into an array
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
		$connection = $this -> connect();
		return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
		$connection = $this -> connect();
		return "'" . $connection -> real_escape_string($value) . "'";
    }
}

/*
 * usage example

** db_config.ini
[database]
username = test
password = test123
dbname = test
 
** A select query:
$db = new DB();
$rows = $db -> select("SELECT `name`,`email` FROM `users` WHERE id=5");
 

** A Insert query:
// Our database object
$db = new DB();    

// Quote and escape form submitted values
$name = $db -> quote($_POST['username']);
$email = $db -> quote($_POST['email']);

// Insert the values into the database
$result = $db -> query("INSERT INTO `users` (`name`,`email`) VALUES (" . $name . "," . $email . ")");

*/
?>