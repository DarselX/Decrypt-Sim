<?php 
	header('Access-Control-Allow-Origin: *');	
	include('dbconnect.php');
	
	$accountname="";
	$check=null;
	$key=$_GET['key'];
	$pid=0;
	
	if(isset($_GET['key']))	
	{
		$con=mysqli_connect("localhost",$db[0],$db[1],"DecryptSim");

	// Check connection 
	if (mysqli_connect_errno()) 
	{ 
		echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	} 

	$query = "SELECT user_id FROM check_activation WHERE check_key='".$key."'";
	if($result = $con->query($query)){ $row=$result->fetch_row(); $pid=$row[0]; }
	
	$query="UPDATE usr SET is_active=1 WHERE id=".$pid;
	$con->query($query);
	
	$query="DELETE FROM check_activation WHERE user_id=".$pid;
	$con->query($query);
	
	$query="SELECT * FROM usr WHERE id=".$pid;
	if($result = $con->query($query)){ $row=$result->fetch_row(); $check=(bool)row['is_active']; $accountname=$row[1];}

	$con->close();
	}
	else
	{
		$check=0;
	}
?>
<html>
	<head><title>Account Activation</title>
	
	<style>
	.enjoy-css {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  margin: 12px;
  border: 4px double rgba(25,255,0,1);
  -webkit-border-radius: 8px;
  border-radius: 8px;
  font: normal 24px/3 Arial, Helvetica, sans-serif;
  color: rgba(25,255,0,1);
  text-align: center;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  background: rgb(0,0,0);
  -webkit-box-shadow: 5px 5px 8px 2px rgba(0,0,0,0.4) ;
  box-shadow: 5px 5px 8px 2px rgba(0,0,0,0.4) ;
  text-shadow: 0 0 9px rgba(20,255,20,0.7) ;
  -webkit-transition: color 200ms cubic-bezier(0.23, 1, 0.32, 1) 10ms;
  -moz-transition: color 200ms cubic-bezier(0.23, 1, 0.32, 1) 10ms;
  -o-transition: color 200ms cubic-bezier(0.23, 1, 0.32, 1) 10ms;
  transition: color 200ms cubic-bezier(0.23, 1, 0.32, 1) 10ms;
  -webkit-transform: rotateY(-0.5729577951308232deg)   ;
  transform: rotateY(-0.5729577951308232deg)   ;
}
	</style>
	
	</head>
	<body bgcolor="#000000">
	<div class="enjoy-css">Dein Account <?php echo $accountname; ?> wurde 
	<?php 
		if($check==true)
		{
			echo "erfolgreich aktiviert!";
		}
		else
		{
			echo "nicht erfolgreich aktiviert!";
		}
	?>
	<p><a href="http://darselx-gaming.ddnss.de/games/DecryptSim">Zurück zum Spiel</a></p>
	</div>
	</body>
</html>