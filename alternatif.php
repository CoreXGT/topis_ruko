<?php
include "function.php";
if (isset($_POST["tambah_alternatif"])) {
    if ($_POST["kondisi"] == 0) { ?>
        <script>
            alert('kondisi ruko belum dipilih')
            document.location.href = "alternatif.php"
        </script>
    <?php }
        // print_r($_POST);
        tambah_alternatif($_POST);
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
                            <a class="nav-link" href="index.php">Pencarian</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="alternatif.php">Alternatif<span class="sr-only">(current)</span></a>
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
                <h2>Daftar Alternatif</h2>
            </p>
            <div class="">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" rowspan="2">NO</th>
                            <th scope="col" rowspan="2" class="text-center">Alternatif</th>
                            <th scope="col" colspan="5" class="text-center">Nilai</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <th>Jarak dengan pasar (m)</th>
                            <th>Kondisi Ruko</th>
                            <th>Luas Bangunan(m<sup>2</sup>)</th>
                            <th>Luas Tanah(m<sup>2</sup>)</th>
                            <th scope="col">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Tambah Alternatif
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Alternatif Lokasi Baru</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="alternatif" placeholder="Alternatif" required>
                                                </div>
                                                <div class="col">
                                                    <input type="number" min="50000" class="form-control" name="harga" placeholder="Harga sewa/tahun" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="number" min="1" class="form-control" name="jarak" placeholder="Jarak dengan pasar (m)" required>
                                                </div>
                                                <div class="col">
                                                    <select name="kondisi" class="form-control">
                                                        <option value="0" selected>Pilih kondisi ruko....</option>
                                                        <option value="5">Sangat bagus</option>
                                                        <option value="4">Bagus</option>
                                                        <option value="3">Sedang</option>
                                                        <option value="2">Kurang bagus</option>
                                                        <option value="1">Buruk</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="number" min="100" class="form-control" name="ls_bangunan" placeholder="Luas bangunan" required>
                                                </div>
                                                <div class="col">
                                                    <input type="number" min="100" class="form-control" name="ls_tanah" placeholder="Luas tanah" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" name="tambah_alternatif" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $data = tampil("SELECT * FROM tb_alternatif");
                                $no = 1;
                                $matriks_database_nilai = database_nilai();
                                // print_r($matriks_database_nilai);
                                // print_r($data);
                                for ($i = 0; $i < cari_jumlah_alternatif(); $i++) {
                                    $matriks_database_nilai["$i"]["id"] = $data["$i"]["id"];
                                    $matriks_database_nilai["$i"]["alternatif"] = $data["$i"]["alternatif"];
                                }
                                $no = 1;
                                foreach ($matriks_database_nilai as $key) { ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= $key['alternatif']; ?></td>
                                    <td>Rp<?= $key['harga']; ?></td>
                                    <td><?= $key['jarak']; ?>m</td>
                                    <td><?php
                                                if ($key["kondisi"] == 5) {
                                                    echo "Sangat bagus";
                                                } elseif ($key["kondisi"] == 4) {
                                                    echo "Bagus";
                                                } elseif ($key["kondisi"] == 3) {
                                                    echo "Sedang";
                                                } elseif ($key["kondisi"] == 2) {
                                                    echo "Kurang Bagus";
                                                } elseif ($key["kondisi"] == 1) {
                                                    echo "Buruk";
                                                }
                                                ?>
                                    </td>
                                    <td><?= $key['luas_bangunan']; ?>m<sup>2</sup></td>
                                    <td><?= $key['luas_tanah']; ?>m<sup>2</sup></td>
                                    <td>
                                        <a onclick="return confirm('Data akan DIHAPUS, lanutkan?')" href="hapus.php?id=<?php echo $key["id"]; ?>" class="btn btn-danger btn-sm">HAPUS</a>
                                        <a href="ubah_nilai.php?id=<?php echo $key["id"]; ?>" class="btn btn-info btn-sm">UBAH</a>
                                    </td>
                                </tr>

                            <?php
                                    $no += 1;
                                }
                                ?>
                        </form>
                    </tbody>
                </table>
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
<?php
}
?>