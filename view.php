<?php
header("Cache-Control: no-cache"); 
//$database = "personal_data";
//$database = "personal_data_testing";
$database = "jspikxqd_personal_data";
//$database = "jspikxqd_personal_data_testing";

/*$server = "localhost";
$user = "root";
$password = "password";*/
$user = "jspikxqd";
$password = "C8Ri_bCbOYFs2"; 
$mysqli = new mysqli($server, $user, $password, $database);


//Check Connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


if (is_ajax()) {
	if (isset($_GET[startDate])){
		$startDate = $_GET[startDate];
		$endDate = $_GET[endDate];

		$stmt = $mysqli->prepare(
				"SELECT * 
				FROM dayData 
				WHERE date <= ?
				ORDER BY date DESC");
		$stmt->bind_param("s", $startDate);
		$stmt->execute();
		//sql doesn't like the syntax or something here, not sure why
		$stmt->bind_result($id, $date, $sLenght, $mSpent, $mEarnt, $hRating);
		echo "<thead> <tr> 
			<th>Date</th> <th>Study (hrs)</th> <th>$ Spent</th> <th>$ Earnt</th>
			<th>Happiness (1-10)</th> </thead> <tbody>";
		while($stmt->fetch()){
			echo "<tr> <td> " . $date . "</td> <td>" . $sLenght . "</td> <td>" . $mSpent . 
			"</td> <td>" . $mEarnt . "</td> <td>" .$hRating . "</tr>";
		}
		echo "</tbody>";

	}
}

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>
