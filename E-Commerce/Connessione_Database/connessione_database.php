<?php
	$host =  "localhost"; //indirizzo della macchina dove è installato MySQL (nome o IP address)
	$user =  "root"; //nome dell'utente a cui sono stati concessi i privilegi per eseguire i comandi SQL
	$pass =  ""; //password associata all'utente $user, se c’è. 
	$db   =  "e-commerce_quadri"; //nome del databse

	$conn = new mysqli($host, $user, $pass, $db);

	if ($conn->connect_error) {
		die('Errore di connessione (' . $conn->connect_errno . ') '. $conn->connect_error);
	} else {
		//echo 'Connesso. ' . $conn->host_info . "\n";
	}	
?>