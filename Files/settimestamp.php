<?php 
	header('Access-Control-Allow-Origin: *');
	
	include('dbconnect.php');
	
	$data = $_GET['data'];
    $return = GetApiKey($salt,$data);
	
	$con=mysqli_connect("localhost",$db[0],$db[1],"DecryptSim");

	// Check connection 
	if (mysqli_connect_errno()) 
	{ 
		echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	} 

	$sql = "SELECT user_id FROM lastlogon WHERE user_id=".$return[1];

	if($result=mysqli_query($con,$sql))
	{
	    $rowcount=mysqli_num_rows($result);
	    mysqli_free_result($result);
	}

	$heute = date("Y-m-d H:i:s");

	if($rowcount == 0)
	{
	    $sql="INSERT INTO lastlogon (user_id, last_login) VALUES (".$return[1].",'".$heute."')";
	}
	else
	{
	    $sql="UPDATE lastlogon SET last_login = '".$heute."' WHERE user_id = ".$return[1];
	}
	
	mysqli_query($con,$sql);

	$con->close(); 
?>
