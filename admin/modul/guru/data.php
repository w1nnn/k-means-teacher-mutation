<div class="page-inner">
  <div class="row">
    <section class="section">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="card-title">Daftar Guru</h5>
          <a href="?page=guru&act=add" class="btn icon btn-primary btn-sm text-white"><i class="bi bi-plus"></i> Tambah</a>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped" id="guru">
            <thead>
              <tr>
                <th>#</th>
                <th>Nip</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Masa Kerja</th>
                <th>Satuan Pendidikan</th>
                <th>Jam Kerja</th>
                <th>Jenis Kelamin</th>
                <th>Foto</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $guru = mysqli_query($con, "SELECT * FROM tb_guru");
              foreach ($guru as $g) { ?>
                <tr>
                  <td><?= $no++; ?>.</td>

                  <td><?= $g['nip']; ?></td>
                  <td><?= $g['nama_guru']; ?></td>
                  <td><?= $g['jabatan']; ?></td>
                  <td><?= $g['masa_kerja']; ?> Tahun</td>
                  <td><?= $g['satuan_pendidikan']; ?></td>
                  <td><?= $g['jam_kerja']; ?> Jam</td>
                  <td><?= $g['jenis_kelamin']; ?></td>

                  <td>
                    <img src="../assets/img/user/<?= $g['foto'] ?>" width="45" height="45">
                  </td>
                  <td>
                    <a class="btn btn-info btn-sm" href="?page=guru&act=edit&id=<?= $g['id_guru'] ?>">Ubah</a>
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=guru&act=del&id=<?= $g['id_guru'] ?>">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>