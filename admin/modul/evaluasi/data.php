<?php
$status = "-";

if (isset($_POST['saveEvaluasi'])) {
    $namaGuru = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $masaKerja = $_POST['masa_kerja'];
    $jamKerja = $_POST['jam_kerja'];
    $prosesPembelajaran = $_POST['proses_pembelajaran'];

    for ($i = 0; $i < count($namaGuru); $i++) {
        $cekNIPQuery = "SELECT * FROM tb_evaluasi WHERE nama_guru='$namaGuru[$i]'";
        $cekNIP = mysqli_query($con, $cekNIPQuery);
        $jumlahNIP = mysqli_num_rows($cekNIP);
        if ($jumlahNIP > 0) {
            continue;
        } else {
            $insertQuery = "INSERT INTO tb_evaluasi (nama_guru, jabatan, masa_kerja, jam_kerja, proses_pembelajaran) 
                        VALUES ('$namaGuru[$i]', '$jabatan[$i]', '$masaKerja[$i]', '$jamKerja[$i]', '$prosesPembelajaran[$i]')";

            $insert = mysqli_query($con, $insertQuery);

            if ($insert) {
                echo "
                <script type='text/javascript'>
                alert('Data Berhasil Disimpan');
                window.location.replace('?page=evaluasi');
                </script>";
            } else {
                echo "
                <script type='text/javascript'>
                alert('Data Gagal Disimpan');
                window.location.replace('?page=evaluasi');
                </script>";
            }
        }
    }
}



if (isset($_POST['cek'])) {
    $query = "SELECT 
                SUM(guru_matematika) AS matematika,
                SUM(guru_penjaskes) AS penjaskes,
                SUM(guru_bahasa_indonesia) AS bahasa_indonesia,
                SUM(guru_bahasa_ingris) AS bahasa_inggris,
                SUM(guru_ipa) AS ipa,
                SUM(guru_ips) AS ips,
                SUM(guru_seni_budaya) AS seni_budaya,
                SUM(guru_agama) AS agama
              FROM tb_kebutuhan";

    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if (
            $row['matematika'] > 0 || $row['penjaskes'] > 0 || $row['bahasa_indonesia'] > 0 ||
            $row['bahasa_inggris'] > 0 || $row['ipa'] > 0 || $row['ips'] > 0 ||
            $row['seni_budaya'] > 0 || $row['agama'] > 0
        ) {
            $status = "Tersedia";
        } else {
            $status = "Tidak Tersedia";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<form action="" method="POST">
    <div class="page-inner">
        <div class="row">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Evaluasi Data</h5>
                        <div class="row">
                            <div class="col-12">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="squareText">Kebutuhan Sekolah</label>
                                    <button name="cek" type="submit" class="btn btn-sm text-white" style="width: 100%; margin-top: 2px; background-image: linear-gradient( 91.9deg,  rgba(94,124,121,1) 4.4%, rgba(64,224,208,1) 89% );"><i class="bi bi-search"></i> CEK</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="squareText">Status</label>
                                    <input type="text" class="form-control" name="status" value="<?php echo $status; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($status == "Tidak Tersedia") : ?>
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Evaluasi Guru Tidak Bisa Dilakukan Jika Tidak Ada Kebutuhan Sekolah yang Tersedia!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                        </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <?php if ($status === "Tersedia") : ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" style="margin-top: -40px;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Daftar Sekolah yang Membutuhkan Guru
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <?php
                                                    if (isset($_POST['cek'])) {
                                                        $query = "SELECT 
                                            npsn,
                                            nama_sekolah,
                                            SUM(guru_matematika) AS matematika,
                                            SUM(guru_penjaskes) AS penjaskes,
                                            SUM(guru_bahasa_indonesia) AS bahasa_indonesia,
                                            SUM(guru_bahasa_ingris) AS bahasa_inggris,
                                            SUM(guru_ipa) AS ipa,
                                            SUM(guru_ips) AS ips,
                                            SUM(guru_seni_budaya) AS seni_budaya,
                                            SUM(guru_agama) AS agama
                                          FROM tb_kebutuhan
                                          GROUP BY npsn, nama_sekolah";

                                                        $result = mysqli_query($con, $query);

                                                        if ($result) {
                                                            $available = 0;

                                                            echo '<div class="table-responsive"><table class="table table-striped table-sm" id="table1">';
                                                            echo '<thead><tr><th>Sekolah</th><th>Guru Matematika</th><th>Guru Penjaskes</th><th>Guru Bahasa Indonesia</th><th>Guru Bahasa Inggris</th><th>Guru IPA</th><th>Guru IPS</th><th>Guru Seni Budaya</th><th>Guru Agama</th></tr></thead><tbody>';

                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $matematika = $row['matematika'] > 0 ? $row['matematika'] : "";
                                                                $penjaskes = $row['penjaskes'] > 0 ? $row['penjaskes'] : "";
                                                                $bahasa_indonesia = $row['bahasa_indonesia'] > 0 ? $row['bahasa_indonesia'] : "";
                                                                $bahasa_inggris = $row['bahasa_inggris'] > 0 ? $row['bahasa_inggris'] : "";
                                                                $ipa = $row['ipa'] > 0 ? $row['ipa'] : "";
                                                                $ips = $row['ips'] > 0 ? $row['ips'] : "";
                                                                $seni_budaya = $row['seni_budaya'] > 0 ? $row['seni_budaya'] : "";
                                                                $agama = $row['agama'] > 0 ? $row['agama'] : "";

                                                                if ($matematika || $penjaskes || $bahasa_indonesia || $bahasa_inggris || $ipa || $ips || $seni_budaya || $agama) {
                                                                    echo '<tr>';
                                                                    // echo '<td>' . $row['nip'] . '</td>';
                                                                    echo '<td>' . $row['nama_sekolah'] . '</td>';
                                                                    echo '<td>' . $matematika . '</td>';
                                                                    echo '<td>' . $penjaskes . '</td>';
                                                                    echo '<td>' . $bahasa_indonesia . '</td>';
                                                                    echo '<td>' . $bahasa_inggris . '</td>';
                                                                    echo '<td>' . $ipa . '</td>';
                                                                    echo '<td>' . $ips . '</td>';
                                                                    echo '<td>' . $seni_budaya . '</td>';
                                                                    echo '<td>' . $agama . '</td>';
                                                                    echo '</tr>';
                                                                    $available++;
                                                                }
                                                            }
                                                            echo '</tbody></table></div>';
                                                        } else {
                                                            echo "Error: " . mysqli_error($con);
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Daftar Guru yang Tersedia
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <?php
                                                    $status = "-";

                                                    if (isset($_POST['cek'])) {
                                                        $query = "SELECT 
                                                            npsn,
                                                            nama_sekolah,
                                                            SUM(guru_matematika) AS matematika,
                                                            SUM(guru_penjaskes) AS penjaskes,
                                                            SUM(guru_bahasa_indonesia) AS bahasa_indonesia,
                                                            SUM(guru_bahasa_ingris) AS bahasa_inggris,
                                                            SUM(guru_ipa) AS ipa,
                                                            SUM(guru_ips) AS ips,
                                                            SUM(guru_seni_budaya) AS seni_budaya,
                                                            SUM(guru_agama) AS agama
                                                        FROM tb_kebutuhan
                                                        GROUP BY npsn, nama_sekolah";

                                                        $result = mysqli_query($con, $query);

                                                        if ($result) {
                                                            // $available = false;

                                                            echo '<div class="card-body">';
                                                            echo '<div class="table-responsive">';
                                                            echo '<button type="submit" name="saveEvaluasi" class="btn btn-sm text-white" style="width: 20%; margin: 0 0 20px 80%; background-image: linear-gradient( 109.6deg,  rgba(121,203,202,1) 11.2%, rgba(119,161,211,1) 91.1% );"><i class="bi bi-plus-lg"></i> Simpan</button>';
                                                            echo '<table class="table table-striped table-sm" id="table2" style="width:100%">';
                                                            echo '<thead>';
                                                            echo '<tr>';
                                                            echo '<th rowspan="2">Nama Guru</th>';
                                                            echo '<th rowspan="2">Jabatan</th>';
                                                            echo '<th colspan="3" class="text-center">Nilai Kriteria</th>';
                                                            echo '</tr>';
                                                            echo '<tr class="text-center">';
                                                            echo '<th>Masa Kerja</th>';
                                                            echo '<th>Jam Kerja</th>';
                                                            echo '<th>Proses Pembelajaran</th>';
                                                            echo '</tr>';
                                                            echo '</thead>';
                                                            echo '<tbody>';

                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                if (
                                                                    $row['matematika'] > 0 || $row['penjaskes'] > 0 || $row['bahasa_indonesia'] > 0 ||
                                                                    $row['bahasa_inggris'] > 0 || $row['ipa'] > 0 || $row['ips'] > 0 ||
                                                                    $row['seni_budaya'] > 0 || $row['agama'] > 0
                                                                ) {
                                                                    $status = "Tersedia";

                                                                    $columns = [];
                                                                    if ($row['matematika'] > 0) $columns[] = "Guru Matematika";
                                                                    if ($row['penjaskes'] > 0) $columns[] = "Guru Penjaskes";
                                                                    if ($row['bahasa_indonesia'] > 0) $columns[] = "Guru Bahasa Indonesia";
                                                                    if ($row['bahasa_inggris'] > 0) $columns[] = "Guru Bahasa Inggris";
                                                                    if ($row['ipa'] > 0) $columns[] = "Guru IPA";
                                                                    if ($row['ips'] > 0) $columns[] = "Guru IPS";
                                                                    if ($row['seni_budaya'] > 0) $columns[] = "Guru Seni Budaya";
                                                                    if ($row['agama'] > 0) $columns[] = "Guru Agama";

                                                                    foreach ($columns as $column) {
                                                                        $guery_guru = "SELECT * FROM tb_guru WHERE jabatan = '$column'";
                                                                        $result_guru = mysqli_query($con, $guery_guru);

                                                                        $querySubKriteria = "SELECT * FROM tb_sub_kriteria";
                                                                        $resultSubKriteria = mysqli_query($con, $querySubKriteria);

                                                                        if ($result_guru) {
                                                                            $firstRow = true;

                                                                            while ($row_guru = mysqli_fetch_assoc($result_guru)) {
                                                                                echo '<tr class="text-center">';
                                                                                if ($firstRow) {
                                                                                    $firstRow = false;
                                                                                }
                                                                                // echo '<td>
                                                                                //     <input type="text" class="form-control" name="nip[]" value="' . $row_guru['nip'] . '" readonly>
                                                                                // </td>';
                                                                                echo '<td>
                                                                                    <input type="text" class="form-control" name="nama[]" value="' . $row_guru['nama_guru'] . '" readonly>
                                                                                </td>';
                                                                                echo '<td>
                                                                                    <input type="text" class="form-control" name="jabatan[]" value="' . $row_guru['jabatan'] . '" readonly>
                                                                                </td>';
                                                                                if (intval($row_guru['masa_kerja']) > 10) {
                                                                                    $masaKerja = '>10';
                                                                                    foreach ($resultSubKriteria as $rowSubKriteria) {
                                                                                        if ($rowSubKriteria['nama_sub_kriteria'] == $masaKerja) {
                                                                                            $masaKerja = $rowSubKriteria['bobot'];
                                                                                            echo '<td>
                                                                                            <input type="text" class="form-control" name="masa_kerja[]" value="' . $masaKerja . '" readonly>
                                                                                        </td>';
                                                                                        }
                                                                                    }
                                                                                } else if (intval($row_guru['masa_kerja']) < 10) {
                                                                                    $masaKerja = '<10';
                                                                                    foreach ($resultSubKriteria as $rowSubKriteria) {
                                                                                        if ($rowSubKriteria['nama_sub_kriteria'] == $masaKerja) {
                                                                                            $masaKerja = $rowSubKriteria['bobot'];
                                                                                            echo '<td>
                                                                                            <input type="text" class="form-control" name="masa_kerja[]" value="' . $masaKerja . '" readonly>
                                                                                        </td>';
                                                                                        }
                                                                                    }
                                                                                }

                                                                                foreach ($resultSubKriteria as $rowSubKriteria) {
                                                                                    if ($rowSubKriteria['nama_sub_kriteria'] == $row_guru['jam_kerja']) {
                                                                                        $jamKerja = $rowSubKriteria['bobot'];
                                                                                        echo '<td>
                                                                                        <input type="text" class="form-control" name="jam_kerja[]" value="' . $jamKerja . '" readonly>
                                                                                        </td>';
                                                                                    }
                                                                                }
                                                                                $prosesPembelajaran = $row_guru['jam_kerja'];
                                                                                if ($prosesPembelajaran == '>25') {
                                                                                    $value = 'Baik';
                                                                                    foreach ($resultSubKriteria as $rowSubKriteria) {
                                                                                        if ($rowSubKriteria['nama_sub_kriteria'] == $value) {
                                                                                            $prosesPembelajaran = $rowSubKriteria['bobot'];
                                                                                            echo '<td>
                                                                                            <input type="text" class="form-control" name="proses_pembelajaran[]" value="' . $prosesPembelajaran . '" readonly>
                                                                                        </td>';
                                                                                        }
                                                                                    }
                                                                                } elseif ($prosesPembelajaran == '18-24') {
                                                                                    $value = 'Cukup';
                                                                                    foreach ($resultSubKriteria as $rowSubKriteria) {
                                                                                        if ($rowSubKriteria['nama_sub_kriteria'] == $value) {
                                                                                            $prosesPembelajaran = $rowSubKriteria['bobot'];
                                                                                            echo '<td>
                                                                                            <input type="text" class="form-control" name="proses_pembelajaran[]" value="' . $prosesPembelajaran . '" readonly>
                                                                                        </td>';
                                                                                        }
                                                                                    }
                                                                                } else if ($prosesPembelajaran == '10-17') {
                                                                                    $value = 'Kurang';
                                                                                    foreach ($resultSubKriteria as $rowSubKriteria) {
                                                                                        if ($rowSubKriteria['nama_sub_kriteria'] == $value) {
                                                                                            $prosesPembelajaran = $rowSubKriteria['bobot'];
                                                                                            echo '<td>
                                                                                            <input type="text" class="form-control" name="proses_pembelajaran[]" value="' . $prosesPembelajaran . '" readonly>
                                                                                        </td>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                                echo '</tr>';
                                                                            }
                                                                        } else {
                                                                            echo '<tr><td colspan="7">Error: ' . mysqli_error($con) . '</td></tr>';
                                                                        }
                                                                    }

                                                                    $available = true;
                                                                }
                                                            }

                                                            echo '</tbody>';
                                                            echo '</table>';
                                                            echo '</div>';
                                                            echo '</div>';

                                                            if (!$available) {
                                                                echo '<div class="card-body"><p>Tidak ada data guru yang tersedia untuk ditampilkan.</p></div>';
                                                            }
                                                        } else {
                                                            echo "Error: " . mysqli_error($con);
                                                        }
                                                    }
                                                    ?>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                    </div>

                </div>
        </div>
        </section>
    </div>
    </div>
</form>


<div class="row" style="margin-top: -50px;">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hasil Evaluasi</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm" id="evaluasi">
                    <thead>
                        <tr>
                            <th rowspan="2">Nama Guru</th>
                            <th rowspan="2">Jabatan</th>
                            <th colspan="3" class="text-center">Nilai Kriteria</th>
                            <th rowspan="2">Opsi</th>
                        </tr>
                        <tr>
                            <th>Masa Kerja</th>
                            <th>Jam Kerja</th>
                            <th>Proses Pembelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Ganti dengan query database sesuai dengan struktur tabel tb_evaluasi
                        $evaluasi = mysqli_query($con, "SELECT * FROM tb_evaluasi");
                        foreach ($evaluasi as $ev) :
                        ?>
                            <tr>
                                <td><?= $ev['nama_guru']; ?></td>
                                <td><?= $ev['jabatan']; ?></td>
                                <td><?= $ev['masa_kerja']; ?></td>
                                <td><?= $ev['jam_kerja']; ?></td>
                                <td><?= $ev['proses_pembelajaran']; ?></td>
                                <td>
                                    <!-- <a class="btn btn-info btn-sm" href="?page=evaluasi&act=edit&id=<?= $ev['id_evaluasi'] ?>"><i class="far fa-edit"></i> Ubah</a> -->
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=evaluasi&act=del&id=<?= $ev['id_evaluasi'] ?>"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>
</div>
</section>
</div>