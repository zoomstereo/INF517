<?php
include 'index.php';
include 'DB.php';
?>

<div class="new-user">
    <a href="nuevo-usuario.php"><i class="fa fa-plus" aria-hidden="true"></i> Añadir usuario</a>
</div>

<div class="all-users">
    <?php
    $bd = DB::getInstance();
    foreach($bd->getUsuarios() as $usuario) {
        ?>
        <div class="user">
            <a href="user-details.php?id=<?php echo $usuario->getId(); ?>">
                <?php echo $usuario->getUsername() ?>
            </a>
        </div>
        <?php
    }
    ?>

</div>

<?php include 'footer.php' ?>
