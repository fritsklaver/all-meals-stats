 <?php
 

$db = mysql_connect("127.0.0.1","root","free76");
if(!$db) die("Error connecting to MySQL database.");
mysql_select_db("allergy_food_joris" ,$db);

//$con = mysqli_connect("127.0.0.1","root","free76","allergy_food_joris");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?> 