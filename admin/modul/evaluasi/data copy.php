<?php
$status = "-"; // Default to "-"

if (isset($_POST['cek'])) {
    // Query to fetch the counts of teachers needed
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

        // Display which columns have non-zero values using var_dump
        foreach ($row as $key => $value) {
            if ($value > 0) {
                echo "Column '$key' has value '$value'<br>";
            }
        }

        // Determine the status based on the fetched counts
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
                        <h5 class="card-title">Evaluasi</h5>
                        <div class="row">
                            <div class="col-12">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="squareText">Kebutuhan Sekolah</label>
                                    <button name="cek" type="submit" class="btn btn-primary btn-sm text-white" style="width: 100%; margin-top: 2px;"><i class="fa fa-plus"></i> Tampilkan</button>
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