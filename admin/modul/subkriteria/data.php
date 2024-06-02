<?php

$kriteria_query = mysqli_query($con, "
    SELECT 
        tb_sub_kriteria.id_sub_kriteria,
        tb_sub_kriteria.nama_sub_kriteria,
        tb_sub_kriteria.bobot,  
        tb_kriteria.id_kriteria,
        tb_kriteria.nama_kriteria
    FROM 
        tb_sub_kriteria
    JOIN 
        tb_kriteria ON tb_sub_kriteria.kriteria_id = tb_kriteria.id_kriteria;
");
?>
<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Sub Kriteria Mutasi</h5>
                    <a href="?page=subkriteria&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kriteria</th>
                                <th>Sub Kriteria</th>
                                <th>Bobot</th>
                                <th>Id Kriteria</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($k = mysqli_fetch_assoc($kriteria_query)) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?>.</td>
                                    <td><?= $k['nama_kriteria']; ?></td>
                                    <td><?= $k['nama_sub_kriteria']; ?></td>
                                    <td><?= $k['bobot']; ?></td>
                                    <td><?= $k['id_kriteria']; ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?page=subkriteria&act=edit&id=<?= $k['id_sub_kriteria'] ?>">Ubah</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=subkriteria&act=del&id=<?= $k['id_sub_kriteria'] ?>">Hapus</a>
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