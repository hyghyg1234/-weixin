<?php	
    header("Content-Type:text/html;charset=utf-8");   
	
    // 连主库
    $link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);

    if($link) {
        $db = mysql_select_db(SAE_MYSQL_DB,$link);
        //var_dump($db);
        //your code goes here
        //echo "ok!";
    }				
	
	// Create database
	/* if (mysql_query("CREATE DATABASE dht",$link))
	{
		echo "Database created";
	}
	else
	{
		echo "Error creating database: " . mysql_error();
	}
	mysql_select_db("dht",$link); */
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