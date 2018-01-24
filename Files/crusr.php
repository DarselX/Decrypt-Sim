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

		$sql = "INSERT INTO usr (id,username,email,passwd,is_active) VALUES (null,'" . $r[2] . "','" . $r[1] . "','" . sha1($r[3].$r[2].$salt) . "',0)";
		mysqli_query($con,$sql);
		
		$rhc = uniqid((string)$r[2], true);
		
		$sql="SELECT id AS id FROM usr WHERE username='" . $r[2] . "'";
		$getID=mysqli_fetch_assoc(mysqli_query($con,$sql));
		$result=$getID['id'];		
		
		$sql="INSERT INTO check_activation (user_id,check_key) VALUES (". $result . ",'" . $rhc . "')";
		mysqli_query($con,$sql);
		
		mysqli_close($con);		
		echo $rhc;
	}
	
?>
