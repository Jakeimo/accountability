<?php 
$database = "personal_data";
//$database = "personal_data_testing";
$mysqli = new mysqli("localhost", "root", "password", $database);

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

//Prepare sql statements, and bind parameters
$stmt = $mysqli->prepare(
	"INSERT INTO dayData (date, studyLength, moneySpent, moneyEarnt, happyRating) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sdddi", $date, $studyLength, $moneySpent, $moneyEarnt, $happy);

$stmt->execute();

if($mysqli->affected_rows != 1){
	//printf("Insertion failed. Rows Affected: %d\n", $mysqli->affected_rows);
	setcookie('Insertion', 'fail', time() + 2);
	header('Location: index.html'); 
} else {
	setcookie('Insertion', 'success', time() + 2);
	header('Location: index.html');
}
?>

