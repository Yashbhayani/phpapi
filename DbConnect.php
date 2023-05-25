<?php
	/**
	* Database Connection
	*/
	/*class DbConnect {
		private $server = 'localhost';
		private $dbname = 'react_crud';
		private $user = 'root';
		private $pass = '';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch (\Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
        
	}*/
	$con = mysqli_connect("localhost","root");
    if($con){
    }else{
        echo " no connection";
    }
    mysqli_select_db($con, 'react_crud');
	
?>