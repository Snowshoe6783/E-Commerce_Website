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

<html>

<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="../assets/ico/registrazione.ico">
	<meta name="viewport" content="width=device-width">
	<title>Gestione Dati Propri</title>
	<link rel="stylesheet" href="../assets/css/style_generale.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/gestione_dati_propri.css" type="text/css">

</head>
<a href="index.php">Home</a><br>

<body>
	<h1>
		Gestione Dati Propri
	</h1>

  	<?php
		$query = "SELECT *
				  FROM dati_utente
				  WHERE utente_ID = '" . $_SESSION['utente_ID'] . "';";


  		$result = $conn->query($query);

		  foreach($result as $row){
			  
		  
	?>

<form method="post" name="form_registrazione">
		<div class="div_registrazione">
			<a class="titolo_registrazione">Dati anagrafici</a><br>
			Nome <input class="input_registrazione" type="text" name="nome" value = "<?=$row['nome']?>" required><br>
			Cognome <input class="input_registrazione" type="text" name="cognome" value = "<?=$row['cognome']?>" required><br>
			Codice Fiscale <input class="input_registrazione" type="text" name="codice_fiscale" value = "<?=$row['codice_fiscale']?>" required><br>
			E-mail <input class="input_registrazione" type="e-mail" name="email" value = "<?=$row['email']?>" required><br>
			Indirizzo <input class="input_registrazione" type="text" name="indirizzo" value = "<?=$row['indirizzo']?>" required><br>
			Numero di telefono <input class="input_registrazione" type="text" name="numero_telefono" value = "<?=$row['numero_telefono']?>" required>
		</div>
		<div class="div_registrazione">
			<a class="titolo_registrazione">Dati utente</a> <br>
			Username <input class="input_registrazione" type="text" name="username" value = "<?=$row['username']?>" required><br>

			Password<input class="input_registrazione" type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,64}" title="Must contain at least one number and one uppercase and lowercase letter, and between 8 and 64 characters" required><br>
			Conferma Password<input class="input_registrazione" type="password" id="password" name="password_conferma" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,64}" title="Must contain at least one number and one uppercase and lowercase letter, and between 8 and 64 characters" required><br>

			<div id="message">
				<h3>La password deve contenere:</h3>
				<p id="letter" class="invalid">• Una lettera <b>minuscola</b> </p>
				<p id="capital" class="invalid">• Una lettera <b>maiuscola</b> </p>
				<p id="number" class="invalid">• Un <b>numero</b></p>
				<p id="length" class="invalid">• Minimo <b>8 caratteri</b></p>
			</div>

			<input type="submit" class="button_registrazione" name="submit" value="Registrati">


		</div>


	</form>

	<?php
	}
	if (
		isset($_POST['submit'])
		&& isset($_POST['nome'])
		&& isset($_POST['cognome'])
		&& isset($_POST['email'])
		&& isset($_POST['indirizzo'])
		&& isset($_POST['numero_telefono'])
		&& isset($_POST['username'])
		&& isset($_POST['password'])
		&& isset($_POST['password_conferma'])
	) {
		
		if ($_POST['password'] == $_POST['password_conferma']) {	



		$password = $_POST['password'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);



		$query = "UPDATE dati_utente SET
                            nome = '" . $_POST['nome'] . "',
                            cognome = '" . $_POST['cognome'] . "',
                            email = '" . $_POST['email'] . "',
                            indirizzo = '" . $_POST['indirizzo'] . "',
                            numero_telefono = '" . $_POST['numero_telefono'] . "',
                            username = '" . $_POST['username'] . "',
                            password = '$hashed_password'
                        WHERE utente_id = '" . $_SESSION['utente_ID'] . "';";

		

		$result = $conn->query($query);
		$conn->close();



		echo 'Cambiato dati utente';
		}else{
			echo "Le password che hai inserito sono diverse. Riprova.";
		}
	}

	?>
	<script>
		//serve per cancellare il form dopo che e' stato inserito nel DB
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>

</body>

</html>