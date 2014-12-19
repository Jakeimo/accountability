<?php
//$database = "personal_data";
$database = "personal_data_testing";
//$database = "jspikxqd_personal_data";
//$database = "jspikxqd_personal_data_testing";

$server = "localhost";
$user = "root";
$password = "password";
//$user = "jspikxqd";
//$password = "C8Ri_bCbOYFs2"; 
$mysqli = new mysqli($server, $user, $password, $database);

$weekAgo = date("Y-m-d", strtotime("-1 week"));

$stmt = $mysqli->prepare(
				"SELECT * 
				FROM dayData 
				WHERE date >= ?
				ORDER BY date ASC");
$stmt->bind_param("s", $weekAgo);
$stmt->execute();

$stmt->bind_result($id, $date, $sLength, $mSpent, $mEarnt, $hRating);

$resultCount = 0; $totalSpent = 0; $totalEarnt = 0; $totalStudy = 0; $avgHappy = 0; $happyCount = 0;
while($stmt->fetch()){
 	$resultCount++;
 	$totalSpent += $mSpent;
 	$totalEarnt += $mEarnt;
 	$totalStudy += $sLength;
 	$happyCount += $hRating;
}
$avgHappy = round($happyCount / $resultCount, 2);

echo "<thead> <tr> 
			<th>Total Study (hrs)</th> <th>$ Spent</th> 
			<th>Average Happiness (1-10)</th> </thead> <tbody>";
echo "<tr><td>" . $totalStudy . "</td> <td>" . $totalSpent . 
	"</td><td>" .$avgHappy . "</tr>";
echo "</tbody>";
