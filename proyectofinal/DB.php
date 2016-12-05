<?php
include 'usuario.php';

class DB {
    private static $INSTANCE;
    private static $usuario = "root";
    private static $password = "12345";

    public static function getInstance() {
        if (null == static::$INSTANCE) {
            static::$INSTANCE = new DB();
        }

        return static::$INSTANCE;
    }

    public function insertUsuario($usuario) {
        try {
            $bd = new PDO('mysql:host=localhost;dbname=proyecto-final',
                          static::$usuario, static::$password);

            $query = "insert into usuarios(nombre, apellido, username, " .
            "password, email) values (:nombre, :apellido, :username, " .
            ":password, :email)";

            $stmt = $bd->prepare($query);
            $stmt->bindParam(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $usuario->getApellido(), PDO::PARAM_STR);
            $stmt->bindParam(':username', $usuario->getUsername(), PDO::PARAM_STR);
            $stmt->bindParam(':password', $usuario->getPassword(), PDO::PARAM_STR);
            $stmt->bindParam(':email', $usuario->getEmail(), PDO::PARAM_STR);

            $stmt->execute();
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }

    public function getUsuarios() {
        $arr_usuarios = [];
        try {
            $bd = new PDO('mysql:host=localhost;dbname=proyecto-final',
                          static::$usuario, static::$password);

            foreach($bd->query("select id, username from usuarios") as $fila) {
                $usuario = new Usuario();
                $usuario->setId($fila['id']);
                $usuario->setUsername($fila['username']);

                array_push($arr_usuarios, $usuario);
            }

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

        return $arr_usuarios;
    }

    public function getUsuario($id) {
        $usuario = new Usuario();

        try {
            $bd = new PDO('mysql:host=localhost;dbname=proyecto-final',
                          static::$usuario, static::$password);
            $query = "select * from usuarios where id = :id limit 1";
            $stmt = $bd->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            $usuario->setId($row['id']);
            $usuario->setNombre($row['nombre']);
            $usuario->setApellido($row['apellido']);
            $usuario->setUsername($row['username']);
            $usuario->setPassword($row['password']);
            $usuario->setEmail($row['email']);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }

        return $usuario;
    }

    public function actualizarUsuario($usuario) {
        try {
            $bd = new PDO('mysql:host=localhost;dbname=proyecto-final',
                          static::$usuario, static::$password);
            $query = "update usuarios set nombre = :nombre, apellido = :apellido," .
                    "username = :username, password = :password, email = :email " .
                    "where id = :id";

            $stmt = $bd->prepare($query);
            $stmt->bindParam(":nombre", $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(":apellido", $usuario->getApellido(), PDO::PARAM_STR);
            $stmt->bindParam(":username", $usuario->getUsername(), PDO::PARAM_STR);
            $stmt->bindParam(":password", $usuario->getPassword(), PDO::PARAM_STR);
            $stmt->bindParam(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(":id", $usuario->getId(), PDO::PARAM_INT);

            $stmt->execute();

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }

    public function eliminarUsuario($id) {
        try {
            $bd = new PDO('mysql:host=localhost;dbname=proyecto-final',
                          static::$usuario, static::$password);
            $query = "delete from usuarios where id = :id";
            $stmt = $bd->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

        }catch (PDOException $e) {
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
