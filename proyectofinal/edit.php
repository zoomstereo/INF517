<?php
include 'index.php';
include 'DBGeneric.php';

$id = 0;
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'] or die();
}

$db = DBG::getInstance();
$db->load(true);
$columnas = $db->getColumnas();
$row = $db->select_id($id);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $values = [];
    foreach($columnas as $c) {
        array_push($values, $_POST[$c]);
    }

    if(isset($_POST['delete'])) {
        $db->delete($_POST['id']);
        header('Location: /');
    }

    $db->update($_POST['id'], $values);
    header('Location: /');
}


?>

<form method="post">
    <input style="display: none;" type="text" name="id" value="<?php echo $id ?>">
    <?php
    foreach($columnas as $c) {
        ?>
        <div class="form-item">
            <label><?php echo $c ?></label>
            <input type="text" name="<?php echo $c ?>" value="<?php echo $row[$c] ?>">
            <br>
        </div>

        <?php
    }
    ?>
    <div class="form-item">
        <input type="submit" value="Guardar">
    </div>

    <div class="form-item">
        <input type="submit" name="delete" value="ELIMINAR">
    </div>
</form>
