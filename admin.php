<?php session_start();

require_once('includes/db_inc.php');
require_once('includes/debug.php');
require_once('includes/functions.php');

// DEBUG
//debugger("xxx"); }


$page_title = "Yoga Admin";


//mysqli_select_db($dbname, $dblink) or die("Keine Verbindung zur Datenbank!");


// Alles mit $_GET abfangen :) und so mit den einganben switchen :)

(!isset($_GET['mode']))         ? $gmode = ""       : $gmode = $_GET['mode'];
(!isset($_POST['username']))    ? $suser = ""       : $suser = $_POST['username'];
(!isset($_POST['passwort']))    ? $spw = ""         : $spw = $_POST['passwort'];
(!isset($_POST['pmode']))       ? $pmode = ""       : $pmode = $_POST['pmode'];
(!isset($_POST['name']))        ? $pname = ""       : $pname = $_POST['name'];
(!isset($_POST['gmode']))       ? $gomode = ""      : $gomode = $_POST['gmode'];
(!isset($_GET['delete']))       ? $delmode = ""     : $delmode = $_GET['delete'];
(!isset($_POST['textfeld']))    ? $import_txt = ""  : $import_txt = $_POST['textfeld'];
(!isset($_GET['year']))         ? $year = ""        : $year = $_GET['year'];

//debugger("pmode", "pname", "gomode", "mode");
/*//Testausgaben:
echo 'Test';
//echo $import_txt;
echo ord('•');
echo '•';
echo utf8_decode('•');
echo utf8_encode('•');*/

//$input = htmlspecialchars($import_txt);
//$input = preg_replace("•", "#",$input);
//$input =  stripslashes($import_txt);
/*$normal = preg_replace('/<br\\\\s*?\\/??>/i', "\\n", $normal);*/
$import_txt = preg_replace("!(\r\n)|(\r)|(\n)|(\n\r)|(\t)!", " ", $import_txt);


// DEBUG
// debugger("suser", "spw");


if ( ($pmode == 'login') AND (!isset($_SESSION['username']) ) ) {
	if ( ( $suser == 'yoga' ) AND ( $spw == 'XXX' ) ) {
		$_SESSION['username'] = $suser;
		//header("location: admin.php");
	}
} else if ( ($gmode == 'logout') AND (isset($_SESSION['username']) )) {
	session_destroy();
	header("location: admin.php");
}

?>

<html>
<head>

<link rel="stylesheet" type="text/css" href="table.css">
<style>

</style>

<?

if (isset($_SESSION['username'])) {

	//###################### V I D E O S Importieren #################################
if ( $gmode == "import" ) {
include ('inc_admin/import.php');
//###################### V I D E O S #################################
} elseif ( $gmode == "video_change" ) {
	include ('inc_admin/video_change.php');
//###################### Kategorien  Ä N D E R N #################################
} elseif ($gmode == "kategorie") {#
	include ('inc_admin/kategorie.php');
//###################### Dauer  Ä N D E R N #################################
} elseif ($gmode == "time") {
	include ('inc_admin/time.php');
//###################### I N D E X #################################
} else { // Übersicht

    ?>
    <title><? echo $page_title ?></title>
    </head>
    <center>

    <table style="backgrund-color:#FFFFFF" width="500">
    <tr>
    <td style="text-align:center;">

    <div class="CSSTableGenerator" >
    <table width ="500" cellpadding="10" cellspacing="10">
    <tr><td colspan="3">Was m&ouml;chtest du &auml;ndern?<br></td></tr>
    <tr style="background-color:#FFFFFF">
		<td width="10%" style="text-align:center;">
	  <a href="admin.php?mode=import" target="_self">
	  <img src="img/video.png" height="75px" /><br><br>
	   Videos hinzuf&uuml;gen<a/>
	  </td>
    <td width="10%" style="text-align:center;">
    <a href="admin.php?mode=video_change" target="_self">
    <img src="img/video_change.png" height="75px" /><br><br>
    Videos &auml;ndern<a/>
    </td>

    </td>
    </tr>

    <tr style="background-color:#FFFFFF">
    <td width="10%" style="text-align:center;">

    <a href="admin.php?mode=kategorie" target="_self">
    <img src="img/kat.png" height="75px" /><br><br>
    Kategorien</a>

		<td width="10%" style="text-align:center;">
    <a href="admin.php?mode=time" target="_self">
    <img src="img/time.png" height="75px" /><br><br>
    Video Dauer</a>
    </td>
    <!-- <a href="admin.php?mode=player_change_basic" target="_self">
    <img src="img/team.jpg" height="75px" /><br><br>
    Spieler Profil Basis &auml;ndern</a>
    </td>
    <td width="10%" style="text-align:center;">
    <a href="admin.php?mode=player_change" target="_self">
    <img src="img/team.jpg" height="75px" /><br><br>
    Spieler Profil erweitert &auml;ndern</a>
		</td> -->
		<!-- </tr>
		<tr style="background-color:#FFFFFF"> -->
    <!-- <td width="10%" style="text-align:center;">
    <a href="admin.php?mode=import" target="_self">
    <img src="img/import.jpg" height="75px" /><br><br>
    Rangliste einlesen</a>
    </td>
    </tr> -->
    <tr><td colspan="5" style="text-align:center;"><a href="admin.php?mode=logout" target="_self">Ausloggen</a></td></tr>
    </table>
    </div>

    <?

} //end ELSE!! :)

} else { // SESSION

	//echo 'Einloggen!! :)';
	?>
	<title>Login</title>
	</head>
	<body>
 	<center>
	<table style="backgrund-color:#FFFFFF" width="40%">
    <tr>
    <td style="text-align:center;">
	<form method="post" action="<? print $_SERVER['PHP_SELF'] ?>">
	<div class="CSSTableGenerator">
	<table>
    <tr>
    <td style="text-align:center;">F&uuml;r den Yoga Admin Bereich anmelden</td></tr>
    <tr>
    <td style="text-align:center;">
		Name<br>
        <input type="text" name="username" class="eingabefeld" style="width:170px"><br>
        Passwort<br>
        <input type="password" name="passwort" class="eingabefeld" style="width:170px"><br><br>
        <div align="center"><input type="submit" value="Login" class="button"></div>
        <input type="hidden" name="pmode" value="login">

    </td>
    </tr>
    <tr><td style="text-align:center;"><a href="index.php" target="_self">zur&uuml;ck zum Roulette</a></td></tr>
    </table>
    </div>

    </form>
    <?

} // END SESSION IF

echo '</td></tr></table></center></body></html>';
mysqli_close($dblink);
?>
