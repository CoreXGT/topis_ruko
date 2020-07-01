<?php
include "function.php";
$data = tampil("SELECT * FROM tb_kriteria");
// print_r($data);
if (isset($_POST["ubah_bobot"])) {
    // print_r($_POST);
    update_bobot($_POST);
} else {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!--icon-->
        <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- css style -->
        <link rel="stylesheet" href="asset/css/style.css">

        <title>Memilih ruko sewa ideal menggunakan metode Topsis</title>
    </head>

    <body>
        <div class="container">
            <!--menu-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand" href="index.php">SPK MeRSI</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Pencarian <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="alternatif.php">Alternatif</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="bobot_kriteria.php">Bobot Kriteria</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <br>
            <br>
            <div class="pt-4">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post">
                            <?php
                                $no = 1;
                                foreach ($data as $key) { ?>
                                <tr>
                                    <td>
                                        <?= $key["id"]; ?>
                                    </td>
                                    <td>
                                        <?= $key["kriteria"]; ?>
                                    </td>
                                    <td>
                                        <input type="number" max="100" min="1" class="form-control-plaintext" step="0.0001" name="bobot<?= $key['id'] ?>" value="<?= $key["bobot"]; ?>" autocomplete="off" id="bobot_<?= $no; ?>" required>
                                    </td>
                                </tr>



                            <?php
                                    $no++;
                                }
                                ?>
                            <tr>
                                <td colspan="3" class="text-right"><button type="submit" name="ubah_bobot" id="ubah_bobot" class="btn btn-success">UBAH</button></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <script src="asset/js/jquery-3.2.1.min.js"></script> -->
        <script>
            var bobot_1 = document.getElementById('bobot_1');
            var bobot_2 = document.getElementById('bobot_2');
            var bobot_3 = document.getElementById('bobot_3');
            var bobot_4 = document.getElementById('bobot_4');
            var bobot_5 = document.getElementById('bobot_5');
            var ubah_bobot = document.getElementById('ubah_bobot');
            // tambahakan event ketika bobot diisi
            // bobot_1.addEventListener('keyup', function() {

            //     var bobot_input = bobot_1.value
            //     bobot_sisa = (100 - bobot_input) / 4
            //     bobot_2.value = bobot_sisa
            //     bobot_3.value = bobot_sisa
            //     bobot_4.value = bobot_sisa
            //     bobot_5.value = bobot_sisa
            // })

            // bobot_2.onclick = remove()

            // function remove() {
            //     bobot_3.value = 100

            // }
            // bobot_2.addEventListener('keyup', function() {
            //     bobot_1.removeEventListener('keyup', function_1() {
            //         var bobot_input = bobot_2.value
            //         bobot_sisa = bobot_1 + bobot_input
            //         bobot_3.value = bobot_sisa
            //         bobot_4.value = bobot_sisa
            //         bobot_5.value = bobot_sisa
            //     });
            // });
        </script>

    </body>

    </html>
<?php
}
?>