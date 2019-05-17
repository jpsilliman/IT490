#!/usr/bin/php
<?php
    $url = "https://api.edamam.com/search?q=fish&app_id=305dd810&app_key=7a97bdc6180d36473b4b33cccecaa9a0&diet=high-protein&health=alcohol-free&health=sugar-conscious&health=tree-nut-free&health=peanut-free";
    $data = file_get_contents($url);
    $json = json_decode($data, true);
    foreach ($json['hits'] as $hit) {
        // Do whatever you want with this hit object at this point, I'm just getting the label for you
        echo($hit['recipe']['label'] . "\n");
    }
?>
