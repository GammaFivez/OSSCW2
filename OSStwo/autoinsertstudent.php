<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Insert multiple records into table called student
$sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('26346725', 'this', '1953-10-12', 'Bob', 'Rob', '22 Turn Road', 'HW', 'London', 'UK', 'HP31 6DA');";

$sql .= "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('25623452', 'will', '1963-9-12', 'John', 'Rob', '23 Left Road', 'HW', 'London', 'UK', 'HP32 4FD');";

$sql .= "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('34243636', 'be', '1983-8-12', 'George', 'Rob', '24 Right Road', 'HW', 'London', 'UK', 'HP33 2TR');";

$sql .= "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('23432543', 'automatically', '1993-7-12', 'Ben', 'Rob', '25 Up Road', 'HW', 'London', 'UK', 'HP34 1QE');";

$sql .= "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('45234234', 'added', '1943-6-12', 'lenny', 'Rob', '26 Down Road', 'HW', 'London', 'UK', 'HP35 9LA');";

if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>