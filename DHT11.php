<?php
	//mysql 查询
	
	header("Content-Type:text/html;charset=utf-8");   
	//echo'<meta http-equiv="refresh" content="4">';  //定时刷新
	$link = @mysql_connect("localhost","root","root") or die("连接错误".mysql_error());
	mysql_select_db("dht",$link);
	mysql_query("set names utf8");	

	//时间戳计算
	$sql = "select * from user where to_days(time) = to_days(now()) AND id > '1'";
	$result = @mysql_query($sql) or die("错误：".mysql_error());
	while($rs = mysql_fetch_array($result))
	{
		$time = $rs["time"];
		$sql1 = "select UNIX_TIMESTAMP('$time')";
		$result1 = @mysql_query($sql1) or die("错误：".mysql_error());
		while($rs1 = mysql_fetch_array($result1))
		{
			$time = ($rs1[0]*1000 + 28800000);
			$temp = $rs["temp"];
			$humi= $rs["humi"];
			$data =  $data.'['.$time.','.$temp.']'.',';
			$data1 =  $data1.'['.$time.','.$humi.']'.',';
		}
	}	
	$data = '['.rtrim($data,",").']';
	$data1 = '['.rtrim($data1,",").']';
	mysql_close();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8">
<link rel="icon" href="https://static.jianshukeji.com/highcharts/images/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">	<script src="https://img.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
	<script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>
	<script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>
	<script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
</head>
<body>
<!--
*************************************************************************
   Generated by HCODE at 2017-07-01 23:12:02
   From: https://code.hcharts.cn/demos/hhhhx1
*************************************************************************
 -->
	<div id="container" style="min-width:400px;height:400px"></div>

	<script>
	$(function () {
    $.getJSON('https://data.jianshukeji.com/jsonp?filename=json/usdeur.json&callback=?', function (data) {
        $('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '温湿度曲线'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                '鼠标拖动可以进行缩放' : '手势操作进行缩放'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    millisecond: '%H:%M:%S.%L',
                    second: '%Y-%m-%d %H:%M:%S',
                    minute: '%H:%M',
                    hour: '%H:%M',
                    day: '%m-%d',
                    week: '%m-%d',
                    month: '%Y-%m',
                    year: '%Y'
                }
            },
            tooltip: {
                dateTimeLabelFormats: {
                    millisecond: '%H:%M:%S.%L',
                    second: '%Y-%m-%d %H:%M:%S',
                    minute: '%H:%M',
                    hour: '%H:%M',
                    day: '%Y-%m-%d',
                    week: '%m-%d',
                    month: '%Y-%m',
                    year: '%Y'
                }
            },
            yAxis: {
                title: {
                    text: '值'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
            series: [{
                type: 'area',
                name: '温度',
                data: <?php echo $data; ?>
				},
				{
				type: 'area',               
                data: <?php echo $data1; ?>,
				name: '湿度'
				}
			]
			
        });
    });
});
</script>
</body>
</html>