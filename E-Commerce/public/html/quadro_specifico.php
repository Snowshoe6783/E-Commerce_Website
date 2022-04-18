<?php
	include("../../src/connessione_database.php");
  
	session_start();
	if(isset($_SESSION['utente_ID'])){
		echo "Benvenuto ".$_SESSION['utente_ID'];
	}

	$link_cartella_immagini = "../assets/img/quadri/";
?> 
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>quadro</title>
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
    <link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/style_pagina_quadro.css" type="text/css">
	<script type="text/javascript" src="../assets/js/quadro.js"></script>
  </head>
  <body class="body_quadro">
  <a href = "index.php">Home</a><br>
	<?php 
		$quantita_nel_carrello = 0;
		$query = "SELECT * 
				FROM quadro 
				WHERE quadro_ID = '".$_GET['quadro_ID']."';";

		$result = $conn -> query($query);

		$result -> fetch_all(MYSQLI_ASSOC);
		foreach($result as $row){
			$quadro_ID = $row['quadro_ID'];
			$link_quadro = $row['link_quadro'];		
			$nome_quadro = $row['nome_quadro'];
			$prezzo = $row['prezzo'];
			$nome_autore = $row['nome_autore'];
			$descrizione = $row['descrizione_dettagliata'];
			$quantita_in_magazzino = $row['quantita_in_magazzino'];

			if(isset($_SESSION['utente_ID'])){
				$query = "SELECT ordine_ID 
					FROM ordine AS o
					WHERE utente_ID = '".$_SESSION['utente_ID']."' 
					AND data_conferma IS NULL;";
														
																			
				$result = $conn -> query($query);	
				

				$n_rows = $result -> num_rows;

				if($n_rows != 0){
					foreach($result as $row){ //togli il for each se possibile
						$ordine_ID = $row['ordine_ID'];			
					}		

					$query = "SELECT quantita
					FROM acquisto AS a
					WHERE a.quadro_ID = '".$_GET['quadro_ID']."'
					AND a.ordine_ID = $ordine_ID;";

					$result = $conn -> query($query);

					foreach($result as $row){ //togli il for each se possibile
						$quantita_nel_carrello = $row['quantita'];		
					}
				}

				
			}

			//$result = $conn -> query($query);
			

					

			
			echo "<h1 class= \"Titolo_singolo_Quadro\">$nome_quadro</h1>";
			echo 
			"<div class=\"singolo_quadro\">  
				<img src=".$link_cartella_immagini.$link_quadro." alt = ".$nome_quadro." class=\"singolo_quadro\">
			</div>";
			echo
			"<div class=\"des_quadro\">  
					<p class = \"Autore_singolo_Quadro\">$nome_autore</p>
					<p class = \"Descrizione_singolo_Quadro\">$descrizione</p>
					<form method = \"post\" name = \"myform\" class=\"form_quadro\">
						<p class = \"Prezzo_singolo_Quadro\">il prezzo è: $prezzo €</p> c
						<p>Quantita in magazzino: $quantita_in_magazzino </p>
						<p>Quantita nel carrello: $quantita_nel_carrello </p>


					</form>
			</div>";// input da controllare virgolette per vedere se linka al db
		}
		?>

			<div id = "form_aggiungi_quadro_al_carrello">
			
			</div>
	
			<script>
				var quantitaAcquistabile = <?php echo(json_encode($quantita_in_magazzino - $quantita_nel_carrello)); ?>;
				const form_da_creare = document.getElementById('form_aggiungi_quadro_al_carrello');
				if(quantitaAcquistabile > 0){
					form_da_creare.innerHTML = 
						`
						<form method = "post" name = "myform">
						<div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
						<input type="number" id="number" name = "quantita_inserita" value="1" min = "1" max= '` + quantitaAcquistabile + `'/>
						<div class="value-button" id="increase" onclick="increaseValue(` + quantitaAcquistabile + `)" value="Increase Value">+</div>
						
						<input type = "submit" name = "aggiungi_al_carrello" value = "Aggiungi al carrello">
						</form>
						`;
						
				}else{
					form_da_creare.innerHTML = 
						`
						Il prodotto non è più disponibile, o hai inserito troppi quadri nel carrello.
						`;
				}
			</script>	



		<?php
			if(isset($_POST['aggiungi_al_carrello'])){
				if($_POST['quantita_inserita'] > ($quantita_in_magazzino - $quantita_nel_carrello)){
					echo "Quantita troppo alta";

				}			
				else if(isset($_SESSION['utente_ID'])){
					$query = "SELECT ordine_ID
						FROM ordine AS o
						WHERE utente_ID = '".$_SESSION['utente_ID']."' 
						AND data_conferma IS NULL;";
															
																				
					$result = $conn -> query($query);	
					echo $query;

					foreach($result as $row){ //togli il for each se possibile
						$ordine_ID = $row['ordine_ID'];			
					}		
					
					
					$n_rows = $result -> num_rows;
					
					if ($n_rows == 0) { 
						echo "Nessun ordine trovato oppure l'ordine e' gia' stato confermato, quindi creo nuovo ordine";

						$query = "SHOW TABLE STATUS LIKE 'ordine'"; //trovo l'ID del prossimo ordine
						$result = $conn -> query($query);	
						foreach($result as $row){ //togli il for each se possibile
							$auto_increment_value_ordine_ID = $row['Auto_increment'];			
						}
						
						$date = date('Y-m-d H:i:s');
						echo $date;

						$query = "INSERT INTO ordine VALUES('0', '".$_SESSION['utente_ID']."', NULL, NULL, NULL, '$date', NULL, NULL, NULL, NULL);";
						echo $query;
						$result = $conn -> query($query);



						
						$query = "INSERT INTO acquisto VALUES('0', '$auto_increment_value_ordine_ID', '".$_GET['quadro_ID']."', ".$_POST['quantita_inserita'].");";
						echo $query;
						$result = $conn -> query($query);
					} else   {
						echo "Ordine Trovato, aggiungo un altro quadro.";							
						$query = "SELECT quadro_ID 
						FROM acquisto
						WHERE quadro_ID = '".$_GET['quadro_ID']."'
						AND ordine_ID = '$ordine_ID';";
															
																					
						$result = $conn -> query($query);		
						
						
						$n_rows = $result -> num_rows;
						
						if($n_rows == 0){
							echo "Ordine trovato, ma il quadro non è nel carrello quindi lo aggiungo";	
							$query = "INSERT INTO acquisto VALUES('0', $ordine_ID, '".$_GET['quadro_ID']."', ".$_POST['quantita_inserita'].");";
							echo $query;
							$result = $conn -> query($query);	
						}else{
							echo "Ordine con lo stesso quadro trovato, aumento quantita di 1";	
							$query = "UPDATE acquisto SET quantita = quantita + ".$_POST['quantita_inserita']." WHERE ordine_ID = $ordine_ID AND quadro_ID = '".$_GET['quadro_ID']."';";
							echo $query;
							$result = $conn -> query($query);	
						}
					}
					
				}else{
					echo "Devi essere loggato per poter aggiungere un prodotto al carrello.";
					
					
					
				}
				
				
				$conn->close();
				//header("location: quadro_specifico.php?quadro_ID=".$_GET['quadro_ID']."");
			}
		?>
	
   
	
	
	<script> //serve per cancellare il form dopo che e' stato inserito nel DB
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>

  </body>
  
</html>