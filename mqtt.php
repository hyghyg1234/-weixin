<?php  
  
require('lib/php_sam.php');
  
//create a new connection object  
//创建一个新的连接对象  
$conn = new SAMConnection();  
  
//start initialise the connection  
//开始初始化连接 SAM_HOST服务器host路径 ；SAM_PORT服务器port端口号  
$conn->connect(SAM_MQTT, array(SAM_HOST => '103.13.221.30',  
                               SAM_PORT => 1883));        
//create a new MQTT message with the output of the shell command as the body  
//建立一个新的MQTT shell命令的输出消息以作为主体（$msgCpu是通知内容）   
//new SAMMessage() 参数一般写为json格式  
$msgCpu = new SAMMessage("OPEN");  
  
//send the message on the topic cpu  
//发送该信息的主体  
//860173018344139是设备号，每一台android手机对应一个唯一的设备号   
//$msgCpu通知内容  
//send()推送通知  
$conn->send('topic://'.'pc', $msgCpu);  
  
//关闭连接  
$conn->disconnect();           

?> 