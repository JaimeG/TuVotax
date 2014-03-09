<?php

    
    $dom = new DOMDocument('1.0');

    if(!$dom->loadHTML(curl("http://preliminar2014.tse.gob.sv/resultados/99/DPR999999.htm")))
        die('error');

    $procesadas = $dom->getElementById('res_pjrvesc_val');
    $noprocesadas = $dom->getElementById('res_jrvnoesc_val');
    $hora = $dom->getElementById('xhora');

    $fmln = $dom->getElementById('P001');
    $arena = $dom->getElementById('P005');

    $caracteres = array("\t", "\r", "\n", " ", "%");
    $fmln = str_replace($caracteres, "", $fmln->nodeValue);
    $arena = str_replace($caracteres, "", $arena->nodeValue);
    $procesadas = str_replace($caracteres, "", $procesadas->nodeValue);
    $noprocesadas = str_replace($caracteres, "", $noprocesadas->nodeValue);
    $hora = str_replace($caracteres, "", $hora);

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