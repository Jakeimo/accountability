<?php  
//$database = "personal_data";
//$database = "personal_data_testing";
//$database = "jspikxqd_personal_data";
$database = "jspikxqd_personal_data_testing";

$server = "localhost";
/*$user = "root";
$password = "password";*/
$user = "jspikxqd";
$password = "C8Ri_bCbOYFs2"; 
$mysqli = new mysqli($server, $user, $password, $database);

//Check Connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//Create local variables for insertion
$date = $_POST["date"];
$studyLength = $_POST["study"];
$moneySpent = $_POST["spend"];
$moneyEarnt = $_POST["earnt"];
$happy = $_POST["happiness"];

$dateCheckStmt = $mysqli->prepare(
	"SELECT id FROM dayData WHERE date=?");
$dateCheckStmt->bind_param("s", $date);
$dateCheckStmt->execute();
$dateCheckStmt->bind_result($id);
$dateCheckStmt->fetch();

if($id !== 0){ //An entry for this date has already been found
	setcookie('Insertion', 'repeat', time() + 2);
	header('Location: index.html'); 
	die();
} else { 
//Prepare sql statements, and bind parameters
$stmt = $mysqli->prepare(
	"INSERT INTO dayData (date, studyLength, moneySpent, moneyEarnt, happyRating) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sdddi", $date, $studyLength, $moneySpent, $moneyEarnt, $happy);

$stmt->execute();

setcookie('Insertion', 'success', time() + 2);	
header('Location: index.html');
}
?>

