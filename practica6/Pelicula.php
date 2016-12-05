<?php

class Pelicula {
    private $id;
    private $titulo;
    private $genero;
    private $duracion;
    private $fecha;
    private $rating;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function getRating() {
        return $this->rating;
    }
}

?>
