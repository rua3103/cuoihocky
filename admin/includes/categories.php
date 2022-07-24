<?php  
class category{

	//DB Stuff
	private $conn;
	private $table = "blog_category";

	//Blog Categories Properties
	
	public $n_category_id;
	public $topic;
	public $nametopic;
	public $message;
	public $name;
	public $d_date_created;
	// public $d_time_created;

	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	//Read multi records
	public function read(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

	//Read one record
	public function read_single(){
		$sql = "SELECT * FROM $this->table WHERE n_category_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_category_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//Set Properties
			$this->n_category_id = $row['n_category_id'];
		$this->topic = $row['topic'];
		$this->nametopic = $row['nametopic'];
		$this->message = $row['message'];
		$this->name = $row['name'];
		$this->d_date_created = $row['d_date_created'];
		// $this->d_time_created = $row['v_time_created'];
		
	}

	//Create category
	public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET topic = :topic,
		          	  nametopic = :nametopic,
		          	  message = :message,
		          	  name = :name,
		          d_date_created = :date_created";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);  	

		//Clean data
		$this->topic = htmlspecialchars(strip_tags($this->topic));
		$this->nametopic = htmlspecialchars(strip_tags($this->nametopic));
		$this->message = htmlspecialchars(strip_tags($this->message));

		//Bind data
		$stmt->bindParam(':topic',$this->topic);
		$stmt->bindParam(':nametopic',$this->nametopic);
		$stmt->bindParam(':message',$this->message);
		$stmt->bindParam(':name',$this->name);
		$stmt->bindParam(':date_created',$this->d_date_created);

		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	//Update category
	public function update(){
		//Create query
		$query = "UPDATE $this->table
		          SET topic = :topic,
		          	  nametopic = :nametopic,
		          	  message = :message,
		          	  name = :name,
		          	  d_date_created = :date_created
		          WHERE 
		          	  n_category_id = :get_id";
		//Prepare statement
		$stmt = $this->conn->prepare($query);
		//Clean data
		$this->topic = htmlspecialchars(strip_tags($this->topic));
		$this->nametopic = htmlspecialchars(strip_tags($this->nametopic));
		$this->message = htmlspecialchars(strip_tags($this->message));
		//Bind data
		$stmt->bindParam(':get_id',$this->n_category_id);
		$stmt->bindParam(':topic',$this->topic);
		$stmt->bindParam(':nametopic',$this->nametopic);
		$stmt->bindParam(':message',$this->message);
		$stmt->bindParam(':name',$this->name);
		$stmt->bindParam(':date_created',$this->d_date_created);
		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	//Delete category
	public function delete(){

		//Create query
		$query = "DELETE FROM $this->table
		          WHERE n_category_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_category_id = htmlspecialchars(strip_tags($this->n_category_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_category_id);

		//Execute query
		if($stmt->execute()){
			return true;
		}

		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;

	}
}
?>

