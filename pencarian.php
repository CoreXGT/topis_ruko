<?php
include "function.php";
print_r($_POST);
// sleep(5);
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
                        <a class="nav-link active" href="index.php">Pencarian <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="alternatif.php">Alternatif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bobot_kriteria.php">Bobot Kriteria</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <br>
        <p>
            <h2>Matriks Keputusan</h2>
        </p>
        <div class="">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" rowspan="2">Alternatif</th>
                        <th scope="col" colspan="5" class="text-center">Kriteria</th>
                    </tr>
                    <tr>
                        <th scope="col">K1 (Harga sewa)</th>
                        <th scope="col">K2 (Jarak dengan pasar)</th>
                        <th scope="col">K3 (Kondidsi ruko)</th>
                        <th scope="col">K4 (Luas bangunan)</th>
                        <th scope="col">K5 (Luas tanah)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $jum_alternatif = cari_jumlah_alternatif();
                    $matriks_0 = spk_user_0($_POST);
                    $no = 1;
                    foreach ($matriks_0 as $key) { ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $key["harga"]; ?></td>
                            <td><?= $key["jarak"]; ?></td>
                            <td><?= $key["kondisi"]; ?></td>
                            <td><?= $key["luas_bangunan"]; ?></td>
                            <td><?= $key["luas_tanah"]; ?></td>
                        </tr>
                    <?php
                        $no += 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <p>
            <h2>1. Matriks Keputusan Ternormalisasi</h2>
        </p>
        <div class="">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" rowspan="2">Alternatif</th>
                        <th scope="col" colspan="5" class="text-center">Kriteria</th>
                    </tr>
                    <tr>
                        <th scope="col">K1</th>
                        <th scope="col">K2</th>
                        <th scope="col">K3</th>
                        <th scope="col">K4</th>
                        <th scope="col">K5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $matriks_1 = spk_user_1($matriks_0);
                    $no = 1;
                    foreach ($matriks_1 as $key) { ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $key["harga"]; ?></td>
                            <td><?= $key["jarak"]; ?></td>
                            <td><?= $key["kondisi"]; ?></td>
                            <td><?= $key["luas_bangunan"]; ?></td>
                            <td><?= $key["luas_tanah"]; ?></td>
                        </tr>
                    <?php
                        $no += 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <p>
            <h2>2. Matriks Keputusan Ternormalisasi terbobot</h2>
        </p>
        <div class="">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" rowspan="2">Alternatif</th>
                        <th scope="col" colspan="5" class="text-center">Kriteria</th>
                    </tr>
                    <tr>
                        <th scope="col">K1</th>
                        <th scope="col">K2</th>
                        <th scope="col">K3</th>
                        <th scope="col">K4</th>
                        <th scope="col">K5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $matriks_2 = spk_user_2($matriks_1);
                    $no = 1;
                    foreach ($matriks_2 as $key) { ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $key["harga"]; ?></td>
                            <td><?= $key["jarak"]; ?></td>
                            <td><?= $key["kondisi"]; ?></td>
                            <td><?= $key["luas_bangunan"]; ?></td>
                            <td><?= $key["luas_tanah"]; ?></td>
                        </tr>
                    <?php
                        $no += 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <p>
            <h2>3. matriks solusi ideal positif dan negatif</h2>
        </p>
        <div class="">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" rowspan="2"></th>
                        <th scope="col" colspan="5" class="text-center">Kriteria</th>
                    </tr>
                    <tr>
                        <th scope="col">K1</th>
                        <th scope="col">K2</th>
                        <th scope="col">K3</th>
                        <th scope="col">K4</th>
                        <th scope="col">K5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $matriks_3 = spk_user_3($matriks_2);
                    foreach ($matriks_3 as $key => $a) { ?>
                        <tr>
                            <th scope="row">
                                <?php if ($key == "max") {
                                        $no = "A";
                                        $pangkat = "<sup>+</sup>";
                                    } else {
                                        $no = "A";
                                        $pangkat = "<sup>-</sup>";
                                    }
                                    echo "$no$pangkat";
                                    ?>
                            </th>
                            <td><?= $a["harga"]; ?></td>
                            <td><?= $a["jarak"]; ?></td>
                            <td><?= $a["kondisi"]; ?></td>
                            <td><?= $a["luas_bangunan"]; ?></td>
                            <td><?= $a["luas_tanah"]; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <p>
            <h2>4. Jarak antara nilai setiap alternatif dengan matriks solusi ideal positif dan negatif</h2>
        </p>
        <div class="">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" rowspan="2"></th>
                        <th scope="col" colspan="5" class="text-center">Kriteria</th>
                    </tr>
                    <tr>
                        <th scope="col">K1</th>
                        <th scope="col">K2</th>
                        <th scope="col">K3</th>
                        <th scope="col">K4</th>
                        <th scope="col">K5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($matriks_2 as $key) { ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $key["harga"]; ?></td>
                            <td><?= $key["jarak"]; ?></td>
                            <td><?= $key["kondisi"]; ?></td>
                            <td><?= $key["luas_bangunan"]; ?></td>
                            <td><?= $key["luas_tanah"]; ?></td>
                        </tr>
                    <?php
                        $no += 1;
                    }
                    ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">K1</th>
                        <th scope="col">K2</th>
                        <th scope="col">K3</th>
                        <th scope="col">K4</th>
                        <th scope="col">K5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $matriks_3 = spk_user_3($matriks_2);
                    foreach ($matriks_3 as $key => $a) { ?>
                        <tr>
                            <th scope="row">
                                <?php if ($key == "max") {
                                        $no = "A";
                                        $pangkat = "<sup>+</sup>";
                                    } else {
                                        $no = "A";
                                        $pangkat = "<sup>-</sup>";
                                    }
                                    echo "$no$pangkat";
                                    ?>
                            </th>
                            <td><?= $a["harga"]; ?></td>
                            <td><?= $a["jarak"]; ?></td>
                            <td><?= $a["kondisi"]; ?></td>
                            <td><?= $a["luas_bangunan"]; ?></td>
                            <td><?= $a["luas_tanah"]; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <?php
            $matriks_4 = spk_user_4($matriks_2, $matriks_3);
            ?>
            <div class="row">
                <div class="col col-md-6">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" colspan="2" class="text-center">Solusi Ideal Positif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jum_alternatif = cari_jumlah_alternatif();
                            for ($i = 0; $i < $jum_alternatif; $i++) { ?>
                                <tr>
                                    <th scope="row"><?= $i + 1; ?></th>
                                    <td><?= $matriks_4["plus"][$i]; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col col-md-6">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" colspan="2" class="text-center">Solusi Ideal Negatif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jum_alternatif = cari_jumlah_alternatif();
                            for ($i = 0; $i < $jum_alternatif; $i++) { ?>
                                <tr>
                                    <th scope="row"><?= $i + 1; ?></th>
                                    <td><?= $matriks_4["minus"][$i]; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            <br>
            <p>
                <h2>5. Nilai Preferensi Untuk Setiap Alternatif</h2>
            </p>
            <div class="">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" colspan="4" class="text-center">Nilai Preferensi</th>
                        </tr>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Alternatif</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody><?php
                            $matriks_5 = spk_user_5($matriks_4);
                            $no = 1;
                            foreach ($matriks_5 as $key) { ?>
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $key["alternatif"]; ?></td>
                                <td><?= $key["nilai"]; ?></td>
                                <td><?= $key["ideal"]; ?></td>
                            </tr>
                        <?php
                            $no += 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="asset/js/jquery-3.2.1.min.js"></script>
    <script src="asset/js/script.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<?php
// spk_user($_POST);
// print_r($matriks_0);
?>

</html>