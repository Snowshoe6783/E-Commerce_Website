<?php
include("../../src/connessione_database.php");

session_start();
$link_cartella_immagini = "../assets/img/quadri/";
?>

<!DOCTYPE html>
<html>
<!----- https://preview.colorlib.com/#abcbook sito esempio
		https://www.templatemonsterpreview.com/demo/225791.html?_gl=1*t00fw4*_ga*MzgyNDE1MjcyLjE2NDg1NDI4NDE.*_ga_FTPYEGT5LY*MTY0ODU0Mjg0MS4xLjEuMTY0ODU0Mjg3MC4zMQ..&_ga=2.95366932.984041851.1648542841-382415272.1648542841
  ----->

<head>
	<link rel="icon" type="image/x-icon" href="../assets/ico/carrello.ico">
	<meta charset="utf-8">
	<link rel="stylesheet" href="../assets/css/index.css" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" /> <!-- se restringi la pagina salta fuori le tre linee per il menu -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>home</title>
</head>

<body class="bodyIndex">


	<nav class="navIndex">
		<div class="logo">art auction</div>
		<input type="checkbox" id="click">
		<label for="click" class="menu-btn">
			<i class="fas fa-bars"></i>
		</label>
		<ul>
			<li><a class="active" href="index.php">Home</a></li>

			<li><a href="#">Galleria</a></li>
			<?php
			if (!isset($_SESSION['username'])) {
				echo "<li><a href=\"registrazione.php\">Registrazione</a></li>";
				echo "<li><a href=\"login.php\">Login</a></li>";
			} else {
				echo "<li><a href=\"lista_ordini.php\">Ordini</a></li>";
				echo "<li><a href=\"carrello.php\">Carrello</a></li>";
				echo "<li><a href=\"menu_gestione.php\">Gestione</a></li>";
				echo "<li><a href=\"logout.php\">Logout</a></li>";
			}
			?>

			<script type="text/javascript">
				window.onload = function() {

					var a = document.getElementById("logout");
					a.onclick = function() {
						sessionStorage.clear();
						return false;
					}
				}
			</script>

		</ul>
	</nav>

	<div id="search">
		<form method="post" id="form_search">
			Search Quadro: <input type="text" name="search_quadro">
			Search Autore: <input type="text" name="search_autore">
			Genere:
			<select name="select_genere">
				<?php
				$query = "SELECT DISTINCT genere
				 	  	 FROM quadro
						  WHERE archiviato = '0'";

				$result = $conn->query($query);
				echo "<option></option>";
				foreach ($result as $row) {
					echo "<option value = \"" . $row['genere'] . "\">" . $row['genere'] . "</option>";
				}

				?>
			</select>
			<br>
			Nazione di Origine:
			<select name="select_nazione_di_origine">
				<?php
				$query = "SELECT DISTINCT nazione_di_origine
				 	  	 FROM quadro
						  WHERE archiviato = '0'";

				$result = $conn->query($query);
				echo "<option></option>";
				foreach ($result as $row) {
					echo "<option value = \"" . $row['nazione_di_origine'] . "\">" . $row['nazione_di_origine'] . "</option>";
				}

				?>
			</select>
			<br>

			Ordina per
			<br>
			Prezzo Discendente<input type="radio" name="radio_filtro" value="Prezzo Discendente">
			Prezzo Ascendente<input type="radio" name="radio_filtro" value="Prezzo Ascendente">
			Ordine Alfabetico<input type="radio" name="radio_filtro" value="Ordine Alfabetico">
			Ordine Alfabetico al contrario<input type="radio" name="radio_filtro" value="Ordine Alfabetico al contrario">
			<input type="submit" name="submit_search">

		</form>
	</div>

	<div id="Quadri_Cercati">
		<?php



		$query = "SELECT * 
                      FROM quadro 
                      WHERE archiviato = '0'";

		if (isset($_POST['search_quadro'])) {
			$query .= " AND nome_quadro LIKE '%" . $_POST['search_quadro'] . "%'";
		}
		if (isset($_POST['search_autore'])) {
			$query .= " AND nome_autore LIKE '%" . $_POST['search_autore'] . "%'";
		}
		if (isset($_POST['select_genere'])) {
			$query .= " AND genere LIKE '%" . $_POST['select_genere'] . "%'";
		}
		if (isset($_POST['select_nazione_di_origine'])) {
			$query .= " AND nazione_di_origine LIKE '%" . $_POST['select_nazione_di_origine'] . "%'";
		}
		if (isset($_POST['radio_filtro'])) {
			if ($_POST['radio_filtro'] == 'Prezzo Discendente') {
				$query .= " ORDER BY prezzo DESC";
			}
			if ($_POST['radio_filtro'] == 'Prezzo Ascendente') {
				$query .= " ORDER BY prezzo ASC";
			}
			if ($_POST['radio_filtro'] == 'Ordine Alfabetico') {
				$query .= " ORDER BY nome_quadro ASC";
			}
			if ($_POST['radio_filtro'] == 'Ordine Alfabetico al contrario') {
				$query .= " ORDER BY nome_quadro DESC";
			}
		}

		$query .= ";";
		$result = $conn->query($query);
		echo $query;

		foreach ($result as $row) {
			$nome_quadro = $row['nome_quadro'];

			$quadro_ID = $row['quadro_ID'];
			$link_quadro = $row['link_quadro'];

			$prezzo = $row['prezzo'];
			$nome_autore = $row['nome_autore'];


			echo
			"<div id=\"card\">  
                        <a href = \"quadro_specifico.php?quadro_ID=$quadro_ID\">
                            <img id=\"quadro_card\" src=" . $link_cartella_immagini . $link_quadro . " alt = " . $nome_quadro . ">
                        </a>
                        <br>
                            <p class = \"Titolo_card\">$nome_quadro</p>
                            <p class = \"Autore_card\">$nome_autore</p>
                            <p class = \"Prezzo_card\">$prezzo €</p>
                    </div>";
		}



		?>
		<script src="script.js"></script>
</body>

</html>