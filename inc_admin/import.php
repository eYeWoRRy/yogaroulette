<?php

echo '</head><center><table style="backgrund-color:#FFFFFF" width="400"><tr style="background-color:#FFFFFF"><td style="text-align:center;">';
echo '<title>Import Video - '.$page_title.'</title>';
//###################### I M P O R T  C O N F I R M E D #################################
if ($pmode == "confirmed") {

$max_arr = $_POST['max'];
	//Turnier Infos

//$game_name = $_POST['name'];
//echo 'Zusatz:'.$zusatz.'<br>';

// Turnier anlegen und ID mitnehmen
//mysqli_query( $dblink, "INSERT INTO tournament (name, year, month, date, type, member, extra, online) VALUES ('".$game_name."', '".$yranking."', '".$mranking."', '".$date."', '".$gametype."', '".($max_arr-1)."', '".$_POST['extra']."', '".$_POST['online']."') ");
//$game_id = mysqli_insert_id($dblink);

    // DEBUG
    //debugger("max_arr");

	//Importieren der einzelnen Spieler und dann eintragen in die DB
	for ($i=1; $i <= $max_arr; $i++) {
		//Namen
		$bn = 'bname'.$i; //beide Namen getrennt durch ", ";
		$aurl = 'url'.$i; //beide Namen getrennt durch ", ";
		$time = 'time'.$i;

		(!isset($_POST[$bn])) 			? $title 	= '' 	: $title 	= $_POST[$bn];
		(!isset($_POST[$aurl])) 		? $url 	= null 		: $url 	= $_POST[$aurl];
		(!isset($_POST[$time])) 		? $dauer 	= '' 	: $dauer 	= $_POST[$time];
		//$dauer = $_POST[$time];

		//echo $points.'<br>';
		//gibt es den die URL schon in der DB?
		$url_check = mysqli_query($dblink, "SELECT * FROM video WHERE url = '".$url."'");
        if (mysqli_num_rows($url_check) == 0) {
        	//Gibt es noch nicht - eintragen und ID mitnehmen :)
					if ($title <> '') {
        	mysqli_query($dblink, "INSERT INTO video (titel, url, timeid) VALUES ('".utf8_decode($title)."', '".$url."', '".$dauer."') ");
        	$url_sid = mysqli_insert_id($dblink);
					echo 'Eingetragen mit Titel: '.utf8_decode($title).' - Dauer: '.$dauer.'<br>';
					}
        } else {
        	//Gibt es schon - dann nur in Turnier eintragen, und sonst nichts machen - also ID mitnehmen.
        	//$p_check = mysqli_fetch_row($player_check);
        	//$player_id = $p_check[0];
					echo 'Eintrag schon vorhanden<br>';
        }

        // Player ID und Game ID sind da - kann also eingetragen werden
        //mysqli_query($dblink, "INSERT INTO rel_play_tour (pid, tid, points, rank, extra, online) VALUES ('".$player_id."', '".$game_id."', '".$points."', '".$i."', '".$_POST['extra']."', '".$_POST['online']."') ");




	} // END FOR Schleife

echo '<br><a href="admin.php?mode=import" target="_self">zur&uuml;ck</a>';

//###################### I M P O R T  P A R T 1 #################################
} elseif ($pmode == "input") {
	//Einlesen der Rangliste aus dem Textfeld ;-) Mal schaun ob das geht.
echo '<u>Kontrolle des Import</u><br><br>';
?>
<form method="post" action="<? echo $_SERVER['PHP_SELF']."?mode=import" ?>">
<?
//weiterleiten der Turniervariablen - damit erst nach bestätigen angelegt wird.
//echo '<input type="hidden" name="name" value="'.$_POST['name'].'">';
//echo $_POST['name'];

//  Alte Variante mit RSS Feed
$path = 'https://www.youtube.com/feeds/videos.xml?playlist_id='.$_POST['name'];
$xmlfile = file_get_contents($path);
$ob= simplexml_load_string($xmlfile);
$json  = json_encode($ob);
$configData = json_decode($json, true);
$max_arr = count($ob);

//echo $xmlfile;
// echo '<br><br>';
// echo $json;
// echo '<br><br>';
// echo $configData['title'];
// echo '<br><br>';

// NEUE VARIANTE MIT API AUFRUF #################################################################

$api_key = 'xxx';
$url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=50&playlistId='.$_POST['name'].'&key='.$api_key.'';
$json = file_get_contents($url);
$json = json_decode($json, true); // Wandelt JSON in ARRAY um

$items_anz = count($json['items']);
//echo 'Items Anz: '.$items_anz.' <br>';
//echo $json3['items'][$i]['snippet']['title'].'<br>';
//echo $json3['items'][$i]['contentDetails']['videoId'].'<br>';





	echo '<div class="CSSTableGenerator" >';
    echo '<table width="800">';
    echo '<tr><td>*</td><td>ID</td><td>Name</td><td>URL</td><td>Dauer</td><tr>';
		$url = '';
		$title = '';
		$i = 0;
		// ALTE VARIANTE
		// foreach ($ob->entry as $entry) {
		// 	$i++;

		for ($i=0; $i<$items_anz; $i++) {


		   //foreach ($entry[0] as $entry_sub => $value1) {
		    //echo ''.$entry->title . ' - ';
				$title = $json['items'][$i]['snippet']['title'];
		    //echo '' . str_replace('yt:video:','https://www.youtube.com/watch?v=',$entry->id) . '<br>';
				$url = $json['items'][$i]['contentDetails']['videoId'];


        echo '<tr>';
        //gibt es den Spieler schon in der DB?
        $url_check = mysqli_query($dblink, "SELECT * FROM video WHERE url = '".$url."'");
        if (mysqli_num_rows($url_check) > 0) {
            echo '<td style="background-color: #17e009; text-align:center;">in DB</td>';
            $control = false;

        } else {
            //Neu hinzufügen mit neuer Dauer
            //gerne auch einer BOOL

            $url_check2 = mysqli_query($dblink, "SELECT tid, dauer FROM time order by dauer asc");
            //if (mysqli_num_rows($url_check2) > 0) {
                echo '<td style="background-color: #C09433; text-align:center;">NEU</td>';
                $control = true;

            /*echo '<td><input type="text" name="vname'.$i.'" style="width:100px" value="'.$vname.'">';
            echo '<input type="text" name="nname'.$i.'" style="width:100px" value="'.$nname.'">&nbsp;&nbsp';
            echo 'VID: <input type="text" name="vid'.$i.'" style="width:40px">&nbsp;&nbsp;';
            //echo '<td><input type="text" name="motto'.$i.'" style="width:200px" value="'.$vname.'">&nbsp;&nbsp;</td>;';
            echo 'FavHand: <input type="text" name="favhand'.$i.'" style="width:40px">&nbsp;&nbsp;';
            echo '<input type="checkbox" name="buli'.$i.'" value="buli">Buli?</td>';*/

        } //END IF

        echo '<td style="text-align:center;">'.($i+1).'</td>';
        //echo '<td style="text-align:left;">';
        if ($control == true) {
            //Auflistung der Treffer + den Namen der wirklich übergeben wurde um als neu anzulegen - alles als DropDown
						echo '<td style="text-align:center;">'.$title.'</td>';
            echo '<input type="hidden" name="bname'.$i.'" value="'.$title.'">';
						echo '<td style="text-align:center;">'.$url.'</td>';
						echo '<td style="text-align:left;">';
						echo '<select name="time'.$i.'">';
						while ($urow = mysqli_fetch_row($url_check2)) {
								echo '<option value="'.$urow[0].'">'.$urow[1].'</option>';
						}
						echo '</select>&nbsp;Min.&nbsp;';
						echo '</td>';

        } else {
            //echo $url;
						echo '<td style="text-align:center;"><b>'.$title.'</b></td>';
						echo '<input type="hidden" name="bname'.$i.'" value="'.$title.'">';
						echo '<td style="text-align:center;">'.$url.'</td>';
						echo '<td style="text-align:left;"></td>';

        }
        echo '</td>';

				echo '<input type="hidden" name="url'.$i.'" value="'.$url.'">';
				//Ausgabe Dauer - bei nderungen
      echo '</tr>';

      //Übergabe in POST Parameter zum endgültigen Import in die DB und anlage eventuell neuer Spieler

} //END FOR  EACH SChleife
//$max_arr = count($entry);
    echo '</table></div>';
    echo '<input type="hidden" name="max" value="'.$items_anz.'">';

//Bestätigen des Imports - weiterschicken in neues POST SCRIPT
    echo '<br><br><input type="submit" value="Best&auml;tigen" class="button">';
    echo '<input type="hidden" name="pmode" value="confirmed">';
    echo '</form>';

    echo '<br><a href="admin.php?mode=import" target="_self">zur&uuml;ck</a>';

//###################### I M P O R T  Texfield #################################
} else {

    ?>

    <form method="post" action="<? echo $_SERVER['PHP_SELF']."?mode=import" ?>">
    <b>Einlesen einer XML ins System </b><br><br>
    <div class="CSSTableGenerator">
    <table>
    <tr><td style="text-align:center;" colspan="2">
    Kopierter die Playlist ID</td></tr>
    <tr><td width="20%">Playlist ID: </td>
    <td><input type="text" name="name" value="" style="width:300px">&nbsp;&nbsp;<br> Example: PL-G7EJFoxFcfy0_wup62gv1kGoSRJBmvF
    </td></tr>


    </table></div><br>
    <input type="submit" value="Weiter" class="button">
    <input type="hidden" name="pmode" value="input">
    </p>
    </form>

    <?
    echo '<br><a href="admin.php" target="_self">zur&uuml;ck</a>';

}


?>
