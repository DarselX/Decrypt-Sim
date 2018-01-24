<?php
    header('Access-Control-Allow-Origin: *');

    include('dbconnect.php');

	$data = $_GET['data'];
    $return = GetApiKey($salt,$data);
	
	$r = str_replace("\"","",$data);
	$r = explode(" ",$r);

    if((string)$return[0] == (string)$r[0])
    {
       	$con=mysqli_connect("localhost",$db[0],$db[1],"DecryptSim");

	    // Check connection
     	if (mysqli_connect_errno())
	    {
	    	echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

	    $result = $con->query("SELECT email FROM usr WHERE email='".$return[1]."'");
	    $result2 = $con->query("SELECT username FROM usr WHERE username='".$return[2]."'");	    
		$cnt = $result->num_rows;
		$cnt2 = $result2->num_rows;
		
        if($cnt > 0){ echo "FAIL"; exit; }
        else {
         if($cnt2 > 0){ echo "FAIL"; exit; }
         else {
           echo "OK"; exit;
         }
        }
    }
    else
    {
        echo "API-Key falsch!";
    }
?>
