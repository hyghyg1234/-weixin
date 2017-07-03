<?php
	include("ControlConn.php");
	if(!empty($_GET["temp"]))	//判断get的值有没有
	{
		$temp = $_GET["temp"]; 
        $humi = $_GET["humi"]; 
        $time = date("Y-m-d H:i:s");
		//$sql = "update `user` set temp = '$temp', humi = '$humi',time = '$time'";
        //插入数据
		$sql = "INSERT INTO user (temp, humi, time) VALUES ('$temp', '$humi', '$time')";
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