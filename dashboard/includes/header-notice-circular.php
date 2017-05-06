<?php
$sqlciract = $obj->getCircularActivities();
$cirarray = array();
while ($rowcir = mysql_fetch_array($sqlciract)) {
    $cirarray[] = $rowcir;
}
?>
<h4 class="page-title">
    <span>
        <?php
        $i = 0;
        $size = count($cirarray);
        foreach ($cirarray as $cirvlue) {
            ?>
            <?php
            echo $cirvlue['subject'];
            echo ($size == ++$i) ? '' : ', ';
            ?>
        <?php
        }
        ?>
    </span>
</h4>
