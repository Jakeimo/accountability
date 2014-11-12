<?php 
$mysqli = new mysqli("localhost", "root", "password", "personal_data_testing");

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
$stmtStudy = $mysqli->prepare(
	"INSERT INTO study (date, length) VALUES (?, ?)");
$stmtStudy->bind_param("sd", $date, $studyLength);

$stmtMoney = $mysqli->prepare(
	"INSERT INTO money (date, spent, earnt) VALUES (?, ?, ?)");
$stmtMoney->bind_param('sdd', $date, $moneySpent, $moneyEarnt);

$stmtHappy = $mysqli->prepare(
	"INSERT INTO happiness (date, rating) VALUES (?, ?)");
$stmtHappy->bind_param('sd', $date, $happy);

$stmtHappy->execute();
$stmtMoney->execute();
$stmtStudy->execute();

if($mysqli->affected_rows != 1){
	//printf("Insertion failed. Rows Affected: %d\n", $mysqli->affected_rows);
	setcookie('Insertion', 'fail', time() + 2);
	header('Location: index.html'); 
} else {
	setcookie('Insertion', 'success', time() + 2);
	header('Location: index.html');
}
?>

