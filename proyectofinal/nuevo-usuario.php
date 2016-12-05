<?php
include 'index.php';
include 'DB.php';
?>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $username = $_POST["usuario"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $usuario = new Usuario();
    $usuario->setNombre($nombre);
    $usuario->setApellido($apellido);
    $usuario->setUsername($username);
    $usuario->setPassword($password);
    $usuario->setEmail($email);

    $bd = DB::getInstance();
    $bd->insertUsuario($usuario);

    header('Location: /');
}
?>

<div class="nuevo-usuario-title">
    <p>Nuevo usuario</p>
</div>
<div class="nuevo-usuario-form">
    <form method="post">
        <div class="form-item">
            <label>Nombre: </label>
            <input type="text" name="nombre" value="">
        </div>
        <div class="form-item">
            <label>Apellido: </label>
            <input type="text" name="apellido" value="">
        </div>
        <div class="form-item">
            <label>Nombre de usuario: </label>
            <input type="text" name="usuario" value="">
        </div>
        <div class="form-item">
            <label>Password: </label>
            <input type="password" name="password" value="">
        </div>
        <div class="form-item">
            <label>Email: </label>
            <input type="email" name="email" value="">
        </div>
        <div class="form-item">
            <input type="submit" value="Enviar">
        </div>

    </form>
</div>

<?php include 'footer.php' ?>
