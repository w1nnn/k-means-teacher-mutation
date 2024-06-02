<?php
$edit = mysqli_query($con, "SELECT * FROM tb_kriteria WHERE id_kriteria='$_GET[id]' ");
foreach ($edit as $d);
?>
<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Edit Kriteria</h3>
                </div>
                <div class="card-body">
                    <form action="?page=kriteria&act=proses" method="post">
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input name="nama_kriteria" type="text" class="form-control" placeholder="Nama Kriteria" value="<?= $d['nama_kriteria']; ?>">
                        </div>

                        <!-- Menambahkan input hidden untuk mengirimkan id kriteria -->
                        <input type="hidden" name="id" value="<?= $d['id_kriteria']; ?>">

                        <div class="form-group">
                            <button name="editKriteria" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                            <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>