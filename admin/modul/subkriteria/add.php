<?php
$kriteria = mysqli_query($con, "SELECT * FROM tb_kriteria");
?>

<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Tambah Sub Kriteria</h3>
                </div>
                <div class="card-body">
                    <form action="?page=subkriteria&act=proses" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input required name="nama_sub_kriteria" type="text" class="form-control" placeholder="Nama Sub Kriteria">
                        </div>

                        <div class="form-group">
                            <label>Bobot</label>
                            <input required name="bobot" type="text" class="form-control" placeholder="Bobot">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <select class="choices form-select" name="kriteria_id">
                                <option value="">Pilih</option>
                                <?php foreach ($kriteria as $k) : ?>
                                    <option value="<?= $k['id_kriteria']; ?>"><?= $k['nama_kriteria']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button name="saveSubKriteria" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>