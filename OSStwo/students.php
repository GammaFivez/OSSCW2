<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   //Check to see if user has logged into his ID
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

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

      //Outputs the data into an html table
      $data['content'] .= '<form method="post">';
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='10' align='center'><h2>Students list</h2></th></tr>";
      $data['content'] .= "<tr><th>Student ID</th><th>DOB</th><th>First Name</th><th>Last Name</th><th>House</th><th>Town</th>
      <th>County</th><th>Country</th><th>Postcode</th><th>Student Image</th><th>Select</th></tr>";

      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
         $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>
         <td> $row[house] </td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td>
         <td> $row[postcode] </td><td> $row[studentimage] </td> </td> ";
          $data['content'] .= "<td> <input type ='checkbox' name='delrecords[]' value='".$row['studentid']."' </td></tr> </td>";
      }
      $data['content'] .= "</table>";
      $data['content'] .= "</br></br></br>";
      $data['content'] .= '<input type="submit" name="delete" value="Delete Records">';
      $data['content'] .= "</form>";
      
      
      //Checks how many checkbox are ticked and deletes the ones selected
      if(isset($_POST['delete'])){
        $checkboxcount = count($_POST['delrecords']);
        $i=0;
        //Records count that are going to be deleted
        while($i<$checkboxcount){                                 
          $theid = $_POST['delrecords'][$i];
          mysqli_query($conn, "DELETE FROM student WHERE studentid= '$theid'");
          $i++;
        }
         echo "<H3>Data successfully deleted!</H3>";
      }

      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php"); 
   mysqli_close($conn);
   ?>