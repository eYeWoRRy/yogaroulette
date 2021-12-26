
<html>
<head>
<title>Yoga Roulette mit Mady Morrison</title>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="shortcut icon" type="image/x-icon" href="./yoga.ico">
<style>

</style>
</head>
<body>
<?php
require_once('includes/db_inc.php');
require_once('includes/debug.php');
require_once('includes/functions.php');

// DEBUG
//debugger("xxx");

$page_title = "Yoga Roulette mit Mady Morrison";
(!isset($_POST['random'])) 	? $random = false : $random = true;
(!isset($_POST['kat'])) 		? $pkat 	= 0 		: $pkat 	= $_POST['kat'];

(!isset($_POST['time'])) 		? $ptime 	= -1 		: $ptime 	= $_POST['time'];
(!isset($_GET['time'])) 		? $time 	= $ptime 		: $time 	= $_GET['time'];

//echo 'Online: '.$online_check.' Offline: '.$offline_check.'<br>';

//$now = mysqli_fetch_row( mysqli_query( $dblink, "SELECT year FROM tournament group by year order by year DESC" ) );
	//$get_kat = mysqli_query($dblink, "SELECT * FROM kategorie ORDER BY kat asc");
	//$kaz_anz = mysqli_num_rows($get_kat);



echo '<center>';
//echo 'Online: '.$online_check.' Offline: '.$offline_check.'<br>';

//Drop Down anzeigen?
?>

<form method="post" action="<? echo $_SERVER['PHP_SELF']."" ?>">
<br><br>
<div class="CSSTableGenerator">
<table>
<tr><td style="text-align:center;" colspan="2">
Y O G A  -  R O U L E T T E</td></tr>
<tr><td width="20%">Länge: </td>
<td>
<?
//Auflisten aller Kategorien - alle gechecked ;-)
	// <input type="checkbox" name="online" value="yes" checked> Online
	// <input type="checkbox" name="extra" value="yes" checked> Sonderranking
	echo '<select name="time" id="time" onchange="location.href=\'index.php?time=\'+this.options[this.selectedIndex].value;">';
	//echo '<select name="time">';
	$get_time = mysqli_query($dblink, "SELECT tid, dauer FROM time ORDER BY dauer asc");
	 $all_time_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video"));
		 echo '<option value="0" ';
		 echo ($time == 0) ? 'selected="selected"' : '';
		 echo '> Zeit egal ('.$all_time_anz.') </option>';
	 //echo '<option value = "0">Alle</option>';
	while ($trow = mysqli_fetch_row($get_time) ) {
			$time_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video where timeid = '".$trow[0]."'"));
			if ($time_anz != 0) {
				echo '<option value="'.$trow[0].'" ';
				echo ($trow[0] == $time OR $trow[0] == $ptime) ? 'selected="selected"' : '';
				echo '>'.$trow[1].' Minuten';
				//Anzahl der Videos in diesem Zeitraum
				echo ' ('.$time_anz.')';
				echo '</option>';
			}
	}



	?>
</td></tr>
<tr><td>Kategorie: </td>
	<td>
<?
// Alle Kategorien auflisten
echo '<select name="kat">';
$get_kat = mysqli_query($dblink, "SELECT kid, kat FROM kategorie ORDER BY kat asc");
if ($pkat == 0 and $time == 0) {
		$all_kat_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video"));
} else {
		$all_kat_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video where timeid = '".$time."' "));
}
	echo '<option value="0" ';
	echo ($time == 0) ? 'selected="selected"' : '';
	echo '> Alle </option>';

while ($krow = mysqli_fetch_row($get_kat) ) {
	 if ($time == -1) $time = 0;
		$kat_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video where kid = '".$krow[0]."' and timeid = '".$time."'"));
		if ($kat_anz != 0) {
		echo '<option value="'.$krow[0].'" ';
			echo ($krow[0] == $pkat) ? 'selected="selected"' : '';
			echo '>'.$krow[1];
			// Anzahl
			echo ' ('.$kat_anz.')';
			echo '</option>';
		} else if ($time == 0) {
			$kat_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video where kid = '".$krow[0]."'"));
			if ($kat_anz != 0) {
			echo '<option value="'.$krow[0].'" ';
				echo ($krow[0] == $pkat) ? 'selected="selected"' : '';
				echo '>'.$krow[1];
				// Anzahl
				echo ' ('.$kat_anz.')';
				echo '</option>';
			}
		}
}

?>

</td>
</tr>
<tr><td style="text-align:center;" colspan="2">
<input type="submit" value="Zufallsgenerator" class="button">
<input type="hidden" name="pmode" value="input">
<input type="hidden" name="random" value="yes">
</td></tr>
<?
/*$input = preg_replace('/<br\\\\s*?\\/??>/i', "\\n", $input);*/
//$input = preg_replace("!(\r\n)|(\r)|(\n)|(\n\r)|(\t)!", "&nbsp;", $input);

echo '<tr><td style="text-align:center;" colspan="2">';
//echo '<textarea cols="60" rows="30" name="textfeld"></textarea>';
//wenn nichts, dann weiß
$lauf = 0;

//echo $time.' - '.$pkat;

if ($time != 0 and $pkat != 0) {
		$get_video = mysqli_query($dblink, "SELECT * FROM video where kid = '".$pkat."' and timeid = '".$time."'");
} else if ($time == 0 and $pkat == 0) {
		$get_video = mysqli_query($dblink, "SELECT * FROM video");
} else if ($time == 0) {
	$get_video = mysqli_query($dblink, "SELECT * FROM video where kid = '".$pkat."'");
} else if ($pkat == 0){
	$get_video = mysqli_query($dblink, "SELECT * FROM video where timeid = '".$time."'");
}


while ($vrow = mysqli_fetch_row($get_video) ) {
	$lauf++;
	$sid[$lauf] = $vrow[0];
	$vid[$lauf] = $vrow[1];
	$aufrufe[$lauf] = $vrow[5]+1;
}

//random()
if (isset($vid) and $ptime != -1) {
	$array_anz = count($vid);
	$random = rand(1,$array_anz);
	mysqli_query($dblink, "UPDATE video SET Aufrufe = '".$aufrufe[$random]."' WHERE vid = '".$sid[$random]."'");
	//echo $array_anz.'<br>';
	echo '<iframe width="600" height="400" src="https://www.youtube.com/embed/'.$vid[$random].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	echo '<br><br>'.$aufrufe[$random].'x aufgerufen ';
	//echo ($aufrufe[$random] == 1) 		? 'Aufruf' : 'Aufrufe';
	echo '</td></tr>';



} else {
	echo "Shanti Shanti<br>";
	echo '<img src="img/shantishanti.jpg" >';

}

?>
</table></div><br>

</p>
</form>

<?
//echo '</div>';
//aktueller Stand der Rangliste - letztes Turnier, Timestamp
//$last_update = mysqli_fetch_row(mysqli_query($dblink, "SELECT timestamp FROM tournament where extra = 0 ORDER BY date desc, timestamp DESC"));
//echo '<br><br>Stand: '.date('d.m.Y - H:i',strtotime($last_update[0])).' Uhr - ';
//<!-- Start of CuterCounter Code -->
echo '<a href="https://www.webfreecounter.com/" target="_blank"><img src="https://www.cutercounter.com/hits.php?id=hxdkddx&nd=5&style=122" border="0" alt="visitor counter"></a><br><br>';
//<!-- End of CuterCounter Code -->
echo '<a href="admin.php" target="_self">';
echo '<img src="./img/admin.png" width="15" />';
echo '</a>';
echo '</center>';

mysqli_close($dblink);
?>
</body>

</html>
