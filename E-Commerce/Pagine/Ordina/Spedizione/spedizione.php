<?php
	session_start();
	if(isset($_SESSION['utente_ID'])){
		echo "Benvenuto ".$_SESSION['utente_ID'];
	}
?>

<?php
	include("../../../Connessione_Database/connessione_database.php")
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <a href = "../../Index/index.php">Home</a><br>
  <a href = "../Indirizzo/indirizzo.php">indirizzo</a><br>
  <body>
    <h1>
      Indirizzo
    </h1>
	<form id="form-spedizione" action="" method="post">


			Metodo di Spedizione 
		<select name = "metodo_spedizione">
			<?php
			
			$query = "SELECT metodo_ID, nome
					FROM metodo_spedizione;";


			$result = $conn -> query($query);
			
			$n_rows = $result -> num_rows;
			
					
			if($n_rows != 0){
				foreach($result as $row){ //togli il for each se possibile
					$ID_metodo_spedizione = $row['metodo_ID'];
					$nome_metodo_spedizione = $row['nome'];	
					
					echo "<option value = $ID_metodo_spedizione>$nome_metodo_spedizione</option>";
				}
				
			}
			
			?>
			
		</select>
		<br>
		<input type="submit" class="my-button" value = "Salva Indirizzo" name = "submit"></input>
		<br>
			<?php
				if(isset($_POST['submit'])){	
				
					$_SESSION['ID_metodo_spedizione'] = $_POST['metodo_spedizione'];
						
					$query = "SELECT costo
						FROM metodo_spedizione
						WHERE metodo_ID = '".$_SESSION['ID_metodo_spedizione']."';";
						

					$result = $conn -> query($query);
					
					$n_rows = $result -> num_rows;
					
							
					if($n_rows != 0){
						foreach($result as $row){ //togli il for each se possibile
							$costo_spedizione = $row['costo'];			
							
						}
						
					}
					
					$_SESSION['prezzo_prodotti_totale'] += $costo_spedizione;
					
				
		
					echo $_SESSION['ID_metodo_spedizione'];
					header("location:../Pagamento/pagamento.php");

				
				}		
					

					
			?>
		
			
	</form>
		
  </body>
  
</html>