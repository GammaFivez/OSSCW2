<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.titleDiv {
  border: 5px outset grey;
  background-color: lightblue;
  text-align: center;
  text-transform: uppercase;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<div class="titleDiv">
<h1>Student Details</h1>
</div>

<div>
<form method ="post">
Student ID:
<input type ="number" name ="stdID" required/>
</br></br>
Password:
<input type ="text" name ="passwrdTxt" required/>
</br></br>
Date of Birth:
<input type ="date" name ="dob" required/>
</br></br>
First Name:
<input type ="text" name ="firstnameTxt" required/>
</br></br>
Last Name:
<input type ="text" name ="lastnameTxt" required/>
</br></br>
House Number + Road Name:
<input type ="text" name ="houseNroadTxt" required/>
</br></br>
Town:
<input type ="text" name ="townTxt" required/>
</br></br>
County:
<input type ="text" name ="countyTxt" required/>
</br></br>
Country:
<input type ="text" name ="countryTxt" required/>
</br></br>
PostCode:
<input type ="text" name ="postcodeTxt" required/>
</br></br>
Student Image:
<input type ="file" name ="studentImage" accept = "image/jpeg"/>
</br></br>
<input type ="submit" name="btnCreateStudent" value ="Save"/>
</form>
</div>
</html>

<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

//Check to see if user has logged into his ID
if (isset($_SESSION['id'])) {
  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");

//------------------------------------------------------------
      // Create connection
      $servername = "127.0.0.1";
      $username = "root";
      $password = "";
      $dbname = "db5";

      //Join Connection
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      //Select the columns within the table called Student
      $sql = "SELECT studentid, dob, firstname, lastname, house, town, county, country, postcode, studentimage FROM student;";

      $result = mysqli_query($conn,$sql);
//----------------------------------------------------------------------

$data['content'] .= '</form>';

//Initiliases user input into variables to be stored and adds protection against data injection.
if(isset($_POST['btnCreateStudent'])){
$ID = mysqli_real_escape_string($conn, $_POST['stdID']);
$password = mysqli_real_escape_string($conn, $_POST['passwrdTxt']);
$fname = mysqli_real_escape_string($conn, $_POST['firstnameTxt']);
$lname = mysqli_real_escape_string($conn, $_POST['lastnameTxt']);
$dateofbirth = mysqli_real_escape_string($conn, $_POST['dob']);
$house = mysqli_real_escape_string($conn, $_POST['houseNroadTxt']);
$town = mysqli_real_escape_string($conn, $_POST['townTxt']);
$county = mysqli_real_escape_string($conn, $_POST['countyTxt']);
$country = mysqli_real_escape_string($conn, $_POST['countryTxt']);
$postcode = mysqli_real_escape_string($conn, $_POST['postcodeTxt']);
$studentimg = mysqli_real_escape_string($conn, $_POST['studentImage']);

//Converts password textfield into hash
$hashedpass = password_hash($password, PASSWORD_DEFAULT);

//Validates whether the ID is  taken
$idcheck = mysqli_query($conn, "SELECT studentid FROM student WHERE studentid = $ID");

//Checks if ID is taken and if not then allow student to be added onto the database
$count = mysqli_num_rows($idcheck);
if($count>0)
{
  echo "<H3>there is already a student with this ID! Please try again.</H3>";
}
else
{
 $result = mysqli_query($conn, " INSERT INTO student(studentid, password, dob, firstname, lastname, 
 house, town, county, country, postcode, studentimage) VALUES
('$ID','$hashedpass', '$dateofbirth', '$fname', '$lname', '$house', '$town', '$county', '$country', '$postcode', '$studentimg');");
   echo "New user has been added!</H3>";
}

}
echo template("templates/default.php", $data); 
}

else 
{   
header("Location: index.php");
}
echo template("templates/partials/footer.php");
?>