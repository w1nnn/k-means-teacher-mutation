<?php
$alternatif_query = mysqli_query($con, "SELECT * FROM tb_kebutuhan WHERE id_sekolah = '$id_login'");
?>


<div class="page-inner">
	<div class="row">
		<section class="section">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Analisis Kebutuhan Sekolah</h5>
					<a href="?page=alternatif&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Kebutuhan</a>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th rowspan="2">#</th>
								<th rowspan="2">NPSN</th>
								<th rowspan="2">Nama Sekolah</th>
								<th rowspan="2">Kecamatan</th>
								<th colspan="7" class="text-center">Kebutuhan Guru</th>
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
									<td>
										<a class="btn btn-info btn-sm" href="?page=kebutuhan&act=edit&id=<?= $row['id_sekolah'] ?>"><i class="far fa-edit"></i> Usulan</a>
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