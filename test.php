<!DOCTYPE html>
<html>

<body>

    <?php
    $array = array(
        range(2, 5),
        range(2, 5),
        range(2, 5),
        range(2, 5)
    );

    print_r($array);
    ?>
    <table border="1">
        <?php foreach (range(1, 4) as $row) { ?>
            <tr>
                <?php foreach (range(1, 4) as $col) { ?>
                    <td><?php echo $row . $col; ?></td>
                <?php  } ?>
            </tr>
        <?php } ?>
    </table>
</body>

</html>