<?php
// gunakan ranking kecocokan (semakin murah semakin bagus, nilai makin tinggi)
// 1 = sangat tidak sesuai
// 2 = tidak sesuai
// 3 = sesuai
// 4 = cukup sesuai
// 5 = sangat sesuai
// 4 = cukup sesuai
// 3 = sesuai
// 2 = tidak sesuai
// 1 = sangat tidak sesuai


// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_topsis_ruko");


function spk_user_0($target)
{
    global $conn;

    // cari jumlah alternatif
    $jum_alternatif = cari_jumlah_alternatif();

    // cari jumlah kriteria
    $jum_kriteria = cari_jumlah_kriteria();

    // ambil nilai semua nilai alternatif di database, masukkan ke dalam array
    $query = "SELECT * FROM tb_nilai";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo mysqli_error($conn);
    }
    $nilai = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nilai[] = $row;
    }

    $matriks_0 = matriks_keputusan($target, $nilai, $jum_alternatif, $jum_kriteria);
    // print_r($nilai);
    // echo "<br>";
    // print_r($target);
    return $matriks_0;
}

function matriks_keputusan($target, $nilai, $jum_alternatif, $jum_kriteria)
{
    // print_r($nilai);
    // print_r($target); //OKE
    $tr_harga = $target["harga"];
    $tr_jarak = $target["jarak"];
    $tr_kondisi = $target["kondisi"];
    $tr_ls_bangunan = $target["ls_bangunan"];
    $tr_ls_tanah = $target["ls_tanah"];

    $matriks_0 = [];
    $lanjutan = 0;
    $lanjutan2 = $jum_kriteria;
    for ($i = 0; $i < $jum_alternatif; $i++) {
        for ($j = $lanjutan; $j < $lanjutan2; $j++) {
            if ($nilai[$j]["id_kriteria"] == 1) {
                $matriks_0[$i]["harga"] = cr_nilai_matriks($tr_harga, $nilai[$j]["nilai_kriteria"]);
            } elseif ($nilai[$j]["id_kriteria"] == 2) {
                $matriks_0[$i]["jarak"] = cr_nilai_matriks($tr_jarak, $nilai[$j]["nilai_kriteria"]);
            } elseif ($nilai[$j]["id_kriteria"] == 3) {
                $matriks_0[$i]["kondisi"] = cr_nilai_matriks_kondisi($tr_kondisi, $nilai[$j]["nilai_kriteria"]);
            } elseif ($nilai[$j]["id_kriteria"] == 4) {
                $matriks_0[$i]["luas_bangunan"] = cr_nilai_matriks($tr_ls_bangunan, $nilai[$j]["nilai_kriteria"]);
            } elseif ($nilai[$j]["id_kriteria"] == 5) {
                $matriks_0[$i]["luas_tanah"] = cr_nilai_matriks($tr_ls_tanah, $nilai[$j]["nilai_kriteria"]);
            }
        }
        $lanjutan += $jum_kriteria;
        $lanjutan2 += $jum_kriteria;
    }
    // print_r($matriks_0);
    // echo "<br> <br>";
    return $matriks_0;
}

function cr_nilai_matriks_kondisi($tr_nilai, $nilai)
{
    // lihat proses
    // echo "$tr_nilai $nilai";
    $tmp = $tr_nilai - $nilai;
    // echo "$tmp <br>";
    if ($tmp < 0) {
        $tmp *= -1;
    } elseif ($tmp == 0) {
        $nilai = 5;
    } elseif ($tmp == 1) {
        $nilai = 4;
    } elseif ($tmp == 2) {
        $nilai = 3;
    } elseif ($tmp == 3) {
        $nilai = 2;
    } elseif ($tmp == 4) {
        $nilai = 1;
    }
    // lihat proses
    // echo " => $nilai<br>";
    return $nilai;
}

function cr_nilai_matriks($tr_nilai, $nilai)
{
    // lihat proses
    // echo "$tr_nilai $nilai";
    $pecah_tr = $tr_nilai / 9;
    $pecah_tr_kecil2 = $pecah_tr * 2;
    $pecah_tr_kecil4 = $pecah_tr * 4;
    $pecah_tr_kecil6 = $pecah_tr * 6;
    $pecah_tr_kecil8 = $pecah_tr * 8;

    $pecah_tr_besar10 = $pecah_tr * 10;
    $pecah_tr_besar12 = $pecah_tr * 12;
    $pecah_tr_besar14 = $pecah_tr * 14;
    $pecah_tr_besar16 = $pecah_tr * 16;
    $pecah_tr_besar18 = $pecah_tr * 18; //X

    if ($nilai < $pecah_tr_kecil8) { //nilai lebih kecil dari target dan nilai lebih kecil dari $pecah_tr_kecil8
        if ($nilai < $pecah_tr_kecil2) {
            $nilai_mtrk = 1;
        } elseif ($nilai >= $pecah_tr_kecil2 && $nilai < $pecah_tr_kecil4) {
            $nilai_mtrk = 2;
        } elseif ($nilai >= $pecah_tr_kecil4 && $nilai < $pecah_tr_kecil6) {
            $nilai_mtrk = 3;
        } elseif ($nilai >= $pecah_tr_kecil6 && $nilai < $pecah_tr_kecil8) {
            $nilai_mtrk = 4;
        } else {
            $nilai_mtrk = 0;
        }
        //----------------------------------------------------------------------------------------
    } elseif ($nilai >= $pecah_tr_kecil8 && $nilai < $pecah_tr_besar10) {
        $nilai_mtrk = 5;
        //----------------------------------------------------------------------------------------
    } elseif ($nilai >= $pecah_tr_besar10) {
        if ($nilai >= $pecah_tr_besar10 && $nilai < $pecah_tr_besar12) {
            $nilai_mtrk = 4;
        } elseif ($nilai >= $pecah_tr_besar12 && $nilai < $pecah_tr_besar14) {
            $nilai_mtrk = 3;
        } elseif ($nilai >= $pecah_tr_besar14 && $nilai < $pecah_tr_besar16) {
            $nilai_mtrk = 2;
        } elseif ($nilai >= $pecah_tr_besar16) {
            $nilai_mtrk = 1;
        } else {
            $nilai_mtrk = 0;
        }
    }
    // lihat proses
    // echo " => $nilai_mtrk<br>";
    return $nilai_mtrk;
}

function cari_jumlah_alternatif()
{
    global $conn;
    $query = "SELECT * FROM tb_alternatif";
    $result = mysqli_query($conn, $query);
    $jum_alternatif = 0;
    while (mysqli_fetch_assoc($result)) {
        $jum_alternatif += 1;
    }
    return $jum_alternatif;
}
function cari_jumlah_kriteria()
{
    global $conn;
    $query = "SELECT * FROM tb_kriteria";
    $result = mysqli_query($conn, $query);
    $jum_kriteria = 0;
    while (mysqli_fetch_assoc($result)) {
        $jum_kriteria += 1;
    }
    return $jum_kriteria;
}

function spk_user_1($matriks_0)
// langkah 1
{
    // print_r($matriks_0);
    $jum_alternatif = cari_jumlah_alternatif();
    // echo "alternatif=$jum_alternatif ";
    $jum_kriteria = cari_jumlah_kriteria();
    // echo $jum_kriteria;
    // print_r($matriks_0);
    for ($j = 0; $j < $jum_kriteria; $j++) {
        if ($j == 0) {
            $nama = "harga";
        } elseif ($j == 1) {
            $nama = "jarak";
        } elseif ($j == 2) {
            $nama = "kondisi";
        } elseif ($j == 3) {
            $nama = "luas_bangunan";
        } elseif ($j == 4) {
            $nama = "luas_tanah";
        }
        $X = 0;
        for ($i = 0; $i < $jum_alternatif; $i++) {
            // ambil semua nilai
            ${'Y' . $i} = $matriks_0[$i]["$nama"];
            //pangkatkan 2
            // lihat proses
            // echo "<br>${'Y' .$i} ";
            ${'YP' . $i} = pow(${'Y' . $i}, 2);
            // lihat proses
            // echo "${'YP' .$i}";
            //jumlahkan semua kriteria masukkan ke X
            $X += ${'YP' . $i};
            // lihat proses
            // echo "<br>jumlah semua kriteria = $X, ";
            //akarkan
            if ($nama == "harga") {
                $X_1 = sqrt($X);
                //lihat proses
                // echo "diakarkan => $X_1";
            } elseif ($nama == "jarak") {
                $X_2 = sqrt($X);
                // echo "diakarkan => $X_2";
            } elseif ($nama == "kondisi") {
                $X_3 = sqrt($X);
                // echo "diakarkan => $X_3";
            } elseif ($nama == "luas_bangunan") {
                $X_4 = sqrt($X);
                // echo "diakarkan => $X_4";
            } elseif ($nama == "luas_tanah") {
                $X_5 = sqrt($X);
                // echo "diakarkan => $X_5";
            }
        }
    }
    //lihat proses
    // echo "<br>nilai|X_n| => $X_1 $X_2 $X_3 $X_4 $X_5<br>";

    for ($j = 0; $j < $jum_kriteria; $j++) {
        if ($j == 0) {
            $nama = "harga";
        } elseif ($j == 1) {
            $nama = "jarak";
        } elseif ($j == 2) {
            $nama = "kondisi";
        } elseif ($j == 3) {
            $nama = "luas_bangunan";
        } elseif ($j == 4) {
            $nama = "luas_tanah";
        }
        $X = 0;
        for ($i = 0; $i < $jum_alternatif; $i++) {
            // ambil semua nilai
            $X = ${'Y' . $i} = $matriks_0[$i]["$nama"];
            //cari matriks keputusan ternormalisasi
            if ($nama == "harga") {
                $matriks_1[$i]["harga"] = $X / $X_1;
                // lihat proses
                // $a = $matriks_1[$i]["harga"];
                // echo "$X/$X_1 = $a<br>";
            } elseif ($nama == "jarak") {
                $matriks_1[$i]["jarak"] = $X / $X_2;
                // $a = $matriks_1[$i]["jarak"];
                // echo "$X/$X_2 = $a<br>";
            } elseif ($nama == "kondisi") {
                $matriks_1[$i]["kondisi"] = $X / $X_3;
                // $a = $matriks_1[$i]["kondisi"];
                // echo "$X/$X_3 = $a<br>";
            } elseif ($nama == "luas_bangunan") {
                $matriks_1[$i]["luas_bangunan"] = $X / $X_4;
                // $a = $matriks_1[$i]["luas_bangunan"];
                // echo "$X/$X_4 = $a<br>";
            } elseif ($nama == "luas_tanah") {
                $matriks_1[$i]["luas_tanah"] = $X / $X_5;
                // $a = $matriks_1[$i]["luas_tanah"];
                // echo "$X/$X_5 = $a<br>";
            }
        }
    }
    // print_r($matriks_1);
    return $matriks_1;
}

function spk_user_2($matriks_1)
{
    // ambil nilai bobot di database
    global $conn;
    $query = "SELECT * FROM tb_kriteria";
    $result = mysqli_query($conn, $query);
    $bobot = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bobot[] = $row;
    }
    // print_r($bobot);
    // echo "<br>";
    // print_r($matriks_1);
    $jum_alternatif = cari_jumlah_alternatif();
    $jum_kriteria = cari_jumlah_kriteria();

    for ($i = 0; $i < $jum_alternatif; $i++) {
        for ($j = 0; $j < $jum_kriteria; $j++) {
            if ($bobot[$j]["id"] == 1) {
                $matriks_2[$i]["harga"] = $matriks_1[$i]["harga"] * $bobot[$j]["bobot"];
                // lihat proses
                // $a = $matriks_1[$i]["harga"];
                // $b = $bobot[$j]["bobot"];
                // $c = $matriks_2[$i]["harga"];
                // echo "$a X $b = $c <br>";
            } elseif ($bobot[$j]["id"] == 2) {
                $matriks_2[$i]["jarak"] = $matriks_1[$i]["jarak"] * $bobot[$j]["bobot"];
                // $a = $matriks_1[$i]["jarak"];
                // $b = $bobot[$j]["bobot"];
                // $c = $matriks_2[$i]["jarak"];
                // echo "$a X $b = $c <br>";
            } elseif ($bobot[$j]["id"] == 3) {
                $matriks_2[$i]["kondisi"] = $matriks_1[$i]["kondisi"] * $bobot[$j]["bobot"];
                // $a = $matriks_1[$i]["kondisi"];
                // $b = $bobot[$j]["bobot"];
                // $c = $matriks_2[$i]["kondisi"];
                // echo "$a X $b = $c <br>";
            } elseif ($bobot[$j]["id"] == 4) {
                $matriks_2[$i]["luas_bangunan"] = $matriks_1[$i]["luas_bangunan"] * $bobot[$j]["bobot"];
                // $a = $matriks_1[$i]["luas_bangunan"];
                // $b = $bobot[$j]["bobot"];
                // $c = $matriks_2[$i]["luas_bangunan"];
                // echo "$a X $b = $c <br>";
            } elseif ($bobot[$j]["id"] == 5) {
                $matriks_2[$i]["luas_tanah"] = $matriks_1[$i]["luas_tanah"] * $bobot[$j]["bobot"];
                // $a = $matriks_1[$i]["luas_tanah"];
                // $b = $bobot[$j]["bobot"];
                // $c = $matriks_2[$i]["luas_tanah"];
                // echo "$a X $b = $c <br>";
            }
        }
    }
    // print_r($matriks_2);
    return $matriks_2;
}

function spk_user_3($matriks_2)
{
    $jum_alternatif = cari_jumlah_alternatif();
    $jum_kriteria = cari_jumlah_kriteria();
    // print_r($matriks_2);

    for ($j = 0; $j < $jum_kriteria; $j++) {
        if ($j == 0) {
            $nama = "harga";
        } elseif ($j == 1) {
            $nama = "jarak";
        } elseif ($j == 2) {
            $nama = "kondisi";
        } elseif ($j == 3) {
            $nama = "luas_bangunan";
        } elseif ($j == 4) {
            $nama = "luas_tanah";
        }
        $X = 0;
        for ($i = 0; $i < $jum_alternatif; $i++) {
            // ambil semua nilai, masukkan ke array
            if ($nama == "harga") {
                $harga[] = $matriks_2[$i]["harga"];
                //lihat proses
                // print_r($harga);
            } elseif ($nama == "jarak") {
                $jarak[] = $matriks_2[$i]["jarak"];
                // print_r($jarak);
            } elseif ($nama == "kondisi") {
                $kondisi[] = $matriks_2[$i]["kondisi"];
                // print_r($kondisi);
            } elseif ($nama == "luas_bangunan") {
                $luas_bangunan[] = $matriks_2[$i]["luas_bangunan"];
                // print_r($luas_bangunan);
            } elseif ($nama == "luas_tanah") {
                $luas_tanah[] = $matriks_2[$i]["luas_tanah"];
                // print_r($luas_tanah);
            }
        }
    }
    $matriks_3["max"]["harga"] = max($harga);
    $matriks_3["max"]["jarak"] = max($jarak);
    $matriks_3["max"]["kondisi"] = max($kondisi);
    $matriks_3["max"]["luas_bangunan"] = max($luas_bangunan);
    $matriks_3["max"]["luas_tanah"] = max($luas_tanah);

    $matriks_3["min"]["harga"] = min($harga);
    $matriks_3["min"]["jarak"] = min($jarak);
    $matriks_3["min"]["kondisi"] = min($kondisi);
    $matriks_3["min"]["luas_bangunan"] = min($luas_bangunan);
    $matriks_3["min"]["luas_tanah"] = min($luas_tanah);

    // print_r($matriks_3);
    return $matriks_3;
}

function spk_user_4($matriks_2, $matriks_3)
{
    $jum_alternatif = cari_jumlah_alternatif();
    $jum_kriteria = cari_jumlah_kriteria();
    // print_r($matriks_3);

    $no = 0;
    foreach ($matriks_2 as $key) {

        //pengurangan
        $X0_plus = $key["harga"] - $matriks_3["max"]["harga"];
        // echo "pengurangan >=$X0_plus,";
        //pangkatkan
        $X0_plus = pow($X0_plus, 2);
        // echo " dipangkatkan => $X0_plus<br>";

        $X1_plus = $key["jarak"] - $matriks_3["max"]["jarak"];
        // echo "pengurangan >=$X1_plus,";
        $X1_plus = pow($X1_plus, 2);
        // echo " dipangkatkan => $X1_plus<br>";

        $X2_plus = $key["kondisi"] - $matriks_3["max"]["kondisi"];
        // echo "pengurangan >=$X2_plus,";
        $X2_plus = pow($X2_plus, 2);
        // echo " dipangkatkan => $X2_plus<br>";

        $X3_plus = $key["luas_bangunan"] - $matriks_3["max"]["luas_bangunan"];
        // echo "pengurangan >=$X3_plus,";
        $X3_plus = pow($X3_plus, 2);
        // echo " dipangkatkan => $X3_plus<br>";

        $X4_plus = $key["luas_tanah"] - $matriks_3["max"]["luas_tanah"];
        // echo "pengurangan >=$X4_plus,";
        $X4_plus = pow($X4_plus, 2);
        // echo " dipangkatkan => $X4_plus<br>";

        //jumlahkan semua
        ${'D' . $no . 'plus'} = $X0_plus + $X1_plus + $X2_plus + $X3_plus + $X4_plus;
        // echo "jumlah => ${'D' .$no . 'plus'}, ";
        //akarkan
        ${'D' . $no . 'plus'} = sqrt(${'D' . $no . 'plus'});
        // echo "diakarkan =>D$no'plus' ${'D' .$no . 'plus'},<br>";
        $matriks_4["plus"][$no] = ${'D' . $no . 'plus'};

        //pengurangan
        $X0_minus = $key["harga"] - $matriks_3["min"]["harga"];
        // echo "pengurangan >=$X0_minus,";
        //pangkatkan
        $X0_minus = pow($X0_minus, 2);
        // echo " dipangkatkan => $X0_minus<br>";

        $X1_minus = $key["jarak"] - $matriks_3["min"]["jarak"];
        // echo "pengurangan >=$X1_minus,";
        $X1_minus = pow($X1_minus, 2);
        // echo " dipangkatkan => $X1_minus<br>";

        $X2_minus = $key["kondisi"] - $matriks_3["min"]["kondisi"];
        // echo "pengurangan >=$X2_minus,";
        $X2_minus = pow($X2_minus, 2);
        // echo " dipangkatkan => $X2_minus<br>";

        $X3_minus = $key["luas_bangunan"] - $matriks_3["min"]["luas_bangunan"];
        // echo "pengurangan >=$X3_minus,";
        $X3_minus = pow($X3_minus, 2);
        // echo " dipangkatkan => $X3_minus<br>";

        $X4_minus = $key["luas_tanah"] - $matriks_3["min"]["luas_tanah"];
        // echo "pengurangan >=$X4_minus,";
        $X4_minus = pow($X4_minus, 2);
        // echo " dipangkatkan => $X4_minus<br>";

        //jumlahkan semua
        ${'D' . $no . 'minus'} = $X0_minus + $X1_minus + $X2_minus + $X3_minus + $X4_minus;
        // echo "jumlah => ${'D' .$no . 'minus'}, ";
        //akarkan
        ${'D' . $no . 'minus'} = sqrt(${'D' . $no . 'minus'});
        // echo "diakarkan =>D$no'minus' ${'D' .$no . 'minus'},<br>";
        $matriks_4["minus"][$no] = ${'D' . $no . 'minus'};

        $no += 1;
    }
    // print_r($matriks_4);
    return ($matriks_4);
}

function spk_user_5($matriks_4)
{
    // ambil nilai alternatif di database
    global $conn;
    $query = "SELECT * FROM tb_alternatif";
    $result = mysqli_query($conn, $query);
    $no = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $matriks_5["$no"]["alternatif"] = $row["alternatif"];
        $no++;
    }

    $jum_alternatif = cari_jumlah_alternatif();

    for ($i = 0; $i < $jum_alternatif; $i++) {
        $Dplus = $matriks_4["plus"][$i];
        $Dminus = $matriks_4["minus"][$i];
        $matriks_5_tmp["$i"]["nilai"] = $Dminus / ($Dminus + $Dplus);
        $cari_maks[] = $Dminus / ($Dminus + $Dplus);
        max($cari_maks);
        // echo "$Dminus / $Dminus+$Dplus = $matriks_5[$i]<br>";
    }

    for ($i = 0; $i < $jum_alternatif; $i++) {
        $matriks_5[$i]["nilai"] = $matriks_5_tmp[$i]["nilai"];
        $matriks_5[$i]["ideal"] = "";
        if ($matriks_5_tmp[$i]["nilai"] == max($cari_maks)) {
            $matriks_5[$i]["ideal"] = 'IDEAL';
        }
    }
    // print_r($matriks_5);
    return ($matriks_5);
}

function tampil($query)
{
    // ambil nilai di database
    global $conn;
    $result = mysqli_query($conn, $query);
    $nilai = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nilai[] = $row;
    }
    return $nilai;
}


function database_nilai()
{
    $nilai = tampil("SELECT * FROM tb_nilai");
    $jum_alternatif = cari_jumlah_alternatif();
    $jum_kriteria = cari_jumlah_kriteria();

    $matriks_database_nilai = [];
    $lanjutan = 0;
    $lanjutan2 = $jum_kriteria;
    for ($i = 0; $i < $jum_alternatif; $i++) {
        for ($j = $lanjutan; $j < $lanjutan2; $j++) {
            if ($nilai[$j]["id_kriteria"] == 1) {
                $matriks_database_nilai[$i]["harga"] = $nilai[$j]["nilai_kriteria"];
            } elseif ($nilai[$j]["id_kriteria"] == 2) {
                $matriks_database_nilai[$i]["jarak"] = $nilai[$j]["nilai_kriteria"];
            } elseif ($nilai[$j]["id_kriteria"] == 3) {
                $matriks_database_nilai[$i]["kondisi"] = $nilai[$j]["nilai_kriteria"];
            } elseif ($nilai[$j]["id_kriteria"] == 4) {
                $matriks_database_nilai[$i]["luas_bangunan"] = $nilai[$j]["nilai_kriteria"];
            } elseif ($nilai[$j]["id_kriteria"] == 5) {
                $matriks_database_nilai[$i]["luas_tanah"] = $nilai[$j]["nilai_kriteria"];
            }
        }
        $lanjutan += $jum_kriteria;
        $lanjutan2 += $jum_kriteria;
    }
    return $matriks_database_nilai;
}

function update_db_kriteria_nilai($data)
{
    // print_r($data);
    $id = $data["id"];
    $harga = $data["harga"];
    $jarak = $data["jarak"];
    $kondisi = $data["kondisi"];
    $luas_bangunan = $data["ls_bangunan"];
    $luas_tanah = $data["ls_tanah"];
    global $conn;

    $sql = "UPDATE tb_nilai SET nilai_kriteria='$harga' WHERE id_alternatif=$id && id_kriteria=1";
    mysqli_query($conn, $sql);
    $sql = "UPDATE tb_nilai SET nilai_kriteria='$jarak' WHERE id_alternatif=$id && id_kriteria=2";
    mysqli_query($conn, $sql);
    $sql = "UPDATE tb_nilai SET nilai_kriteria='$kondisi' WHERE id_alternatif=$id && id_kriteria=3";
    mysqli_query($conn, $sql);
    $sql = "UPDATE tb_nilai SET nilai_kriteria='$luas_bangunan' WHERE id_alternatif=$id && id_kriteria=4";
    mysqli_query($conn, $sql);
    $sql = "UPDATE tb_nilai SET nilai_kriteria='$luas_tanah' WHERE id_alternatif=$id && id_kriteria=5";
    mysqli_query($conn, $sql);
    ?>
    <script type="text/javascript">
        document.location.href = "alternatif.php";
    </script>
<?php
}

function update_bobot($data)
{

    global $conn;
    for ($i = 1; $i <= cari_jumlah_kriteria(); $i++) {
        $bobot = $data["bobot$i"];
        $sql = "UPDATE tb_kriteria SET bobot=$bobot WHERE id=$i";
        mysqli_query($conn, $sql);
    }
    ?>
    <script type="text/javascript">
        alert("bobot berhasil diubah!");
        document.location.href = "bobot_kriteria.php";
    </script>
<?php
}

function tambah_alternatif($data)
{
    // print_r($data);
    echo "<br>";
    $alternatif = $data["alternatif"];
    $harga = $data["harga"];
    $jarak = $data["jarak"];
    $kondisi = $data["kondisi"];
    $luas_bangunan = $data["ls_bangunan"];
    $luas_tanah = $data["ls_tanah"];
    global $conn;

    $sql = "INSERT INTO tb_alternatif (id, alternatif) VALUES (NULL, '$alternatif')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
    }

    $sql = "SELECT id FROM tb_alternatif";
    $result = mysqli_query($conn, $sql);
    $ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ids[] = $row;
    }
    // var_dump($ids);
    foreach ($ids as $key) {
        $id = $key["id"];
    }

    $sql = "INSERT INTO tb_nilai (id, id_alternatif, id_kriteria, nilai_kriteria) VALUES (NULL, $id, 1, '$harga')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
        echo "<br>";
    }
    $sql = "INSERT INTO tb_nilai (id, id_alternatif, id_kriteria, nilai_kriteria) VALUES (NULL, $id, 2, '$jarak')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
        echo "<br>";
    }
    $sql = "INSERT INTO tb_nilai (id, id_alternatif, id_kriteria, nilai_kriteria) VALUES (NULL, $id, 3, '$kondisi')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
        echo "<br>";
    }
    $sql = "INSERT INTO tb_nilai (id, id_alternatif, id_kriteria, nilai_kriteria) VALUES (NULL, $id, 4, '$luas_bangunan')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
        echo "<br>";
    }
    $sql = "INSERT INTO tb_nilai (id, id_alternatif, id_kriteria, nilai_kriteria) VALUES (NULL, $id, 5, '$luas_tanah')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo mysqli_error($conn);
        echo "<br>";
    }
    ?>
    <script type="text/javascript">
        document.location.href = "alternatif.php";
    </script>
<?php
}
?>