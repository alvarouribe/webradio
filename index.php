<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
.heading {
	text-align: center;
	font-weight:bold;
}
.stations {
	border:1px solid grey;
	padding: 5px;
	width: 49%;
	background-color: lightblue;
	float: left;
	margin: 3px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	-border-radius:5px;
}
.controls {
	border: 1px solid grey;
	padding: 5px;
	width: 20%;
	background-color: lightblue;
	float: left;
	margin: 3px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	-border-radius:5px;
}
</style>
</head>
<body>
<?php 
$stations = array("Coast FM" => "http://radionetworknz-ice.streamguys.com:80/coonline.mp3",
		"Life FM" => "http://wms-rbg.harmonycdn.net/lifefm",
		"Life FM Worship Stream"=>"http://wms-rbg.harmonycdn.net/lifefmworship");

//Playstation
if(isset($_REQUEST['station']))
{
	$station = urldecode($_REQUEST['station']);

	exec("killall -9 cvlc");
	exec("killall -9 vlc");
	exec("cvlc ".$stations[$station]." > /dev/null 2>/dev/null &");
}

//Turn stuff off
if(isset($_REQUEST['off']) && $_REQUEST['off'] == 'true')
{
	exec("killall -9 cvlc");
	exec("killall -9 vlc");
}

//Adjust volumn
if(isset($_REQUEST['vol']))
{
	if($_REQUEST['vol']=='plus')
	{
		exec("amixer set PCM 2dB+");
	}
	else
	{
		exec("amixer set PCM 2dB-");
	}
}
?>
<div class="stations">
<span class="heading">Stations</span><br>
<?php
//show list
foreach($stations as $station =>$url)
{
	echo "<a href=index.php?station=".urlencode($station)." >".$station."</a><br>";
}
?>
</div>
<div class="controls">
<span class="heading">Controls</span><br>
<div style="width: 100%;">
	<div style="float: left;width:50%;">Power</div>
	<div>
	<button style="float:right;width: 21px; height: 20px;background: url('images/off.png');" onclick="turnoff();"></button>
	</div>
</div>
<div style="clear: both;"></div>
<div>
<div style="float: left;width:50%;">Volumn</div>
<div style="width:21px;float: right;">
<button style="width: 20px; height: 20px;background: url('images/up.png');" onclick="return vol('plus');"></button>
<button style="width: 20px; height: 20px;background: url('images/down.png');" onclick="return vol('min');"></button>
</div>
</div>
</div>

<script language="javascript">
function vol(direction)
{
	$.ajax({
  		url: "index.php?vol="+direction
	});

	return false;
}
function turnoff()
{
	$.ajax({
  		url: "index.php?off=true"
	});
}
</script>
</html>
