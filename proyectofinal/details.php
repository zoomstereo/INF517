<?php
include 'DBGeneric.php';

$db = DBG::getInstance();
$db->load(false);

$columnas = $db->getColumnas();
$queryset = $db->select();

?>
<h1 style="text-align: center;"><?php echo $db->getTableName(); ?></h1>
<table>
    <tr>
        <?php
        foreach($columnas as $c) {
            ?>
            <th><?php echo $c ?></th>
            <?php
        }
        ?>
    </tr>
    <?php
    foreach($queryset as $row) {
        ?>
        <tr>
        <?php
            foreach($columnas as $column) {
                ?>
                <td><?php echo $row[$column] ?></td>
                <?php
            }
        ?>
        <td><a style="color: blue;" href="/edit.php?id=<?php echo $row['id']?>">Editar</a></td>
        </tr>
        <?php
    }
    ?>

</table>
