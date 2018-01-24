<?php
     error_reporting(E_ALL);
     $out=shell_exec('sqldata');
     $ex=explode(";",$out);
     $fordb=$ex[0];
     $salt=$ex[1];
     $fordb=base64_decode($fordb);
	 $db=explode(";",$fordb);
	 
	 function GetApiKey($salz,$params)
     {
	  $sub=substr($params,0,64);
	  $sub2=str_replace($sub,"",$params);

	  $hash = hash_hmac("sha256",str_replace("\n","",$sub2),str_replace("\n","",$salz));	
	  //var_dump($hash);
	  
	  $_back = explode(" ",$hash." ".base64_decode($sub2));
	  //echo "<br><br><p>Salz: ".$salz."</p><p>HMAC: ".$sub."<br>B64: ".$sub2."</p><br><p>Rückgabe: ";print_r($_back);
      return $_back;
     }
?>
