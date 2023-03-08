<?php
// API anahtarınızı buraya girin
$api_key = 'API_KEY';

// İl ve ilçe listesi
$locations = array(
    array('Balıkesir', '39.6484, 27.8826'),
    array('Ayvalık', '39.3161, 26.6958'),
    array('Edremit', '39.5942, 27.0247'),
    array('Burhaniye', '39.4731, 26.9736'),
    array('Gönen', '39.0897, 27.7403'),
    array('Bandırma', '40.3524, 27.9767'),
    array('Manyas', '40.0459, 27.9578'),
    array('Erdek', '40.4061, 27.7858'),
    array('Susurluk', '39.9137, 28.1574'),
    array('Savaştepe', '39.5559, 27.1029'),
    array('Bigadiç', '39.3852, 27.3187'),
    array('Balya', '39.7808, 28.1166'),
    array('Dursunbey', '39.5969, 28.5672'),
    array('Havran', '39.4543, 27.9513'),
    array('Kepsut', '39.5837, 28.0456'),
    array('Marmara', '40.7433, 27.8397'),
    array('İvrindi', '39.7475, 27.6000')
);

// İki nokta arasındaki mesafeyi hesaplayan fonksiyon
function getDistance($orig, $dest, $api_key) {
    $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$orig.'&destinations='.$dest.'&key='.$api_key;
    $data = file_get_contents($url);
    $result = json_decode($data, true);
    return $result['rows'][0]['elements'][0]['distance']['value'];
}

// İl ve ilçeler arasındaki mesafeleri hesapla
for ($i = 0; $i < count($locations); $i++) {
    for ($j = 0; $j < count($locations); $j++) {
        if ($i != $j) {
            $orig = $locations[$i][1];
            $dest = $locations[$j][1];
            $distance = getDistance($orig, $dest, $api_key);
            echo $locations[$i][0].' - '.$locations[$j][0].': '.($distance/1000).' km<br>';
        }
    }
}
?>
