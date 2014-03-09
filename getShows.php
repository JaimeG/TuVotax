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
			'nombre' => 'Especial - Segunda vuelta Elecciones presidenciales 2014 - EN VIVO 16 horas de Transmición',
			'inicio' => "6:00 AM",
			'fin'=>  "9:59 AM",
			'invitados' => ''
		);

	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'GNX',
	// 		'inicio' => "8:00 AM",
	// 		'fin'=>  "8:59 AM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'En Vivo',
	// 		'inicio' => "9:00 AM",
	// 		'fin'=>  "9:59 AM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Videotópico',
	// 		'inicio' => "10:00 AM",
	// 		'fin'=>  "10:59 AM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Novascopio',
	// 		'inicio' => "11:00 AM",
	// 		'fin'=>  "11:59 AM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Las Trillizas de belleville',
	// 		'inicio' => "12:00 PM",
	// 		'fin'=>  "3:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Maratón anime - Dragon Ball Z',
	// 		'inicio' => "3:30 PM",
	// 		'fin'=>  "3:59 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Maratón anime - Los Caballeros del Zodiaco',
	// 		'inicio' => "4:00 PM",
	// 		'fin'=>  "4:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Maratón anime - Samurai Champloo',
	// 		'inicio' => "4:30 PM",
	// 		'fin'=>  "4:59 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Maratón anime - Full Metal Alchemist',
	// 		'inicio' => "5:00 PM",
	// 		'fin'=>  "5:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Maratón anime - Gungrave',
	// 		'inicio' => "5:30 PM",
	// 		'fin'=>  "5:59 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Maratón anime - Heroman',
	// 		'inicio' => "6:00 PM",
	// 		'fin'=>  "7:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Especial - Segunda vuelta Previo a las elecciones 2014',
	// 		'inicio' => "7:30 PM",
	// 		'fin'=>  "8:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'El Canto de Los Sueños',
	// 		'inicio' => "8:30 PM",
	// 		'fin'=>  "8:59 PM",
	// 		'invitados' => ''
	// 	);

	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'La Teta y La Luna',
	// 		'inicio' => "9:00 PM",
	// 		'fin'=>  "11:59 PM",
	// 		'invitados' => ''
	// 	);

	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Zarezion',
	// 		'inicio' => "9:30 PM",
	// 		'fin'=>  "9:59 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Bum Bam Pop',
	// 		'inicio' => "10:00 PM",
	// 		'fin'=>  "10:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Zarezion',
	// 		'inicio' => "10:30 PM",
	// 		'fin'=>  "10:59 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Bum Bam Pop',
	// 		'inicio' => "11:00 PM",
	// 		'fin'=>  "11:29 PM",
	// 		'invitados' => ''
	// 	);
	// array_push($shows,$programa);
	// $programa = array(
	// 		'nombre' => 'Hora de aventura',
	// 		'inicio' => "11:30 PM",
	// 		'fin'=>  "11:59 PM",
	// 		'invitados' => ''
	// 	);
	array_push($shows,$programa);

$actual = null;
$siguiente = null;

$indice=0;
$ahora=strtotime(date('G:i'));

$i=0;
for($i=0; $i<count($shows); $i++){
	$programa = $shows[$i];

	if( ( $ahora >= strtotime($programa["inicio"]) ) && ( $ahora <= strtotime($programa["fin"]) )){
		$actual = $programa;
		
		if($i+1 >= count($shows) )
			$siguiente = array('nombre' => "",'inicio' =>"" ,'fin' =>"", 'invitados' => ""  );
		else
			$siguiente = $shows[$i+1];

		break;
	}

}

echo json_encode(
	array(
		"hora_servidor"=>date("h:i"), 
		"actual"=>$actual,
		"siguiente"=>$siguiente
		)
	);