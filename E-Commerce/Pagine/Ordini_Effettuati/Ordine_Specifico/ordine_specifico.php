<?php
	session_start();
	if(isset($_SESSION['utente_ID'])){
		echo "Benvenuto ".$_SESSION['utente_ID'];
	}
?>

<?php
	include("../../../Connessione_Database/connessione_database.php");
?>

<!DOCTYPE html>
<html>
  <head>
  	<link rel="icon" type="image/x-icon" href="../../Immagini/Icone/carrello.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>carrello</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

  </head>
  <a href = "../../Index/index.php">Home</a><br>
  <a href = "../Ordina/Indirizzo/indirizzo.php">Indirizzo</a><br>
  <body>
    <h1>
      Carrello
    </h1>
    <?php
		$ordine_ID = $_GET['ordine_ID'];
		


			/*

			$query = "SELECT quadro_ID
					FROM acquisto
					WHERE ordine_ID = $ordine_ID;";
					

			$result = $conn -> query($query);
			
			$result_quadri_ordinati = $result;

			$n_rows = $result -> num_rows;
			echo $n_rows;
			$flag = 0;
			$query = "";
			echo "<table border = \"1\">";
			
			$result -> fetch_all(MYSQLI_ASSOC);
			foreach($result as $row){
				*/
				echo "<table border = \"1\">";
				$query = "";
				$flag = 0;
				if($flag == 0){
					$query = "SELECT q.quadro_ID AS 'Quadro ID', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							  FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN (ordine AS o JOIN stato_ordine AS so ON o.stato_ID = so.stato_ID) ON a.ordine_ID = o.ordine_ID
							  WHERE a.ordine_ID = $ordine_ID
							    AND so.data_annullamento IS NULL;";
							 
					$flag = 1;
					//echo "<br><br>start".$query;
					
				}
				
				else{	
					$query = "SELECT q.quadro_ID AS 'Quadro ID', nome_quadro AS 'Nome Quadro', nome_autore AS Autore, genere AS Genere, descrizione_breve AS Descrizione, prezzo as Prezzo, quantita AS Quantità
							  FROM (quadro AS q JOIN acquisto AS a  ON q.quadro_ID = a.quadro_ID) JOIN (ordien AS o JOIN stato_ordine AS so ON o.stato_ID = so.stato_ID) ON a.ordine_ID = o.ordine_ID
							  WHERE a.ordine_ID = $ordine_ID
							    AND so.data_annullamento IS NULL;
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
			<input type = "submit" name = "submit_annulla_ordine">
		</form>
		<?php
			if(isset($_POST['submit_annulla_ordine'])){
				foreach($result_dettagli_quadri_ordinati as $row){
					$quadro_ID = $row['Quadro ID'];
					$quantita_ordinata = $row['Quantità'];

					$query = "UPDATE quadro
							  SET quantita_in_magazzino = quantita_in_magazzino + $quantita_ordinata
							  WHERE quadro_ID = $quadro_ID;";

					echo "<br>Query aggiungi quadro: ".$query;
					$result = $conn -> query($query);
					
					}

					
				

					

					$date = date('Y-m-d H:i:s');
					
					$query = "SELECT stato_ID
							  FROM ordine
							  WHERE ordine_ID = $ordine_ID;";

				    echo "<br>Query aggiungi data_annullamento: ".$query;

				    $result = $conn -> query($query);

					foreach($result as $row){
						$stato_ID = $row['stato_ID'];
					}

					$query = "UPDATE stato_ordine
								SET data_annullamento = '$date'
								WHERE stato_ID = $stato_ID;";

					echo "<br>Query aggiungi data_annullamento: ".$query;

					$result = $conn -> query($query);

					

					header( "Refresh:2; url = ../Lista_Ordini/lista_ordini.php?ordine_ID=$ordine_ID", true, 303);
			}
		
		

		?>

		<script> //serve per cancellare il form dopo che e' stato inserito nel DB
			if ( window.history.replaceState ) {
				window.history.replaceState( null, null, window.location.href );
			}
		</script>
  </body>
  
</html>