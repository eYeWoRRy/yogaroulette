<?php

echo '</head><center><table style="backgrund-color:#FFFFFF" width="80%"><tr style="background-color:#FFFFFF"><td style="text-align:center;">';
//echo '<title>Videos &auml;ndern - '.$page_title.'</title>';

//################################# T U R N I E R  Änderungen #######################################

$path = 'https://www.youtube.com/feeds/videos.xml?playlist_id=PL-G7EJFoxFcfy0_wup62gv1kGoSRJBmvF';
$xmlfile = file_get_contents($path);
$ob= simplexml_load_string($xmlfile);
$json  = json_encode($ob);
$configData = json_decode($json, true);

//echo $xmlfile;
// echo '<br><br>';
// echo $json;
// echo '<br><br>';
// echo $configData['title'];
// echo '<br><br>';

foreach ($ob->entry as $entry) {
  //foreach ($entry[0] as $entry_sub => $value1) {
    echo ''.$entry->title . ' - ';
    echo '' . str_replace('yt:video:','https://www.youtube.com/watch?v=',$entry->id) . '<br>';
}

// Und JSON
echo '<br><br>JSON<br><br>';



$json = '[{"id":"1","name":"Werner"},{"id":"2","name":"Paul"}]';
$json2 = '[{"id":"1","name":"Werner"},{"id":"2","name":"Paul"}]';
$json = json_decode($json, true);
$json2 = json_decode($json2);

foreach ($json as $element) {
 echo 'ID: ' . $element["id"] . ' - Name: ' . $element["name"] . '<br>';
 echo $json2->name[2];
}





$url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=50&playlistId=PL-G7EJFoxFcdBk6AruHtXT3BBWxW2_hL7&key=AIzaSyB8eHGnUp3bZfbGWilpYNMvXoAgbEIYRYY";
$json3 = file_get_contents($url);
$json3 = json_decode($json3, true);

$items_anz = count($json3['items']);
echo 'Items Anz: '.$items_anz.' <br>';
for ($i=1; $i<$items_anz; $i++) {
 echo $json3['items'][$i]['snippet']['title'].'<br>';
 echo $json3['items'][$i]['contentDetails']['videoId'].'<br>';
}


// echo $json3['items'][0]['kind'];
// echo '<br><br>';
//
// echo var_export($json3,true);








?>
