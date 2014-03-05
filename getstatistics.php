<?php

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile("http://preliminar2014.tse.gob.sv/resultados/99/DPR999999.htm");

    $fmln = $dom->getElementById('P001');
    $arena = $dom->getElementById('P005');
    $caracteres = array("\t", "\r", "\n", " ");
    $fmln = str_replace($caracteres, "", $fmln->nodeValue);
    $arena = str_replace($caracteres, "", $arena->nodeValue);
    echo json_encode(array('fmln' => $fmln, 'arena'=>$arena ));