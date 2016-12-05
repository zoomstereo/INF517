<?php
include 'Pelicula.php';

function loadPeliculasFromFile() {
    $file_name = "datos.txt";
    $arr_peliculas = [];

    $myfile = fopen($file_name, "r") or die("Unable to open file!");
    while(($line = fgets($myfile)) !== false) {
        array_push($arr_peliculas, generatePelicula($line));
    }
    fclose($myfile);

    return $arr_peliculas;
}

// Funcion que recibe la linea por parametro, y retorna una Pelicula
// con los datos llenos.
function generatePelicula($str) {
    // '|' Es el divisor para cada atributo
    // [0] Titulo
    // [1] Genero
    // [2] Duracion
    // [3] Fecha
    // [4] Rating
    $splited = explode("|", $str);
    $pelicula = new Pelicula();
    $pelicula->setTitulo($splited[0]);
    $pelicula->setGenero($splited[1]);
    $pelicula->setDuracion($splited[2]);
    $pelicula->setFecha($splited[3]);
    $pelicula->setRating($splited[4]);

    return $pelicula;
}

?>
