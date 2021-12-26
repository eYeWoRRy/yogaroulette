
<html>
<head>
<title>Kleine Ranglisten</title>
<link rel="stylesheet" type="text/css" href="table.css">
<style>
.CSSTableGenerator {
	margin:0px;padding:0px;
	width:220px;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
</style>
</head>
<body style="background-color:#EBEBEB; background-image:none; margin:0; padding:0;">
<?php
require_once('includes/db_inc.php');
require_once('includes/debug.php');
require_once('includes/functions.php');
// DEBUG
//debugger("xxx"); }


$now = mysqli_fetch_row( mysqli_query( $dblink, "SELECT year FROM tournament group by year desc order by year DESC" ) );

(!isset($_GET['first'])) 		? $first 	= $now[0] 	: $first 	= $_GET['first'];
(!isset($_GET['second'])) 		? $second 	= "0" 		: $second 	= $_GET['second'];
(!isset($_GET['nodropdown'])) 	? $dropdown = true 		: $dropdown = false;
(!isset($_GET['limit']))		? $limit = 10			: $limit = $_GET['limit'];

//echo '<center>';

echo '<div class="CSSTableGenerator" >';
echo '<table style="width:220px; height:380px;"><tr><td>Pl.</td><td>Name</td>'; //Monate auch auflisten?
echo '<td>Pkt.</td></tr>'; 

$lauf = 0;
$rank = 1;
$points = 0;
$get_year_rank = mysqli_query($dblink, "SELECT sum( r.points ) AS gesamt, r.pid, p.vname, p.nname, p.id, p.hide FROM rel_play_tour r left join player p ON r.pid = p.id LEFT JOIN tournament t ON r.tid = t.id WHERE r.extra = 0 and r.online = 0 AND year = ".$first." GROUP BY r.pid order by gesamt desc LIMIT ".$limit." ");

while ( $year_rank = mysqli_fetch_row( $get_year_rank ) ) {
	$lauf++;

	echo '<tr>';
	( $year_rank[0] == $points ) ? $rank="-" : $rank=$lauf.'.';
	echo '<td style="text-align:center;">'.$rank.'</td>'; //Rank
	echo '<td>';  
	//Darf der Nachname gezeigt werden?
	echo showNachname( $year_rank[3], $year_rank[5]); //NNAME
	echo ', '.showVorname($year_rank[2]).'</td>'; //VNAME
	
	$points = $year_rank[0];
	echo '<td style="text-align:center;">'.$year_rank[0].'</td>'; // Punkte
	echo '</tr>';
}

//aktueller Stand der Rangliste - letztes Turnier, Timestamp
$last_update = mysqli_fetch_row(mysqli_query($dblink, "SELECT timestamp FROM tournament where extra = 0 ORDER BY date desc, timestamp DESC"));
echo '<td colspan="3" style="text-align:center;">Stand: '.date('d.m.Y - H:i',strtotime($last_update[0])).' Uhr</td>';
//echo '</center>';
//echo '</table></td></tr>';
echo '</table>';
echo '</div>';
echo '<br><br><br><br>';

mysqli_close($dblink);
?>
</body>
</html>