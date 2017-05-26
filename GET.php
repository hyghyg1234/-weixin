<?php
	include("ControlConn.php");
	if(!empty($_GET["temp"]))	//判断get的值有没有
	{
		echo $getresult = $_GET["temp"]; 
		$sql = "update `user` set temp = '$getresult'";		
		mysql_query($sql);
        $time = date("Y-m-d h:i:sa");
        $sql = "update `user` set time = '$time'";		
		mysql_query($sql);
	} 
	if(!empty($_GET["humi"]))	//判断get的值有没有
	{
		echo $getresult = $_GET["humi"]; 
		$sql = "update `user` set humi = '$getresult'";		
		mysql_query($sql);
	}
	if(!empty($_GET["control"]))	//判断get的值有没有
	{
		$sql = "select * from user where id = '1'";
		$result = @mysql_query($sql) or die("错误：".mysql_error());
		$rs = mysql_fetch_array($result);		
		echo $rs["control"];
	}
	mysql_close();			 
?>