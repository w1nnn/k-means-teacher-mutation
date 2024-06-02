<?php
$alternatif_query = mysqli_query($con, "SELECT * FROM tb_alternatif");
?>


<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Analisis Kebutuhan Sekolah</h5>
                    <a href="?page=alternatif&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Satuan Pendidikan</th>
                                <th colspan="9" class="text-center"> Kebutuhan Guru</th>
                                <th rowspan="2">Opsi</th>
                            </tr>
                            <tr>
                                <th>Matematika</th>
                                <th>Penjaskes</th>
                                <th>Bahasa Indonesia</th>
                                <th>Bahasa Inggris</th>
                                <th>IPA</th>
                                <th>IPS</th>
                                <th>Seni Budaya</th>
                                <th>Agama</th>
                                <th>BK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($alternatif_query)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?>.</td>
                                    <td><?= $row['satuan_pendidikan']; ?></td>
                                    <td><?= $row['guru_mtk']; ?></td>
                                    <td><?= $row['guru_penjaskes']; ?></td>
                                    <td><?= $row['guru_bhs_indo']; ?></td>
                                    <td><?= $row['guru_bhs_ing']; ?></td>
                                    <td><?= $row['guru_ipa']; ?></td>
                                    <td><?= $row['guru_ips']; ?></td>
                                    <td><?= $row['guru_seni_budaya']; ?></td>
                                    <td><?= $row['guru_agama']; ?></td>
                                    <td><?= $row['guru_bk']; ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?page=alternatif&act=edit&id=<?= $row['id_alternatif'] ?>"><i class="far fa-edit"></i> Ubah</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=alternatif&act=del&id=<?= $row['id_alternatif'] ?>"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>