<?php
    header('Access-Control-Allow-Origin: *');

    include('dbconnect.php');

	if(isset($_GET['data']))
	{
		$data = $_GET['data'];
		$return = GetApiKey($salt,$data);
		
		$ts=date("Y-m-d H:i:s");
		$usr=$return[1];
		$data=$return[2];
		
		if($result=$con->query("SELECT user_id FROM save WHERE user_id=".$usr))
		{
			$rowcount=mysqli_num_rows($result);
			mysqli_free_result($result);
		}
		
		if($rowcount == 0)
		{
			$con->query("INSERT INTO save(user_id, save, timestamp) VALUES (".$usr.",'".$data."',".$ts.")");
		}
		else
		{
			$con->query("UPDATE save SET save='".$data."', timestamp=".$ts." WHERE user_id=".$usr.")");
		}
	}
	else
	{
		exit;
	}		
?>