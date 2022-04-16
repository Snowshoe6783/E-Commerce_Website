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
		$query = "SELECT o.ordine_ID AS 'ID Ordine', s.stato_ID AS 'ID Stato', SUM(a.quantita*q.prezzo) AS 'Importo Totale'
				  FROM ordine AS o JOIN stato_ordine AS s ON o.stato_ID = s.stato_ID JOIN (quadro AS q JOIN acquisto AS a ON q.quadro_ID = a.quadro_ID) ON o.ordine_ID = a.ordine_ID
				  WHERE utente_ID = '".$_SESSION['utente_ID']."'
				    AND s.data_annullamento IS NULL
				  GROUP BY o.ordine_ID";

		echo $query;
		$result = $conn -> query($query);

		$n_rows = $result -> num_rows;

		echo $n_rows;

		echo "<table border = 1>";

		foreach($result as $row){
			echo "<tr>";
			foreach($row as $key => $value){
				echo "<th>$key</th>";
			}
			echo "<th>Dettagli Ordine</th>";
			echo "</tr>";
			break;	
		}

		foreach($result as $row){
			
			echo "<tr>";
			$ordine_ID = $row['ID Ordine'];
			$stato_ID = $row['ID Stato'];		
			$importo_totale = $row['Importo Totale'];
			
			echo "<td>$ordine_ID</td>";
			echo "<td>".$stato_ID."</td>";
			echo "<td>".$importo_totale."</td>";
			echo "<td><a href = \"../Ordine_Specifico/ordine_specifico.php?ordine_ID=$ordine_ID\">Visualizza Dettagli</a></td>";
			
			echo "</tr>";
			
				
		}
		echo "</table>";


		


	?>
  </body>
  
</html>