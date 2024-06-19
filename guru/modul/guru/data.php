<div class="page-inner">
  <div class="row">
    <section class="section">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h5 class="card-title">Daftar Guru</h5>
          <!-- <a href="?page=guru&act=add" class="btn icon btn-primary btn-sm text-white"><i class="bi bi-plus"></i> Tambah</a> -->
        </div>
        <div class="card-body">
          <table class="table table-striped" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Nip</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Satuan Pendidikan</th>
                <th>Jenis Kelamin</th>
                <th>Foto</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $id_login = $_SESSION['guru'];
              $no = 1;
              $guru = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru = '$id_login'");
              foreach ($guru as $g) { ?>
                <tr>
                  <td><?= $no++; ?>.</td>

                  <td><?= $g['nip']; ?></td>
                  <td><?= $g['nama_guru']; ?></td>
                  <td><?= $g['jabatan']; ?></td>
                  <td><?= $g['satuan_pendidikan']; ?></td>
                  <td><?= $g['jenis_kelamin']; ?></td>

                  <td>
                    <img src="../assets/img/user/<?= $g['foto'] ?>" width="45" height="45">
                  </td>
                  <td>
                    <a class="btn btn-info btn-sm" href="?page=guru&act=edit&id=<?= $g['id_guru'] ?>">Lengkapi</a>
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