<?php
include "function.php";
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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Pencarian <span class="sr-only">(current)</span></a>
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
        <div class="pt-4">
            <form action="pencarian.php" method="post">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4 d-flex justify-content-center">
                    <div class="card-header py-3 bg-dark">
                        <h6 class="m-0 font-weight-bold text-primary text-light">Pencarian</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="harga" class="col-sm-6 col-form-label">Harga sewa/tahun (Rp)</label>
                            <div class="col-sm-6">
                                <input type="number" name="harga" min="100000" class="form-control" id="harga" required>
                            </div>
                            <label for="jarak" class="col-sm-6 col-form-label">Jarak dengan pasar (m)</label>
                            <div class="col-sm-6">
                                <input type="number" name="jarak" min="1" class="form-control" id="jarak" required>
                            </div>
                            <label for="kondisi" class="col-sm-6 col-form-label">kondisi Ruko</label>
                            <div class="col-sm-6">
                                <select name="kondisi" class="form-control" required>
                                    <option value="5">Sangat bagus</option>
                                    <option value="4">Bagus</option>
                                    <option value="3">Sedang</option>
                                    <option value="2">Kurang bagus</option>
                                    <option value="1">Buruk</option>
                                </select>
                            </div>
                            <label for="luas_bangunan" class="col-sm-6 col-form-label">Luas Bangunan Ruko (m<sup>2</sup>)</label>
                            <div class="col-sm-6">
                                <input type="number" name="ls_bangunan" min="1" id="ls_bangunan" class="form-control" id="luas_bangunan" required>
                            </div>
                            <label for="luas_tanah" class="col-sm-6 col-form-label">Luas tanah (m<sup>2</sup>)</label>
                            <div class="col-sm-6">
                                <input type="number" name="ls_tanah" min="1" id="ls_tanah" class="form-control" id="luas_tanah" required>
                            </div>
                        </div>
                    </div>
                    <button type="reset" class="btn btn-light">ULANGI</button>
                    <button type="submit" name="tmbl_target" class="btn btn-primary"> CARI</button>
                </div>
                <script>
                    var ls_bangunan = document.getElementById('ls_bangunan');
                    var ls_tanah = document.getElementById('ls_tanah');
                    // tambahakan event ketika bobot diisi
                    ls_bangunan.addEventListener('keyup', function() {


                        ls_tanah.min = ls_bangunan.value
                        // ls_tanah.value = ls_bangunan.value
                    })
                </script>
            </form>
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

</html>