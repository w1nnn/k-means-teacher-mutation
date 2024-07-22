<?php
$alternatif_query = mysqli_query($con, "SELECT * FROM tb_kebutuhan");
?>


<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Analisis Kebutuhan Sekolah</h5>
                    <a href="?page=kebutuhan&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-sm table-striped" id="kebutuhan-sekolah">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">NPSN</th>
                                <th rowspan="2">Nama Sekolah</th>
                                <th rowspan="2">Kecamatan</th>
                                <th colspan="8" class="text-center">Kebutuhan Guru</th>
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
                                <th>Guru Agama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($alternatif_query)) {
                            ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['npsn'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['nama_sekolah'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['kecamatan'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_matematika'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_penjaskes'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_bahasa_indonesia'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_bahasa_ingris'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_ipa'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_ips'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_seni_budaya'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($row['guru_agama'] ?? ''); ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?page=kebutuhan&act=edit&id=<?= $row['id_sekolah'] ?>"><i class="far fa-edit"></i> Ubah</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=kebutuhan&act=del&id=<?= $row['id_sekolah'] ?>">Hapus</a>

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