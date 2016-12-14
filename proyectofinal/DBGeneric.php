<?php
class DBG {
    private static $INSTANCE;
    private $usuario = "root";
    private $password = "12345";
    private $db_name = "proyecto-final";
    private $information_schema = "INFORMATION_SCHEMA";
    private $tabla = "usuarios";
    private $columnas = [];
    private $values = [];

    public static function getInstance() {
        if (null == static::$INSTANCE) {
            static::$INSTANCE = new DBG();
        }

        return static::$INSTANCE;
    }

    public function insert($values) {
        # $values es un hash <Cols, Values>
        $query = $this->generateInsertQuery();

        try {
            $db = new PDO('mysql:host=localhost;dbname=' . $this->db_name,
                          $this->usuario, $this->password);
            $stmt = $db->prepare($query);
            for($i = 0; $i < count($this->columnas); $i++) {
                $stmt->bindParam(":" . $this->columnas[$i], $values[$i], PDO::PARAM_STR);
            }
            $stmt->execute();
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }

    public function update($id, $values) {
        $query = $this->generateUpdateQuery();

        try {
            $db = new PDO('mysql:host=localhost;dbname=' . $this->db_name,
                          $this->usuario, $this->password);
            $stmt = $db->prepare($query);
            for($i = 0; $i < count($this->columnas); $i++) {
                $stmt->bindParam(":" . $this->columnas[$i], $values[$i], PDO::PARAM_STR);
            }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }

    public function select() {
        $query = "select * from " . $this->tabla;
        $queryset;
        try {
            $db = new PDO('mysql:host=localhost;dbname=' . $this->db_name,
                          $this->usuario, $this->password);
            $queryset = $db->query($query);
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

        return $queryset;
    }

    public function select_id($id) {
        $query = "select * from " . $this->tabla . " where id= " . $id . " limit 1";
        $row;
        try {
            $bd = new PDO('mysql:host=localhost;dbname=' . $this->db_name,
                          $this->usuario, $this->password);
            $stmt = $bd->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

        return $row;
    }

    public function delete($id) {
        # delete from table_name where id = $id;
        $query = "delete from " . $this->tabla . " where id = :id";
        try {
            $bd = new PDO('mysql:host=localhost;dbname=' . $this->db_name,
                          $this->usuario, $this->password);
            $stmt = $bd->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }

    public function getColumnas() {
        return $this->columnas;
    }

    public function getTableName() {
        return $this->tabla;
    }

    public function load($select) {
        try{
            $db = new PDO('mysql:host=localhost;dbname=' . $this->information_schema,
                          $this->usuario, $this->password);
            $query = "select column_name, data_type, extra from information_schema.columns where table_name = '" . $this->tabla . "' and table_schema = '" . $this->db_name . "'";
            if($select) {
                foreach($db->query($query) as $fila) {
                    if($fila['extra'] == 'auto_increment') {
                        continue;
                    }
                    array_push($this->columnas, $fila['column_name']);
                }
            } else {
                foreach($db->query($query) as $fila) {
                    array_push($this->columnas, $fila['column_name']);
                }
            }

        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

    }

    private function generateInsertQuery() {
        $insert = 'insert into ' . $this->tabla . ' (';
        $arr_cols = $this->columnas;
        $col_size = count($arr_cols);

        # Este loop arma las columnas en el insert
        for($i = 0; $i < $col_size; $i++) {
            if($i != $col_size - 1) {
                $insert = $insert . $arr_cols[$i] . ",";
            } else {
                $insert = $insert . $arr_cols[$i] . ") ";
            }
        }

        $insert = $insert . " values (";

        # Este loop arma los values del insert
        for($i = 0; $i < $col_size; $i++) {
            if($i != $col_size - 1) {
                $insert = $insert . ":" .$arr_cols[$i] . ",";
            } else {
                $insert = $insert . ":" .$arr_cols[$i] . ") ";
            }
        }

        return $insert;
    }

    private function generateUpdateQuery() {
        # update usuarios set [cols] = [values] where id = id;
        $col_size = count($this->columnas);
        $update = "update " . $this->tabla . " set ";
        for($i = 0; $i < $col_size; $i++) {
            if($i != $col_size - 1) {
                $update = $update . $this->columnas[$i] . " = :" . $this->columnas[$i] . " , ";
            } else {
                $update = $update . $this->columnas[$i] . " = :" . $this->columnas[$i] . " where id = :id";
            }
        }

        return $update;
    }

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}
?>
