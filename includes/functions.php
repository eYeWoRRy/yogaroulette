<?php

require_once('debug.php');

// Globale Werte für Funktions

$monat = array(1=>"J&auml;nner", 2=>"Februar", 3=>"M&auml;rz", 4=>"April", 5=>"Mai", 6=>"Juni", 7=>"Juli", 8=>"August", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"Dezember");

//XP Berechnung
$f = array ('1' => 150, '2' => 120, 'FT' => 50, 'T' => 10, 'L' => 20);

// Functions Sammlung :-)

function shortMonth ( $m ) {

	global $monat;

	if ( ($m == 1) OR ($m == 3) ) {
		return substr($monat[$m], 0, 8);
	} else {
		return substr($monat[$m], 0, 3);
	}
}


function showNachname ( $nn , $bool ) {
	if ($bool == 1) {
		return substr(html_entity_decode($nn), 0, 1).'.'; //NNAME gekürzt
	} else {
		return html_entity_decode($nn); //NNAME Voll
	}
}

function showVorname ( $vn ) {
	//if ($bool == 1) {
	//	return substr(html_entity_decode($Vn), 0, 1).'.'; //VNAME gekürzt
	//} else {
	return html_entity_decode($vn); //VNAME Voll
	//}
}

function averagePoints ($points, $tours) {
	$average = $points / $tours;
	return number_format($average, 2, '.', '');
}

function clubRankName ( $rank ) {

	$rankName = array(
				0=>"Rang 1",
				1=>"Rang 2",
                2=>"Rang 3",
                3=>"Rang 4",
                4=>"Rang 5",
                5=>"Rang 6",
                6=>"Rang 7",
                7=>"Rang 8",
                8=>"Rang 9",
                9=>"Rang 10",
                10=>"Rang 11",
                11=>"Rang 12",
                12=>"Rang 13",
                13=>"Rang 14",
                14=>"Rang 15",
                15=>"Rang 16",
                16=>"Rang 17",
                17=>"Rang 18",
                18=>"Rang 19",
                19=>"Rang 20",
                20=>"Rang 21");

	return $rankName[$rank];
}

function showPlayerPageUrl ( $player ) {
	return '<a style="color:#000000;" href="player.php?id='.$player.'" target="_self" >';
}

function makeDottedUnderline ( $word ) {
	return '<a style="text-decoration:none; border-bottom: 1px dotted black;">'.$word.'</a>';
}

function getLevel ( $x ){
		return floor( sqrt( $x / 10 ) );
	}

function getXP ( $y ){
		return 10 * $y * $y;
	}

function calcXP ( $wins, $headsUp, $finalTable, $tours, $last, $f) {
	$xp = $wins * $f['1'] + $headsUp * $f['2'] + ($finalTable - $wins - $headsUp) * $f['FT'] + ($tours - $finalTable) * $f['T'] - $last * $f['L'];
	if ($xp < 0) $xp = 0;
	//$xp = $xp / $tours * 100;
	//floor($xp);
	return $xp;
}

function progressBar ( $xp ) {
	$currentLvlXP = getXP(getLevel($xp));
	$nextLvlXP = getXP(getLevel($xp)+1);
	$LvlXPdiff = $nextLvlXP - $currentLvlXP;
	$myXPdiff = $xp - $currentLvlXP;
	//echo ''.$currentLvlXP.' '.$nextLvlXP.' '.$LvlXPdiff.' '.$myXPdiff.'<br>';
	echo '<progress value="'.$myXPdiff.'" max="'.$LvlXPdiff.'"></progress>';
}


?>
