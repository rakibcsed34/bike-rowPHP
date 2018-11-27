<?php
/**
 * 
 */
class DB
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "bikestore";
	public $conn = '';


	public function connectDb()
	{
		// Create connection
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		}
		return $this->conn;
	}

	public function selectData($query)
	{
		$conn = $this->connectDb();
		$result = $conn->query($query);
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		return $data;
	}

	public function selectOneData($query)
	{
		$data = '';
		$conn = $this->connectDb();
		$result = $conn->query($query);
		if($result){			
			$data = $result->fetch_assoc();
			return $data;
		}else {
			return $data;
		}
	}

	public function updateData($query)
	{
		$conn = $this->connectDb();
		$data = $conn->query($query);
		return $data;
	}

	public function deleteData($query)
	{
		$conn = $this->connectDb();
		$data = $conn->query($query);
		return $data;
	}

	public function insertData($query)
	{
		$conn = $this->connectDb();
		$data = $conn->query($query);
		return $data;
	}


}

?>