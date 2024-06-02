<?php
$edit = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru='$_GET[id]' ");
foreach ($edit as $d);
?>
<div class="page-inner">
	<div class="row">
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Form Edit Guru</h3>
				</div>
				<div class="card-body">
					<form action="?page=guru&act=proses" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>NIP/NUPTK</label>
							<input type="hidden" name="id" value="<?= $d['id_guru'] ?>">
							<input name="nip" type="text" class="form-control" value="<?= $d['nip'] ?>" readonly>
						</div>

						<div class="form-group">
							<label>Nama Guru</label>
							<input name="nama" type="text" class="form-control" value="<?= $d['nama_guru'] ?>">
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<select class="choices form-select" name="jabatan">
								<option value="">Pilih</option>
								<option value="Guru Matematika" <?= ($d['jabatan'] == 'Guru Matematika') ? 'selected' : ''; ?>>Guru Matematika</option>
								<option value="Guru Penjaskes" <?= ($d['jabatan'] == 'Guru Penjaskes') ? 'selected' : ''; ?>>Guru Penjaskes</option>
								<option value="Guru Bahasa Indonesia" <?= ($d['jabatan'] == 'Guru Bahasa Indonesia') ? 'selected' : ''; ?>>Guru Bahasa Indonesia</option>
								<option value="Guru Bahasa Inggris" <?= ($d['jabatan'] == 'Guru Bahasa Inggris') ? 'selected' : ''; ?>>Guru Bahasa Inggris</option>
								<option value="Guru IPA" <?= ($d['jabatan'] == 'Guru IPA') ? 'selected' : ''; ?>>Guru IPA</option>
								<option value="Guru IPS" <?= ($d['jabatan'] == 'Guru IPS') ? 'selected' : ''; ?>>Guru IPS</option>
								<option value="Guru Agama" <?= ($d['jabatan'] == 'Guru Agama') ? 'selected' : ''; ?>>Guru Agama</option>
								<option value="Guru Seni Budaya" <?= ($d['jabatan'] == 'Guru Seni Budaya') ? 'selected' : ''; ?>>Guru Seni Budaya</option>
								<option value="Guru BK" <?= ($d['jabatan'] == 'Guru BK') ? 'selected' : ''; ?>>Guru BK</option>
							</select>
						</div>
						<div class="form-group">
							<label>Satuan Pendidikan</label>
							<input name="satuan_pendidikan" type="text" class="form-control" placeholder="Satuan Pendidikan" value="<?= $d['satuan_pendidikan'] ?>">
						</div>

						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="choices form-select" name="jk">
								<option value="">Pilih</option>
								<option value="L" <?= ($d['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki Laki</option>
								<option value="P" <?= ($d['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<p>
								<img src="../assets/img/user/<?= $d['foto']; ?>" class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
							</p>
							<label>Foto</label>
							<input type="file" name="foto">
						</div>
						<div class="form-group">
							<button name="editGuru" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
							<a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>