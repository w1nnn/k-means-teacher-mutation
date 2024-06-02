<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Evaluasi Guru</h5>
                    <a href="?page=evaluasi&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                    <!-- <a href="?page=proses&act=metode" id="prosesBtn" class="btn btn-primary btn-sm" onclick="prosesKMeans()">
                        <i class="fa fa-save"></i>Proses Metode K-Means
                    </a> -->
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