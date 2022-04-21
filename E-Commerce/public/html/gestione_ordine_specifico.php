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
  	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>carrello</title>
    <link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">

  </head>
  <a href = "index.php">Home</a><br>
  <body>
    <h1>
      Carrello
    </h1>
    <?php
		$ordine_ID = $_GET['ordine_ID'];

				echo "<table border = \"1\">";
				$query = "";
				$flag = 0;
				if($flag == 0){
					$query = "SELECT q.quadro_ID AS 'Quadro ID', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							  FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN ordine AS o ON a.ordine_ID = o.ordine_ID
							  WHERE a.ordine_ID = $ordine_ID
							    AND o.data_annullamento IS NULL;";
							 
					$flag = 1;
					//echo "<br><br>start".$query;
					
				}
				
				else{	
					$query = "SELECT q.quadro_ID AS 'Quadro ID', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN ordine AS o ON a.ordine_ID = o.ordine_ID
							WHERE a.ordine_ID = $ordine_ID
							AND o.data_annullamento IS NULL;
							  UNION
							  $query";
						
					//echo "<br><br>big".$query;
							
					//non so perchè funziona sta roba
					
				}
			
			
			
			$prezzo_totale = 0;
			echo $query;
			$result = $conn -> query($query);

			$result_dettagli_quadri_ordinati = $result;
			
			$counter = 0;

			foreach($result as $row){
				echo "<tr>";
				foreach($row as $key => $value){
					if($counter == 0){
						$counter = 1;
					}else{
						echo "<th>$key</th>";
					}

					
				}
				echo "<th>Prezzo Totale</th>";
				echo "</tr>";
				break;	
			}
			
			foreach($result as $row){
				echo "<tr>";
				$nome_quadro = $row['Nome Quadro'];
				$nome_autore = $row['Autore'];		
				$genere = $row['Genere'];
				$descrizione_breve = $row['Descrizione'];
				$prezzo = $row['Prezzo'];
				$quantita = $row['Quantità'];
				
				echo "<td>$nome_quadro</td>";
				echo "<td>$nome_autore</td>";
				echo "<td>$genere</td>";
				echo "<td>$descrizione_breve</td>";
				echo "<td>$prezzo</td>";
				echo "<td>$quantita</td>";
				echo "<td>".$prezzo*$quantita."</td>";
				
				echo "</tr>";
				
				$prezzo_totale += $prezzo*$quantita;
					
				}
			echo "</table>";
			
			
			echo "prezzo totale = ".$prezzo_totale;

			$query = "SELECT ms.nome AS nome_metodo_spedizione, mp.nome AS nome_metodo_pagamento, o.indirizzo_spedizione AS indirizzo_spedizione
					  FROM ordine AS o JOIN metodo_pagamento AS mp ON o.metodo_pagamento_ID = mp.metodo_ID JOIN metodo_spedizione AS ms ON o.metodo_spedizione_ID = ms.metodo_ID
					  WHERE o.ordine_ID = $ordine_ID";

			

			$result = $conn -> query($query);
			
			

			foreach($result as $row){
				$nome_metodo_spedizione = $row['nome_metodo_spedizione'];
				$nome_metodo_pagamento = $row['nome_metodo_pagamento'];		
				$indirizzo_spedizione = $row['indirizzo_spedizione'];
				}	
			echo "<br>";
			echo "Indirizzo di Spedizione: ".$indirizzo_spedizione."<br>";
			echo "Metodo di Spedizione: ".$nome_metodo_spedizione."<br>";
			echo "Metodo di Pagamento: ".$nome_metodo_pagamento."<br>";
		?>

		<form method = "POST" name = "annulla_ordine">
			<input type = "submit" name = "submit_data_spedizione" value = "Spedisci">
		</form>
		<?php
			if(isset($_POST['submit_data_spedizione'])){
				foreach($result_dettagli_quadri_ordinati as $row){

					$date = date('Y-m-d H:i:s');
					
				    

					$query = "UPDATE ordine
								SET data_spedizione = '$date'
								WHERE ordine_ID = $ordine_ID;";

					echo "<br>Query aggiungi data_spedizione: ".$query;

					$result = $conn -> query($query);

					

					header( "Refresh:2; url = gestione_ordini.php", true, 303);
			}
		}
		

		?>

		<script> //serve per cancellare il form dopo che e' stato inserito nel DB
			if ( window.history.replaceState ) {
				window.history.replaceState( null, null, window.location.href );
			}
		</script>
  </body>
  
</html>