<?php

$conn = mysqli_connect("localhost", "root", "", "db_topsis_ruko");
$id_kriteria = $_GET["id"];
$sql = "DELETE FROM tb_alternatif WHERE id=$id_kriteria";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo mysqli_error($conn);
    echo "<br>";
}

$sql = "DELETE FROM tb_nilai WHERE id_alternatif=$id_kriteria";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo mysqli_error($conn);
    echo "<br>";
}
?>
<script type="text/javascript">
    document.location.href = "alternatif.php";
</script>