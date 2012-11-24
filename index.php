<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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

//show list
foreach($stations as $station =>$url)
{
	echo "<a href=index.php?station=".urlencode($station)." >".$station."</a><br>";
}
?>
<a href="index.php?off=true">Off</a><br>
<a href="index.php?vol=plus" onclick="return vol('plus');">^</a><br>
<a href="index.php?vol=min" onclick="return vol('min');">v</a><br>

<script language="javascript">
function vol(direction)
{
	$.ajax({
  		url: "index.php?vol="+direction
	});

	return false;
}
</script>
