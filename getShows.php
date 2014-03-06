<?php
	// Get El Salvador time
	date_default_timezone_set("America/El_Salvador");

	$shows = array();
	$programa = array(
			'nombre' => 'Sin Transmición',
			'inicio' => "12:00 AM",
			'fin'=>  "5:59 AM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Class icons',
			'inicio' => "6:00 AM",
			'fin'=>  "7:59 AM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'GNX',
			'inicio' => "8:00 AM",
			'fin'=>  "8:59 AM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'En Vivo',
			'inicio' => "9:00 AM",
			'fin'=>  "9:59 AM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Videotópico',
			'inicio' => "10:00 AM",
			'fin'=>  "10:59 AM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Novascopio',
			'inicio' => "11:00 AM",
			'fin'=>  "11:59 AM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Cafeina',
			'inicio' => "12:00 PM",
			'fin'=>  "2:29",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Extravagando',
			'inicio' => "2:30 PM",
			'fin'=>  "3:29 PM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'BumBamPop',
			'inicio' => "3:30 PM",
			'fin'=>  "4:29 PM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Zarezion',
			'inicio' => "4:30 PM",
			'fin'=>  "5:29 PM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Audiopuntura',
			'inicio' => "5:30 PM",
			'fin'=>  "6:29 PM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Audiopuntura',
			'inicio' => "6:00 PM",
			'fin'=>  "6:29 PM",
			'invitados' => ''
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Zarezion',
			'inicio' => "6:30 PM",
			'fin'=>  "6:59 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Bum Bam Pop',
			'inicio' => "7:00 PM",
			'fin'=>  "7:29 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Zarezion',
			'inicio' => "7:30 PM",
			'fin'=>  "7:59 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Bum Bam Pop',
			'inicio' => "8:00 PM",
			'fin'=>  "8:29 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Zarezion',
			'inicio' => "8:30 PM",
			'fin'=>  "8:59 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Bum Bam Pop',
			'inicio' => "9:00 PM",
			'fin'=>  "9:29 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Zarezion',
			'inicio' => "9:30 PM",
			'fin'=>  "9:59 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Bum Bam Pop',
			'inicio' => "10:00 PM",
			'fin'=>  "10:29 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Zarezion',
			'inicio' => "10:30 PM",
			'fin'=>  "10:59 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Bum Bam Pop',
			'inicio' => "11:00 PM",
			'fin'=>  "11:29 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);
	array_push($shows,$programa);
	$programa = array(
			'nombre' => 'Hora de aventura',
			'inicio' => "11:30 PM",
			'fin'=>  "11:59 PM",
			'invitados' => 'Invitado 1 e Invitado 2'
		);

$actual = null;
$siguiente = null;

$indice=0;
$ahora=strtotime(date('G:i'));

$i=0;
while(($actual==null || $siguiente==null) && $i < count($shows)){
	$programa = $shows[$i];

	//echo strtotime($programa["inicio"]) . " - " .  $ahora . " - " . strtotime($programa["fin"]) . "<br>";

	if( ( $ahora >= strtotime($programa["inicio"]) ) && ( $ahora <= strtotime($programa["fin"]) )){
		$actual = $programa;
		$siguiente = $shows[$i+1];
		break;
	}
	$i++;
}

echo json_encode(
	array(
		"hora_servidor"=>date("h:i"), 
		"actual"=>$actual,
		"siguiente"=>$siguiente
		)
	);