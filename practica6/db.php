<?php

class DB {
    private static $instance;
    private static $usuario = "root";
    private static $password = "12345";
    private static $dbname = "ejercicio6"; #ejercicio para local

    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new DB();
        }

        return static::$instance;
    }

    // Retorna un arreglo de Pelicula
    public function getPeliculas() {
        $arr_peliculas = [];
        $bd = new PDO('mysql:host=localhost;dbname=' . static::$dbname, static::$usuario, static::$password);

        try {
            foreach($bd->query("select * from pelicula") as $fila) {
                $pelicula = new Pelicula();
                $pelicula->setId($fila['id']);
                $pelicula->setTitulo($fila['titulo']);
                $pelicula->setGenero($fila['genero']);
                $pelicula->setDuracion($fila['duracion']);
                $pelicula->setFecha($fila['fecha']);
                $pelicula->setRating($fila['rating']);

                array_push($arr_peliculas, $pelicula);
            }
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

        return $arr_peliculas;
    }

    public function insertPeliculas($peliculas) {
        try {

            $bd = new PDO('mysql:host=localhost;dbname=' . static::$dbname, static::$usuario, static::$password);

            foreach($peliculas as $pelicula) {
                $titulo = $pelicula->getTitulo();
                $genero = $pelicula->getGenero();
                $duracion = $pelicula->getDuracion();
                $fecha = $pelicula->getFecha();
                $rating = $pelicula->getRating();

                $query = "insert into pelicula (titulo, genero, duracion, fecha, rating) ".
                "values (:titulo, :genero, :duracion, :fecha, :rating)";

                $stmt = $bd->prepare($query);
                $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
                $stmt->bindParam(':duracion', $duracion, PDO::PARAM_STR);
                $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

    }

    // Funciones privadas para que no sea instanceada.
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}

?>
