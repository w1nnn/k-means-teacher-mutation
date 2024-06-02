<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Kriteria Mutasi</h5>
                    <a href="?page=kriteria&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kriteria</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $kriteria = mysqli_query($con, "SELECT * FROM tb_kriteria");
                            foreach ($kriteria as $k) { ?>
                                <tr>
                                    <td><?= $no++; ?>.</td>
                                    <td><?= $k['nama_kriteria']; ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="?page=kriteria&act=edit&id=<?= $k['id_kriteria'] ?>"><i class="far fa-edit"></i>Ubah</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=kriteria&act=del&id=<?= $k['id_kriteria'] ?>"><i class="fas fa-trash"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>