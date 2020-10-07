<?php

class Courses {
    private $conn;
    private $table;

    public $code;
    public $name;
    public $progression;
    public $syllabus;
    
    //_construct(db) - lagrar anslutning till databasen i klassens property "conn"
    public function __construct($db) {
        $this->conn = $db;
    }


    //read() - Hämtar alla rader från databastabellen "dogs", returnerar resultatet som en array.
    public function read() {
        $sql = "SELECT * FROM elin_cv.courses";

        // Prepare and execute statement
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
       
    }
    
    
    //readOne(id) - Tar ett id som argument, hämtar den rad från databasen där id = id, returnerar resultatet.
    function readOne($id) {
        $sql = "SELECT * FROM elin_cv.courses WHERE id=$id";

        // Prepare and execute statement
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //create() - Adds class properties code, name, progression, syllabus in a sql-query to add in database
    //returns true if sucsess
    function create($code, $name, $progression, $syllabus) {
        $sql = "INSERT INTO elin_cv.courses             
            SET 
                code = ?, name = ?, progression = ?, syllabus = ?";

        // Prepare and execute statement
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$code, $name, $progression, $syllabus])) {
            return true;
        } else {
            return false;
        }
        
    }

    //update(id) - Lägger in klassens properties(name, breed, color) samt id i en sql-fråga för att 
    //updatera en rad i databasen där id = id. Kör SQL-fråga och returnerar true om frågan har lyckats, annars false.
    function update($id, $code, $name, $progression, $syllabus) {
        $sql = "UPDATE elin_cv.courses
            SET 
                code = ?, name = ?, progression = ?, syllabus = ?
                    WHERE id = $id";

        // Prepare and execute statement
		$stmt = $this->conn->prepare($sql);
		if($stmt->execute([$this->code, $this->name, $this->progression, $this->syllabus])){
			return true;
		} else {
			return false;
		}
		
		
    }

    //delete(id) - Lägger in id i en SQL-fråga för att radera en specifik rad från databasen där id = id. Kör SQL-frågan 
    //och returnerar true vid lyckad radering, annars false.
    function delete($id) {
        $sql = "DELETE FROM elin_cv.courses WHERE id=$id";

        // Prepare and execute statement
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

  
}