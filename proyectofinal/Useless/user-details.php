<?php
include 'index.php';
include 'DB.php';
?>

<?php
$bd = DB::getInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['action'] == 'ELIMINAR') {
        $bd->eliminarUsuario($_POST['id']);
        header('Location: /');
        return;
    }

    $id = $_POST['id'];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $username = $_POST["usuario"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $usuario = new Usuario();
    $usuario->setId($id);
    $usuario->setNombre($nombre);
    $usuario->setApellido($apellido);
    $usuario->setUsername($username);
    $usuario->setPassword($password);
    $usuario->setEmail($email);

    $bd = DB::getInstance();
    $bd->actualizarUsuario($usuario);
    header('Location: /');
}

$usuario = $bd->getUsuario($_GET['id']);

?>

<form method="post">
    <input style="display: none;" type="text" name="id" value="<?php echo $usuario->getId(); ?>">
    <div class="form-item">
        <label>Nombre: </label>
        <input type="text" name="nombre" value="<?php echo $usuario->getNombre(); ?>">
    </div>
    <div class="form-item">
        <label>Apellido: </label>
        <input type="text" name="apellido" value="<?php echo $usuario->getApellido(); ?>">
    </div>
    <div class="form-item">
        <label>Nombre de usuario: </label>
        <input type="text" name="usuario" value="<?php echo $usuario->getUsername(); ?>">
    </div>
    <div class="form-item">
        <label>Password: </label>
        <input type="text" name="password" value="<?php echo $usuario->getPassword(); ?>">
    </div>
    <div class="form-item">
        <label>Email: </label>
        <input type="email" name="email" value="<?php echo $usuario->getEmail(); ?>">
    </div>
    <div class="form-item">
        <input type="submit" value="Guardar">
    </div>

    <div class="form-item">
        <input class="btn-eliminar" type="submit" name="action" value="ELIMINAR">
    </div>
</form>
<?php include 'footer.php'; ?>
