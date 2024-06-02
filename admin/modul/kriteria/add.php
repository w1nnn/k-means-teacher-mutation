<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Tambah Kriteria</h3>
                </div>
                <div class="card-body">
                    <form action="?page=kriteria&act=proses" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input required name="nama_kriteria" type="text" class="form-control" placeholder="Nama Kriteria">
                        </div>

                        <div class="form-group">
                            <button name="saveKriteria" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>