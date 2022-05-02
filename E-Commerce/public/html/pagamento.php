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
	<link rel="stylesheet" href="../assets/css/pagamento.css" type="text/css">


	<a href="index.php">Home</a><br>

<body>
	<h1>
		Metodo di Pagamento
	</h1>

	<form id="form_dati_pagamento" action="" method="post">

		<script>
			function myFunction() {

				const form_da_creare = document.getElementById('div_dati_pagamento');
				let metodo_pagamento_scelto = document.getElementById('metodo_pagamento').value;
				switch (metodo_pagamento_scelto) {
					case '1':

						form_da_creare.innerHTML =
							`
					Nome<input type = \"text\" name = \"nome\" required><br>
					Numero Carta<input type = \"text\" name = \"numero_carta\" required><br>
					Numero Dietro Carta<input type = \"text\" name = \"numero_dietro_carta\" required><br>
					Data Scadenza Carta<input type = \"text\" name = \"data_scadenza\" required><br>
					
					<input type = \"submit\" name = \"submit_dati_pagamento\" value = \"Salva Dati Pagamento\">
					</form>
					`;
						document.getElementById("metodo_pagamento").value = "1";
						break;

					case '2':
						form_da_creare.innerHTML =
							`
					Email<input type = \"text\" name = \"email\" required><br>
					Password<input type = \"password\" name = \"password\" required><br>
					<input type = \"submit\" name = \"submit_dati_pagamento\" value = \"Salva Dati Pagamento\">
					</form>
					`;
						document.getElementById("metodo_pagamento").value = "2";
						break;

					case '3':

						form_da_creare.innerHTML =
							`
					Manda un bonifico a IT 99 C 12345 67890 123456789012<br>
					<input type = \"submit\" name = \"submit_dati_pagamento\" value = \"Salva Dati Pagamento\">
					
					</form>
					`;
						document.getElementById("metodo_pagamento").value = "3";
						break;

				}

				if (document.getElementById('metodo_pagamento').value == "2") {


				}

			}
		</script>




		Metodo di Pagamento
		<select name="metodo_pagamento" id="metodo_pagamento" onchange="myFunction()">
			<?php

			$query = "SELECT metodo_ID, nome
					FROM metodo_pagamento;";


			$result = $conn->query($query);

			$n_rows = $result->num_rows;


			if ($n_rows != 0) {
				foreach ($result as $row) { //togli il for each se possibile
					$ID_metodo_pagamento = $row['metodo_ID'];
					$nome_metodo_pagamento = $row['nome'];
					echo "<option value = $ID_metodo_pagamento>$nome_metodo_pagamento</option>";
				}
			}

			?>

		</select>

		<div id="div_dati_pagamento">
			Nome<input type="text" name="nome" required><br>
			Numero Carta<input type="text" name="numero_carta" required><br>
			Numero Dietro Carta<input type="text" name="numero_dietro_carta" required><br>
			Data Scadenza Carta<input type="text" name="data_scadenza" required><br>

			<input type="submit" name="submit_dati_pagamento" value="Salva Dati Pagamento">
	</form>
	</div>



	<br>

	<div id="box">Box content</div>


	<br>
	<?php

	if (isset($_POST['submit_dati_pagamento'])) {
		$_SESSION['ID_metodo_pagamento'] = $_POST['metodo_pagamento'];
		echo $_SESSION['ID_metodo_pagamento'];
		header("location:riepilogo.php");
	}


	?>

	</form>




</body>

</html>