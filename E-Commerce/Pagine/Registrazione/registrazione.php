<!DOCTYPE html>
<?php
	include("../../Connessione_Database/connessione_database.php");
?>
<html>
  <head>
    <meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="../../Immagini/Icone/registrazione.ico">
    <meta name="viewport" content="width=device-width">
    <title>registrazione</title>
    <link href="../../CSS/style.css" rel="stylesheet" type="text/css" />
  </head>
  <a href = "../Index/index.php">Home</a><br>
  <body class="bodyRegistrazione">
			<form method = "post" name = "myform">
			<h1 class="titolo_reg">registrazione</h1>
				<div class="div_registrazione">
					<a class="titolo_registrazione">Dati anagrafici</a><br>
					<label for="nome_field">Nome <input class="input_registrazione" type = "text" name = "nome" required><br>
					<label for="nome_field">Cognome <input class="input_registrazione" type = "text" name = "cognome" required><br>
					<label for="nome_field">Ruolo <input class="input_registrazione" type = "text" name = "ruolo_id" required><br>
					<label for="nome_field">Codice Fiscale <input class="input_registrazione" type = "text" name = "codice_fiscale" required><br>
					<label for="nome_field">E-mail <input class="input_registrazione" type = "text" name = "email" required><br>
					<label for="nome_field">Indirizzo <input class="input_registrazione" type = "text" name = "indirizzo" required><br>
					<label for="nome_field">Numero di telefono <input class="input_registrazione" type = "text" name = "numero_telefono" required>
				</div>
				<div class="div_registrazione">	
					<a class="titolo_registrazione">dati utente</a> <br>
					Username <input class="input_registrazione" type = "text" name = "username" required><br>
					Password <input class="input_registrazione" type = "password" name = "password" required><br>
					<input type = "submit" class="button_registrazione" name = "submit" value = "Registrati">
				</div>
		</form>
	
   
	
	

	<?php

		if(    isset($_POST['submit'])
			&& isset($_POST['nome'])
			&& isset($_POST['cognome'])
			&& isset($_POST['ruolo_id'])
			&& isset($_POST['email'])
			&& isset($_POST['indirizzo'])
			&& isset($_POST['numero_telefono'])
			&& isset($_POST['username'])
			&& isset($_POST['password'])){
			  
				$password = $_POST['password'];
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				
				
				
				$query = "INSERT INTO dati_utente VALUES( '0', '"
														.$_POST['nome']."', '"
														.$_POST['cognome']."', '"
														.$_POST['ruolo_id']."', '"
														.$_POST['codice_fiscale']."', '"
														.$_POST['email']."', '"
														.$_POST['indirizzo']."', '"
														.$_POST['numero_telefono']."', '"
														.$_POST['username']."', '"
														.$hashed_password."');";
															
																				
				$result = $conn -> query($query);		
				$conn->close();
				

					  
				echo 'Utente registrato. Ti porto alla pagina di login...';
				header( "Refresh:3; url = ../Login/login.php", true, 303);
				
				
				
				
			}

	?>
	<script> //serve per cancellare il form dopo che e' stato inserito nel DB
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>

  </body>
  
</html>