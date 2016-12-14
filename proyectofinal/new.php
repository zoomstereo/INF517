<?php
include 'index.php';
include 'DBGeneric.php';

$db = DBG::getInstance();
$db->load(true);
$columnas = $db->getColumnas();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $values = [];
    foreach($columnas as $c) {
        array_push($values, $_POST[$c]);
    }
    $db->insert($values);
    header('Location: /');
}

?>
<h1 style="text-align: center;"><?php echo $db->getTableName(); ?></h1>
<form method="post">
    <?php
    foreach($columnas as $c) {
        ?>
        <div class="form-item">
            <label><?php echo $c ?></label>
            <input type="text" name="<?php echo $c ?>" value="">
            <br>
        </div>

        <?php
    }
    ?>
    <div class="form-item">
        <input type="submit" value="Guardar">
    </div>

</form>

<?php
include 'footer.php';
?>
