<?php

echo '</head><center><table style="backgrund-color:#FFFFFF" width="80%"><tr style="background-color:#FFFFFF"><td style="text-align:center;">';
echo '<title>Videos &auml;ndern - '.$page_title.'</title>';
//################################# Video  Änderungen #######################################
if ($pmode == "input") {
//Änderungen speichern... :)
echo '&Auml;nderungen gespeichert<br><br>';
//hole die änderungen.
$anz = $_POST['anz'];

for ($i=1; $i<=$anz; $i++) {

    $pid = 'id'.$i;
    $id = $_POST[$pid];

    $pname = 'titel'.$id;
    $titel = $_POST[$pname];
    $ptype = 'url'.$id;
    $url = $_POST[$ptype];
    $pmonth = 'time'.$id;
    $dauer = $_POST[$pmonth];
    $pyear = 'kat'.$id;
    $kat = $_POST[$pyear];

    // $pdate = 'date'.$id;
    // $date = $_POST[$pdate];
    // $pextra = 'extra'.$id;
    // (!isset($_POST[$pextra])) ? $extra = 0 : $extra = $_POST[$pextra];
    // $ponline = 'online'.$id;
    // (!isset($_POST[$ponline])) ? $online = 0 : $online = $_POST[$ponline];

    //welche Daten?
    echo $id.' '.$titel.' '.$url.' '.$dauer.' '.$kat.'<br>';
    //mysql Update

    //video Update
    mysqli_query($dblink, "UPDATE video SET titel = '".$titel."', url = '".$url."', timeid = '".$dauer."', kid = '".$kat."' WHERE vid = '".$id."' ");
    //Kategorie Update
    //mysqli_query($dblink, "UPDATE rel_play_tour SET extra = '".$extra."', online = '".$online."' WHERE tid = '".$id."' ");
}
$timesid = mysqli_fetch_row( mysqli_query($dblink, "SELECT dauer,tid from time where tid = '".$dauer."'"));


echo '<br><a href="admin.php?mode=video_change&time='.$timesid[1].'" target="_self">zur&uuml;ck</a>';
//################################# T U R N I E R  löschen 2 #######################################
} else if ($pmode == "delete") {

	$tour_id = $_POST['tid'];
	$pw = $_POST['password'];

	//Passwort check
	if ( $pw == "aces1" ) {


    	//Betrifft dann welche Datensätze genau? Auflisten - und löschen :)
    	$get_tour = mysqli_query($dblink, "SELECT rank, pid, tid, points FROM rel_play_tour where tid = '".$tour_id."' ORDER BY rank ASC");
		while ($trow = mysqli_fetch_row($get_tour)) {
			echo 'Rang '.$trow[0].' - '.$trow[1].' - '.$trow[2].' - '.$trow[3].'<br>';
		}
		echo '<br>Wurden soeben gel&ouml;scht<br>';
		// DELETE Statement für rel_play_tour und tournament selber - also 2 DEL
		mysqli_query($dblink, "DELETE FROM rel_play_tour WHERE tid = '".$tour_id."' ");
		mysqli_query($dblink, "DELETE FROM tournament WHERE id = '".$tour_id."' ");
	} else {
		//PW Falsch
		echo 'keine Daten gel&ouml;scht, da das Passwort falsch ist';
	}

      echo '<br><a href="admin.php?mode=tour_change" target="_self">zur&uuml;ck</a>';

 //################################# T U R N I E R  löschen 1 #######################################
  } else if ($delmode == "yes") {
      //löschen, aber bestätigen, nicht gleich löschen, oder doch? Löschen per URL wäre aber ein wenig wild.
      //passwort bestätigung damit das nicht jeder machen kann... *pffft* wär ja noch schöne *huiuiui*

      ?>
      <form method="post" action="<? echo $_SERVER['PHP_SELF']."?mode=tour_change" ?>">

      <?

      //nochmal alles auflisten - und dann mit Passwort bestätigen
      //auflisten, weil ichs ja mit POST durchschleusen muss
      $tour_id = $_GET['tid'];
      $get_tour = mysqli_fetch_row( mysqli_query($dblink, "SELECT id, name, type, month, year, date FROM tournament where id = '".$tour_id."' ") );
      echo 'Soll das folgende Turnier wirklich gel&ouml;scht werden?<br><br>';

      echo '<div class="CSSTableGenerator" >';
	echo '<table>';

      echo '<tr><td>ID</td><td>Name</td><td>Gametype</td><td>Monat</td><td>Jahr</td><td>Datum</td></tr>';

      echo '<tr>';
      //ID
      echo '<td style="text-align:center;">'.$get_tour[0].'</td>';
      //Name
      echo '<td style="text-align:center;">'.$get_tour[1].'</td>';
      //Type
      echo '<td style="text-align:center;">'.$get_tour[2].'</td>';
      //
      echo '<td style="text-align:center;">'.$get_tour[3].'</td>';
      echo '<td style="text-align:center;">'.$get_tour[4].'</td>';
      echo '<td style="text-align:center;">'.$get_tour[5].'</td>';
      //echo '<option value="'.$trow[0].'">'.$trow[1].'</option>';
      echo '</td>';
      // Löschen Link anzeigen zum löschen
      //echo '<td style="text-align:center;"><a href="admin.php?mode=tour_change&delete=yes&tid='.$trow[0].'">L&ouml;schen</a></td>';
      echo '</tr>';
      echo '<tr><td style="text-align:center;" colspan="6">Mit Passwort best&auml;tigen<br>';
      echo '<input type="password" name="password" style="width:150px"><br>';
      echo '<input type="submit" value="Best&auml;tigen" class="button">';
      echo '<input type="hidden" name="pmode" value="delete">';
      echo '<input type="hidden" name="tid" value="'.$tour_id.'">';
      echo '</td></tr>';
      echo '</table></div>';

      echo '<br><a href="admin.php?mode=tour_change" target="_self">zur&uuml;ck</a>';

  //################################# T U R N I E R  Übersicht #######################################
} else {

      ?>
      <form method="post" action="<? echo $_SERVER['PHP_SELF']."?mode=video_change" ?>">

      <?
      echo 'Daten &auml;ndern oder l&ouml;schen<br>';
      echo '<select name="ranking" id="ranking" onchange="location.href=\'admin.php?mode=video_change&time=\'+this.options[this.selectedIndex].value;">';
      //Test mit fixen Werten, dann aus DB
      //Aus der DB auslesen - nur die Jahre
      $lauf = 0;
      (!isset($_GET['time'])) ? $time = 5 : $time = $_GET['time'];
      //$time = $_GET['time'];
      //$timesid = 0;
      $get_time = mysqli_query($dblink, "SELECT dauer, tid FROM time order by dauer asc");
      while ( $trow = mysqli_fetch_row($get_time) ) {
          $lauf++;
          if ( $lauf == 1 AND $dauer == "") $dauer = $trow[0];
          if ( $trow[1] == $time AND $timesid == "") $timesid = $trow[1];
          //if ($timesid == "") $timesid = $trow[1];
          //echo $dauer.' '.$timesid;
          $kat_anz = mysqli_num_rows(mysqli_query($dblink, "SELECT * FROM video where timeid = '".$trow[1]."'"));
      		if ($kat_anz != 0) {
            echo '<option value="'.$trow[1].'"';
            echo ($trow[1] == $time) ? 'selected="selected"' : '';
            echo '>'.$trow[0].' Minuten</option>';
          }
      }
      echo '</select><br><br>';

      echo '<div class="CSSTableGenerator" >';
	echo '<table>';

      echo '<tr><td>NR</td><td>Titel</td><td>URL</td><td>Dauer</td><td>Kategorie</td>';
      //echo '<td>Kat 2</td><td>Kat 3</td>';
      echo '<td></td></tr>';
      $lauf = 0;
      $get_videos = mysqli_query($dblink, "SELECT vid, titel, url, timeid, kid FROM video where timeid = '".$timesid."' ORDER BY titel ASC");

      while ($trow = mysqli_fetch_row($get_videos)){
      	$lauf++;
          echo '<tr>';
          echo '<td>'.$lauf.'</td>';
          echo '<input type="hidden" name="id'.$lauf.'" value="'.$trow[0].'">';
          echo '<td style="text-align:center;"><input type="text" name="titel'.$trow[0].'" value="'.$trow[1].'" style="width:400px">&nbsp; &nbsp;</td>';
          echo '<td style="text-align:center;"><input type="text" name="url'.$trow[0].'" value="'.$trow[2].'" style="width:200px">&nbsp; &nbsp;<a href="https://www.youtube.com/watch?v='.$trow[2].'">Link</a></td>';
          //Type - eher als Dropdown als als Box, oder?
          //echo '<td style="text-align:center;"><input type="text" name="type'.$trow[0].'" value="'.$trow[2].'" style="width:30px"> ('.$trow[7].')</td>';
          echo '<td style="text-align:center;">';
          echo '<select name="time'.$trow[0].'">';
          $get_time = mysqli_query($dblink, "SELECT tid, dauer FROM time ORDER BY dauer ASC");
          while ($type_row = mysqli_fetch_row($get_time)){
          	echo '<option value="'.$type_row[0].'" ';
          	echo ( $type_row[0] == $trow[3] ) ? 'selected' : '';
          	echo '>'.$type_row[1].' Minuten';
          	echo '</option>';
          }

          echo '</select></td>';

          //Kategorien
          echo '<td style="text-align:center;">';
          //aus der REL raus, wenns nichts gibt, nichts ausgeben
          echo '<select name="kat'.$trow[0].'">';
          echo '<option value="null"></option>';
          $get_kat_1 = mysqli_query($dblink, "SELECT kid, kat FROM kategorie ORDER BY kat ASC");
          while ($type_row = mysqli_fetch_row($get_kat_1)){
            $get_video_kat = mysqli_query($dblink, "SELECT kid FROM video ORDER BY kat ASC");
          	echo '<option value="'.$type_row[0].'" ';
          	echo ( $type_row[0] == $trow[4] ) ? 'selected' : '';
          	echo '>'.$type_row[1];
          	echo '</option>';
          }

          echo '</select></td>';

          // echo '<td style="text-align:center;">';
          // //aus der REL raus, wenns nichts gibt, nichts ausgeben
          // echo '<select name="kat2_'.$trow[0].'">';
          //
          // $get_kat_1 = mysqli_query($dblink, "SELECT kid, kat FROM kategorie ORDER BY kat ASC");
          // while ($type_row = mysqli_fetch_row($get_kat_1)){
          // 	echo '<option value="'.$type_row[0].'" ';
          // 	echo ( $type_row[0] == $trow[1] ) ? 'selected' : '';
          // 	echo '>'.$type_row[1];
          // 	echo '</option>';
          // }
          //
          // echo '</select></td>';
          //
          // echo '<td style="text-align:center;">';
          // //aus der REL raus, wenns nichts gibt, nichts ausgeben
          // echo '<select name="kat3_'.$trow[0].'">';
          // $get_kat_1 = mysqli_query($dblink, "SELECT kid, kat FROM kategorie ORDER BY kat ASC");
          // while ($type_row = mysqli_fetch_row($get_kat_1)){
          // 	echo '<option value="'.$type_row[0].'" ';
          // 	echo ( $type_row[0] == $trow[1] ) ? 'selected' : '';
          // 	echo '>'.$type_row[1];
          // 	echo '</option>';
          // }
          //
          // echo '</select></td>';

          echo '<td style="text-align:center;">';
          //echo '<a href="admin.php?mode=tour_change&delete=yes&tid='.$trow[0].'">';
          echo 'L&ouml;schen';
          //echo '</a>';
          echo '</td></tr>';

      }
      echo '</select>';
      echo '<input type="hidden" name="anz" value="'.$lauf.'">';
      ?>
      </td></tr></table></div><br>
      <input type="submit" value="&Auml;nderungen speichern" class="button">
      <input type="hidden" name="pmode" value="input">
      </p>
      </form>

      <?
      echo '<br><a href="admin.php" target="_self">zur&uuml;ck</a>';

 } // end IF Pmode :)

?>
