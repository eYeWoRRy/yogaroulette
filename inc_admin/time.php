<?php

echo '<center><table style="backgrund-color:#FFFFFF" width="80%"><tr style="background-color:#FFFFFF"><td style="text-align:center;">';
//Neuen Gametype anlegen
echo '<title>Dauer &auml;ndern - '.$page_title.'</title>';
//###################### G A M E T Y P E Neu eintragen #################################
if ($pmode == "input") {
    //eingabe in Datenbank :)

	$anz = $_POST['anz'];


    for ($i=1; $i<=$anz; $i++) {

        $pid = 'id'.$i;
        $id = $_POST[$pid];
            // DEBUG
            // debugger("pid");
        $ptype = 'type'.$id;
        $type = $_POST[$ptype];

        //welche Daten?
        echo $id.' '.$type.'<br>';

        //mysql Update
        mysqli_query($dblink, "UPDATE time SET dauer = '".$type."' WHERE tid = '".$id."' ");

    }
    echo '<br>&Auml;nderungen gespeichert<br><br>';


    if ( $pname <> "" ) {
        mysqli_query($dblink, "INSERT INTO time (dauer) VALUES ('".$pname."') ");
        echo 'NEU: '.$pname.'<br>';
        echo 'Neuer Eintrag wurde in DB gespeichert';
    } else {
    	echo 'Es wurde KEIN neuer Eintrag angelegt';
    }

    echo '<br><br><a href="admin.php?mode=time" target="_self">zur&uuml;ck</a>';

} else {
    ?>
    <form method="post" action="<? echo $_SERVER['PHP_SELF']."?mode=time" ?>">

    <?
    //Auflistung der Datenbank
    echo '<br><br>Aktuell verf&uuml;gbare Video Dauer - neuen Typ am Ende eintragen<br>';
    echo '<center>';
    echo '<table width="300"><tr><td style="text-align:center;">';
    echo '<div class="CSSTableGenerator" >';
    echo '<table><tr><td>ID</td><td>Dauer</td></tr>';
    $lauf = 0;
    $get_type = mysqli_query($dblink, "SELECT tid, dauer FROM time order by dauer asc");
    while ($row = mysqli_fetch_row($get_type)) {
    	$lauf++;
        echo '<tr>';
        echo '<td style="text-align:center;">'.$row[0].'</td>';
        echo '<input type="hidden" name="id'.$lauf.'" value="'.$row[0].'">';
        echo '<td style="text-align:left;"><input type="text" name="type'.$row[0].'" value="'.$row[1].'" style="width:150px">&nbsp; Minuten &nbsp;</td>';
       	echo '</tr>';

    }
    echo '<tr><td style="text-align:center;">NEU</td>';
    echo '<td style="text-align:left;"><input type="text" name="name" style="width:150px">&nbsp; &nbsp;</td></tr>';
    echo '</table></div>';
    echo '<br><br><input type="submit" value="Speichern" class="button"><br>';
    echo '<input type="hidden" name="pmode" value="input">';
    echo '<input type="hidden" name="anz" value="'.$lauf.'">';
    echo '<br><a href="admin.php" target="_self">zur&uuml;ck</a>';
    echo '</td></tr></table>';
    echo '</center>';
}
?>
