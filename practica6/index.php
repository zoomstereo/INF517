<?php
include "utils.php";
include "db.php";
 ?>
<html>
	<head>
		<title>Ejercicio 6</title>

		<style media="screen">
			table {
				width: 100%;
			}
			table, td, th {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>

		<h1>Ejercicio 6</h1> <br> <br>

		<table>
			<tr>
				<th>ID</th>
				<th>Titulo</th>
				<th>Genero</th>
				<th>Duracion</th>
				<th>Fecha</th>
				<th>Rating</th>
			</tr>

		<?php

		$db = DB::getInstance();
		// Cargado de Peliculas desde el archivo
		$peliculas_from_file = loadPeliculasFromFile();
		// Guardado de las peliculas en la BD
		$db->insertPeliculas($peliculas_from_file);
		// Recuperacion de Peliculas
		$peliculas_from_db = $db->getPeliculas();

		foreach($peliculas_from_db as $peli) {
			?>
			<tr>
				<td><?php echo $peli->getId(); ?></td>
				<td><?php echo $peli->getTitulo(); ?></td>
				<td><?php echo $peli->getGenero(); ?></td>
				<td><?php echo $peli->getDuracion(); ?></td>
				<td><?php echo $peli->getFecha(); ?></td>
				<td><?php echo $peli->getRating(); ?></td>
			</tr>
			<?php
		}

		?>
		</table>
	</body>
</html>
