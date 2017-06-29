<?php	
    header("Content-Type:text/html;charset=utf-8");   
	
	$link = @mysql_connect("localhost","root","root") or die("连接错误".mysql_error());
	
	//判断php100数据库是否存在，不存在则新建
	@mysql_select_db("dht",$link) or die(mysql_query("CREATE DATABASE dht"));
	
	//如果没有数据库则新建
	$sql = "
	CREATE TABLE IF NOT EXISTS user 
	(
	id int(11) not null auto_increment primary key,
	temp varchar(20) charset utf8,
	humi varchar(20) charset utf8,
	control varchar(20) charset utf8,
    time varchar(30) charset utf8
	)
	";
	mysql_query($sql) or die(mysql_error());	
	mysql_query("set names utf8");	
	
	$sql = "select * from user where id = '1'";
	$result = @mysql_query($sql) or die("错误：".mysql_error());
	$rs = mysql_fetch_array($result);
	if($rs["id"] != '1')
	{		
		//插入数据
		$sql = "INSERT INTO user (id, temp, humi) VALUES ('1', '  ', '  ')";
		@mysql_query($sql) or die("错误：".mysql_error());
		echo "add data";
	} 		
?>