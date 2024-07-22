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
        $available = false;

        while ($row = mysqli_fetch_assoc($result)) {
            if (
                $row['matematika'] > 0 || $row['penjaskes'] > 0 || $row['bahasa_indonesia'] > 0 ||
                $row['bahasa_inggris'] > 0 || $row['ipa'] > 0 || $row['ips'] > 0 ||
                $row['seni_budaya'] > 0 || $row['agama'] > 0
            ) {
                $status = "Tersedia";

                // echo "Sekolah: {$row['nama_sekolah']}";

                // echo " Kolom yang tersedia: ";
                $columns = [];
                if ($row['matematika'] > 0) $columns[] = "Guru Matematika";
                if ($row['penjaskes'] > 0) $columns[] = "Guru Penjaskes";
                if ($row['bahasa_indonesia'] > 0) $columns[] = "Guru Bahasa Indonesia";
                if ($row['bahasa_inggris'] > 0) $columns[] = "Guru Bahasa Inggris";
                if ($row['ipa'] > 0) $columns[] = "Guru IPA";
                if ($row['ips'] > 0) $columns[] = "Guru IPS";
                if ($row['seni_budaya'] > 0) $columns[] = "Guru Seni Budaya";
                if ($row['agama'] > 0) $columns[] = "Guru Agama";
                // echo implode(", ", $columns) . "<br>";
                foreach ($columns as $column) {
                    var_dump($column);
                    $guery_guru = "SELECT * FROM tb_guru WHERE jabatan = '$column'";
                    $result_guru = mysqli_query($con, $guery_guru);
                    if ($result_guru) {
                        while ($row_guru = mysqli_fetch_assoc($result_guru)) {
                            echo "NIP: {$row_guru['nip']}<br>";
                            echo "Masa Kerja: {$row_guru['masa_kerja']}<br>";
                            echo "Jam Mengajar: {$row_guru['jam_kerja']}<br>";
                            echo "Jabaan: {$row_guru['jabatan']}<br>";
                            echo "Kebutuhan Sekolah: {$column}<br>";
                            echo "<br>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }
                }


                $available = true;
            }
        }

        if (!$available) {
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
                        <h5 class="card-title">Evaluasi</h5>
                        <div class="row">
                            <div class="col-12">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="squareText">Kebutuhan Sekolah</label>
                                    <button name="cek" type="submit" class="btn btn-primary btn-sm text-white" style="width: 100%; margin-top: 2px;"><i class="fa fa-plus"></i> CEK</button>
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

                                                            echo '<div class="table-responsive"><table class="table table-striped" id="table1">';
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
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP/NUPTK</th>
                                <th>Masa Kerja</th>
                                <th>Porses Mengajar</th>
                                <th>Jam Mengajar</th>
                                <th>Kebutuhan Sekolah</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $evaluasi = mysqli_query($con, "SELECT * FROM tb_evaluasi");
                            ?>
                            <?php foreach ($evaluasi as $ev) : ?>
                                <tr>
                                    <td><?= $no++; ?>.</td>
                                    <td><?= $ev['nip']; ?></td>
                                    <td><?= $ev['masa_kerja']; ?></td>
                                    <td><?= $ev['proses_mengajar']; ?></td>
                                    <td><?= $ev['jam_kerja']; ?></td>
                                    <td><?= $ev['kebutuhan_sekolah']; ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?page=evaluasi&act=edit&id=<?= $ev['id_evaluasi'] ?>"><i class="far fa-edit"></i>Ubah</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=evaluasi&act=del&id=<?= $ev['id_evaluasi'] ?>"><i class="fas fa-trash"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
        </div>
        </section>
    </div>
    </div>
</form>