<?php
 include('dbconnection.php');

	if($_POST['formSubmit'] == "Submit") 
    {
		$errorMessage = "";
		
		if(empty($_POST['formMeal_name'])) 
        {
			$errorMessage .= "<li>You forgot to enter a meal name.!</li>";
		}
		if(empty($_POST['formMeal_remarks'])) 
        {
			$errorMessage .= "<li>You forgot to enter your meal remarks!</li>";
		}
		if(empty($_POST['formDate'])) 
        {
			$errorMessage .= "<li>You forgot to fill in the meal date and time!</li>";
		}

        $varMeal_name = $_POST['formMeal_name'];
		$varMeal_remarks = $_POST['formMeal_remarks'];
		$varDate = $_POST['formDate'];

		if(empty($errorMessage)) 
        {
			//$db = mysql_connect("127.0.0.1","root","free76");
			//if(!$db) die("Error connecting to MySQL database.");
			//mysql_select_db("allergy_food_joris" ,$db);

			$sql = "INSERT INTO meal_data (meal_name, meal_remarks, date) VALUES (".
							PrepSQL($varMeal_name) . ", " .
							PrepSQL($varMeal_remarks) . ", " .
                            PrepSQL($varDate) . ")";
							// PrepSQL($varGender) . ")";
			mysql_query($sql);
			// echo "$varMeal_name";
            // echo "$varDate";
			header("Location: thank-you.html");
			
			exit();
		}
	}
            
    // function: PrepSQL()
    // use stripslashes and mysql_real_escape_string PHP functions
    // to sanitize a string for use in an SQL query
    //
    // also puts single quotes around the string
    //
    function PrepSQL($value)
    {
        // Stripslashes
        if(get_magic_quotes_gpc()) 
        {
            $value = stripslashes($value);
        }

        // Quote
        $value = "'" . mysql_real_escape_string($value) . "'";

        return($value);
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>PHP Form processing example</title>
<!-- define some style elements-->
<style>
label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>	
</head>

<body>

       <?php
		    if(!empty($errorMessage)) 
		    {
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            }
        ?>

		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<p>
				<label for='formMeal_name'>How do you call your meal? For example boerenkool met worst.</label><br/>
				<input type="text" name="formMeal_name" maxlength="100" value="<?=$varMeal_name;?>" />
			</p>
			<p>
				<label for='formMeal_remarks'>What is your remark?</label><br/>
				<input type="textarea" name="formMeal_remarks" maxlength="500" size="500" value="<?=$varMeal_remarks;?>" />
			</p>
            
            <p>
				<label for='formDate'>What is date and time of the meal you want to add?</label><br/>
                <input size="16" type="text"     name="formDate">
                   
            </p>
<!--			<p>
				<label for='formGender'>What is your Gender?</label><br/>
				<select name="formGender">
					<option value="">Select...</option>
					<option value="M"<? if($varGender=="M") echo(" selected=\"selected\"");?>>Male</option>
					<option value="F"<? if($varGender=="F") echo(" selected=\"selected\"");?>>Female</option>
				</select>
			</p>
-->
   
			<input type="submit" name="formSubmit" value="Submit" />
		</form>
		


</body>
</html>