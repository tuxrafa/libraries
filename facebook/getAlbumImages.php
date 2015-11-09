<?php
// get these data here https://developers.facebook.com/tools/explorer?method=GET&path=318421794908261%3Ffields%3Dphotos%7Bimages%2Cname%7D&version=v2.5
$albumID = "albumid";
$token = "token";
$album = getFacebookAlbum($albumID, $token);
foreach ($album as $photo) {
  $class = "horizontal";
  if ($photo->height > $photo->width) {
      $class = "vertical";
  }
  echo "<img class='$class' src='".$photo->source."'><br>";
}

function getFacebookAlbum($albumID, $token) {
  $graph_url= "https://graph.facebook.com/v2.5/$albumID?fields=photos%7Bimages%7D&access_token=$token";

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $graph_url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

  $output = curl_exec($ch);
  curl_close($ch);

  $Allphotos = json_decode($output);
  foreach ($Allphotos->photos->data as $Photos) {
    $res[] = $Photos->images[0];
  }
  return $res;
}
