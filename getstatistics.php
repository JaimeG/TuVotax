<?php

    
    $dom = new DOMDocument('1.0');

    if(!$dom->loadHTML(curl("http://elecciones2014.tse.gob.sv/resultados_marzo/99/DPR999999.htm")))
        die('error');

    $procesadas = $dom->getElementById('proc_por');
    $noprocesadas = $dom->getElementById('nopro_por');
    $hora = $dom->getElementById('xhora');

    $finder = new DomXPath($dom);
    $nodes = $finder->query("//*[contains(@class, 'votos001')]");
    
    foreach ($nodes as $node) {
        $fmln = $node;
    }

    $nodes = $finder->query("//*[contains(@class, 'votos002')]");
    
    foreach ($nodes as $node) {
        $arena = $node;
    }

    $caracteres = array("\t", "\r", "\n", " ", "%");
    $fmln = str_replace($caracteres, "", $fmln->nodeValue);
    $arena = str_replace($caracteres, "", $arena->nodeValue);
    $procesadas = str_replace($caracteres, "", $procesadas->nodeValue);
    $noprocesadas = str_replace($caracteres, "", $noprocesadas->nodeValue);
    $hora = str_replace($caracteres, "", $hora->nodeValue);

    $file = "statistics.json";
    $fh = fopen($file, 'w') or die("can't open file");
    fwrite($fh, json_encode(
                    array(
                        'fmln' => $fmln, 
                        'arena'=>$arena, 
                        'procesadas' => $procesadas, 
                        'noprocesadas'=>$noprocesadas,
                        'hora'=>$hora
                        )
                    )
            );

    fclose($fh);

    // Defining the basic cURL function
    function curl($url) {
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }