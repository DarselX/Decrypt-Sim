<?php
    header('Access-Control-Allow-Origin: *');

    include('dbconnect.php');

	$data = $_GET['data'];
    $return = GetApiKey($salt,$data);

    if($return[0] === substr($data,0,64))
    {
       	$con=mysqli_connect("localhost",$db[0],$db[1],"DecryptSim");

	    // Check connection
     	if (mysqli_connect_errno())
	    {
	    	echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

		$query="SELECT * FROM usr WHERE username='".$return[1]."' AND passwd='".sha1($return[2].$return[1].$salt)."'";
		if($_result = $con->query($query))
		{ 
			$row=$_result->fetch_row(); 
			$check=$row[4]; 
			
			if($check=="1")
			{
				$qz = "SELECT id FROM usr WHERE username='".$return[1]."' AND passwd='".sha1($return[2].$return[1].$salt)."'";
				//$qz = str_replace("\'","",$qz);
				$result = $con->query($qz);
		
				while($row = $result->fetch_array())
				{
					echo $row['id'];
				}
			}
			else if($check=="0")
			{
				echo "0";
			}
			else
			{
				echo "-1";
			}
		}
		else
		{
			echo "-1";
		}
        $con->close();
    }
    else
    {
        echo "API-Key falsch!";
    }
?>
