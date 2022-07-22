<?php  
class database{

	//DB Params
	private $dns = "mysql:host=b6uwtwasnlgiearhpn21-mysql.services.clever-cloud.com;dbname=b6uwtwasnlgiearhpn21";
	private $username = "u6udlpcx13c1akxn";
	private $password = "CXSx8mJRjRzqvplBlIUl";
	private $conn;

	//DB Connect
	public function connect(){
		$this->conn = null;
		try{
			$this->conn = new PDO($this->dns,$this->username,$this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(PDOException $e){
			echo "Connection failed: ".$e->getMessage();
		}

		return $this->conn;
	}
}
?>

