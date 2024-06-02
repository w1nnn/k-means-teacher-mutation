<?php
$tb_hasil_evaluasi = mysqli_query($con, "SELECT * FROM tb_evaluasi");
$jumlah_hasil_evaluasi = mysqli_num_rows($tb_hasil_evaluasi);
$nip = $data['nip'];
$nama = $data['nama_guru'];
$jabatan = $data['jabatan'];
$satuan_pendidikan = $data['satuan_pendidikan'];
$query = "SELECT * FROM tb_hasil_evaluasi WHERE layak= '$nip' OR tidak_layak= '$nip'";
$hasilEvaluasi = mysqli_query($con, $query);

if (!$hasilEvaluasi) {
	die('Error: ' . mysqli_error($con));
}

$data = [];

while ($row = mysqli_fetch_assoc($hasilEvaluasi)) {
	if ($row['layak'] == $nip) {
		$data[] = array('status' => 'Layak Mutasi');
	}
	if ($row['tidak_layak'] == $nip) {
		$data[] = array('status' => 'Tidak Layak Mutasi');
	}
}

$existing_query = "SELECT * FROM tb_hasil_evaluasi WHERE layak='$nip' OR tidak_layak='$nip'";
$existing_result = mysqli_query($con, $existing_query);
?>

<div class="page-inner" style="margin-bottom: 5rem;">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<h6 class="text-center" id="typedText"><span></span></h6>
						<h6 class="text-center">MUTASI GURU PADA DINAS PENDIDIKAN KAB SINJAI DENGAN ALGORITMA K-MEANS</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<h6 class="text-center">Usulan Rekomendasi Mutasi</h6>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Nip</th>
								<th>Nama</th>
								<th>Satuan Pendidikan</th>
								<th>Jabatan</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
								<div class="toast-header">
									<svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
										<?php
										if (mysqli_num_rows($existing_result) > 0) {
											echo '<rect width="100%" height="100%" fill="#007aff"></rect>'; // Blue color for proposed
										} else {
											echo '<rect width="100%" height="100%" fill="#ff0000"></rect>'; // Red color for not proposed
										}
										?>
									</svg>
									<strong class="me-auto"><button style="font-size: 8px;" type="button" class="btn btn-primary btn-sm position-relative">
											Pesan
											<span style="font-size: 8px;" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
												1
												<span class="visually-hidden">unread messages</span>
											</span>
										</button></strong>
									<small><i class="bi bi-patch-check"></i></small>
									<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
								</div>
								<div class="toast-body">
									<?php
									if (mysqli_num_rows($existing_result) > 0) {
										echo "NIP ini sudah di evaluasi oleh Dinas Pendidikan.";
									} else {
										echo "NIP ini belum di evaluasi oleh Dinas Pendidikan.";
									}
									?>
								</div>
							</div>

							<?php
							if (mysqli_num_rows($existing_result) == 0) {
								echo '<tr><td colspan="6" class="text-center">No Data</td></tr>';
							} else {
								foreach ($data as $key => $row) {
							?>
									<tr>
										<td><?= $key + 1; ?></td>
										<td><?= $nip; ?></td>
										<td><?= $nama; ?></td>
										<td><?= $satuan_pendidikan; ?></td>
										<td><?= $jabatan; ?></td>
										<td>
											<?php if ($row['status'] == 'Layak Mutasi') { ?>
												<span class="badge bg-success"><?= $row['status']; ?></span>
											<?php } else { ?>
												<span class="badge bg-danger"><?= $row['status']; ?></span>
											<?php } ?>
										</td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>