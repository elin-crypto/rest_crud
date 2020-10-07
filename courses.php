<?php


include ('config/Database.php');
include ('classes/Courses.php');

//Headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, x-Request-With');


$method = $_SERVER['REQUEST_METHOD'];
// if a id parameter exist in url
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}



//connect to database
$database = new Database();
$db = $database->connect();

//instansiate class Courses for sql-queries
//send database-connection as parameter
$courses = new Courses($db);



switch($method) {
    case 'GET':
        if(isset($id)) {
            //function to read row with specific id
            $result = $courses->readOne($id);
        } else {
            //function to read data from table
            $result = $courses->read();
            
        }

        //Check if result isn't empty
        if(!$result) {
            http_response_code(404); //not found
            $result = array("message" => "Inga kurser hittade");
            
        } else {
            http_response_code(200); //ok
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        //Remove tags and makes special characters availble to store
        //and send input to the class proterties
        $courses->code = $data->code;
        $courses->name = $data->name;
        $courses->progression = $data->progression;
        $courses->syllabus = $data->syllabus;

        //Function to create row
        if($courses->create($data->code, $data->name, $data->progression, $data->syllabus)) {
            http_response_code(201); //created
            $result = array("message" => "Kurs tillagd");
        } else {
            http_response_code(503); //Server error
            $result = array("message" => "Kurs EJ tillagd");
        }
    break;
    case 'PUT':
        //if no id is sent - send error
        if(!isset($id)) {
            http_response_code(510); //Not extended
            $result = array("message" => "No id is sent");
        } else {
            $data = json_decode(file_get_contents("php://input"));
        }
        
        //Remove tags and makes special characters availble to store
        //and send input to the class proterties
        $courses->code = $data->code;
        $courses->name = $data->name;
        $courses->progression = $data->progression;
        $courses->syllabus = $data->syllabus;

        //run function for update row
        if($courses->update($id, $data->code, $data->name, $data->progression, $data->syllabus)) {
            http_response_code(200); //ok
            $result = array("message" => "Kursen är uppdaterad");
        } else {
            http_response_code(503); //server error
            $result = array("message" => "Kursen är inte uppdaterad");
        }
    break;
    case 'DELETE':
        //if no id is sent - send error
        if(!isset($id)) {
            http_response_code(510); //Not extended
            $result = array("message" => "Inget id är skickat");
        } else {
            if($courses->delete($id)) {
                http_response_code(200); //ok
                $result = array("message" => "Kursen är raderad");
            } else {
                http_response_code(503); //Server error
                $result = array("message" => "Kursen är inte raderad");
            }
        }
    break;

}

//return result as json
echo json_encode($result);

//close database connection
$db = $database->close();
















