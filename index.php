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
<a href="index.php?off=true">Off</a><br>
<a href="index.php?vol=plus" onclick="return vol('plus');">^</a><br>
<a href="index.php?vol=min" onclick="return vol('min');">v</a><br>
</div>

<script language="javascript">
function vol(direction)
{
	$.ajax({
  		url: "index.php?vol="+direction
	});

	return false;
}
</script>
</html>
