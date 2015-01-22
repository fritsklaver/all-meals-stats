<?php
 include('dbconnection.php');

	if($_POST['formSubmit'] == "Submit") 
    {
		$errorMessage = "";
		
		if(empty($_POST['formMovie'])) 
        {
			$errorMessage .= "<li>You forgot to enter a movie!</li>";
		}
		if(empty($_POST['formName'])) 
        {
			$errorMessage .= "<li>You forgot to enter a name!</li>";
		}
		if(empty($_POST['formGender'])) 
        {
			$errorMessage .= "<li>You forgot to select your Gender!</li>";
		}

        $varMovie = $_POST['formMovie'];
		$varName = $_POST['formName'];
		$varGender = $_POST['formGender'];

		if(empty($errorMessage)) 
        {
			//$db = mysql_connect("127.0.0.1","root","free76");
			//if(!$db) die("Error connecting to MySQL database.");
			//mysql_select_db("allergy_food_joris" ,$db);

			$sql = "INSERT INTO food_allergic_reactions (moviename, yourname, Gender) VALUES (".
							PrepSQL($varMovie) . ", " .
							PrepSQL($varName) . ", " .
							PrepSQL($varGender) . ")";
			mysql_query($sql);
			echo "$varMovie";
			//header("Location: http://localhost/php-form-processing/thankyou.html");
			
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
				<label for='formMovie'>Which is your favorite movie?</label><br/>
				<input type="text" name="formMovie" maxlength="50" value="<?=$varMovie;?>" />
			</p>
			<p>
				<label for='formName'>What is your name?</label><br/>
				<input type="text" name="formName" maxlength="50" value="<?=$varName;?>" />
			</p>
			<p>
				<label for='formGender'>What is your Gender?</label><br/>
				<select name="formGender">
					<option value="">Select...</option>
					<option value="M"<? if($varGender=="M") echo(" selected=\"selected\"");?>>Male</option>
					<option value="F"<? if($varGender=="F") echo(" selected=\"selected\"");?>>Female</option>
				</select>
			</p>
			<input type="submit" name="formSubmit" value="Submit" />
		</form>
		


</body>
</html>