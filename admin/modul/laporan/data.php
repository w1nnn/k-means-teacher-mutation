<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h5 class="card-title text-center">Data Rekomendasi Usulan Mutasi Guru</h5>
                    </div>
                    <div class="card-body">
                        <form action="?page=laporan&act=tahun" method="POST">
                            <div class="input-group mb-3" style="width: 300px;">
                                <input type="date" class="form-control flatpickr-no-config" placeholder="Pilih Tahun" aria-label="Example text with button addon" aria-describedby="button-addon1" name="tahun">
                                <button name="btn" class="btn btn-info btn-sm" type="submit" id="button-addon1">Cetak Tahun</button>
                            </div>
                        </form>
                        <?php
                        $dataEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi ORDER BY tahun_evaluasi ASC");

                        $layakMutasi = [];
                        $tidakLayakMutasi = [];

                        foreach ($dataEvaluasi as $dE) {
                            if ($dE['cluster'] == '1') {
                                $layakMutasi[] = $dE;
                            } else {
                                $tidakLayakMutasi[] = $dE;
                            }
                        }

                        $jumlahLayakMutasi = count($layakMutasi);
                        $jumlahTidakLayakMutasi = count($tidakLayakMutasi);
                        ?>

                        <!-- <h5 class="mt-2">Layak Mutasi</h5>
                        <table class="table table-striped mt-5" id="tableLayakMutasi" style="text-align: center; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Guru</th>
                                    <th>Satuan Pendidikan</th>
                                    <th>Jabatan</th>
                                    <th>Masa Kerja</th>
                                    <th>Jam Kerja</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($layakMutasi as $dE) : ?>
                                    <?php
                                    $namaGuru = htmlspecialchars($dE['nama_guru']);
                                    $dataGuru = mysqli_query($con, "SELECT * FROM tb_guru WHERE nama_guru = '$namaGuru'");
                                    while ($dG = mysqli_fetch_array($dataGuru)) {
                                        echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $dG['nip'] . '</td>
                                            <td>' . $dG['nama_guru'] . '</td>
                                            <td>' . $dG['satuan_pendidikan'] . '</td>
                                            <td>' . $dG['jabatan'] . '</td>
                                            <td>' . $dG['masa_kerja'] . ' Tahun' . '</td>
                                            <td>' . $dG['jam_kerja'] . ' Jam' . '</td>
                                            <td>
                                                <img src="../assets/img/user/' . $dG['foto'] . '" alt="Foto Guru" width="40px">
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <h5 class="mt-5">Tidak Layak Mutasi</h5>
                        <table class="table table-striped mt-5" id="tableTidakLayakMutasi" style="text-align: center; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Tahun Evaluasi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($tidakLayakMutasi as $dE) : ?>
                                    <?php
                                    $namaGuru = htmlspecialchars($dE['nama_guru']);
                                    $dataGuru = mysqli_query($con, "SELECT * FROM tb_guru WHERE nama_guru = '$namaGuru'");
                                    while ($dG = mysqli_fetch_array($dataGuru)) {
                                        echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $dG['nip'] . '</td>
                                            <td>' . $dG['nama_guru'] . '</td>
                                            <td>' . $dG['satuan_pendidikan'] . '</td>
                                            <td>' . $dG['jabatan'] . '</td>
                                            <td>' . $dG['masa_kerja'] . ' Tahun' . '</td>
                                            <td>' . $dG['jam_kerja'] . ' Jam' . '</td>
                                            <td>
                                                <img src="../assets/img/user/' . $dG['foto'] . '" alt="Foto Guru" width="40px">
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>