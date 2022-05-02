<?php
$link_cartella_immagini = "../assets/img/quadri/";
include("../../src/connessione_database.php");

session_start();
if (isset($_SESSION['utente_ID'])) {
	echo "Utente " . $_SESSION['utente_ID'];
  }else{
	  http_response_code(403);
	  die('Non hai accesso a questa pagina.');
  }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Metodo di Spedizione
	</h1>
	<form id="form-spedizione" action="" method="post">


		Metodo di Spedizione:
		<select name="metodo_spedizione">
			<?php

			$query = "SELECT metodo_ID, nome, costo
					FROM metodo_spedizione;";


			$result = $conn->query($query);

			$n_rows = $result->num_rows;


			if ($n_rows != 0) {
				foreach ($result as $row) { //togli il for each se possibile
					$ID_metodo_spedizione = $row['metodo_ID'];
					$nome_metodo_spedizione = $row['nome'];
					$costo = $row['costo'];

					echo "<option value = $ID_metodo_spedizione>$nome_metodo_spedizione ($costo €)</option>";
				}
			}

			?>

		</select>
		<br>
		<input type="submit" class="my-button" value="Salva Indirizzo" name="submit"></input>
		<br>
		<?php
		if (isset($_POST['submit'])) {

			$_SESSION['ID_metodo_spedizione'] = $_POST['metodo_spedizione'];

			$query = "SELECT costo
						FROM metodo_spedizione
						WHERE metodo_ID = '" . $_SESSION['ID_metodo_spedizione'] . "';";


			$result = $conn->query($query);

			$n_rows = $result->num_rows;


			if ($n_rows != 0) {
				foreach ($result as $row) { //togli il for each se possibile
					$costo_spedizione = $row['costo'];
				}
			}

			$_SESSION['prezzo_prodotti_totale'] += $costo_spedizione;



			echo $_SESSION['ID_metodo_spedizione'];
			header("location:pagamento.php");
		}



		?>


	</form>

</body>

</html>