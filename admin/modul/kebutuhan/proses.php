<?php
if (isset($_POST['saveAlternatif'])) {
  $npsn = mysqli_real_escape_string($con, $_POST['npsn']);
  $nama_sekolah = mysqli_real_escape_string($con, $_POST['nama_sekolah']);
  $kecamatan = mysqli_real_escape_string($con, $_POST['kecamatan']);
  $guru_matematika = mysqli_real_escape_string($con, $_POST['guru_matematika']);
  $guru_penjaskes = mysqli_real_escape_string($con, $_POST['guru_penjaskes']);
  $guru_bahasa_indonesia = mysqli_real_escape_string($con, $_POST['guru_bahasa_indonesia']);
  $guru_bahasa_inggris = mysqli_real_escape_string($con, $_POST['guru_bahasa_inggris']);
  $guru_ipa = mysqli_real_escape_string($con, $_POST['guru_ipa']);
  $guru_ips = mysqli_real_escape_string($con, $_POST['guru_ips']);
  $guru_seni_budaya = mysqli_real_escape_string($con, $_POST['guru_seni_budaya']);
  $guru_agama = mysqli_real_escape_string($con, $_POST['guru_agama']);

  $check_query = mysqli_query($con, "SELECT COUNT(*) AS count FROM tb_kebutuhan WHERE npsn = '$npsn'");
  $row = mysqli_fetch_assoc($check_query);
  $count = $row['count'];

  if ($count > 0) {
    echo "<script type='text/javascript'>
              alert('NPSN sudah ada dalam database, data tidak bisa ditambahkan.');
              window.location.replace('?page=kebutuhan');
            </script>";
  } else {
    $save = mysqli_query($con, "INSERT INTO tb_kebutuhan (npsn, nama_sekolah, kecamatan, guru_matematika, guru_bahasa_indonesia, guru_penjaskes, guru_ipa, guru_ips, guru_agama, guru_bahasa_ingris, guru_seni_budaya) 
                                  VALUES ('$npsn', '$nama_sekolah', '$kecamatan', '$guru_matematika', '$guru_bahasa_indonesia', '$guru_penjaskes', '$guru_ipa', '$guru_ips',  '$guru_agama', '$guru_bahasa_inggris', '$guru_seni_budaya')");
    if ($save) {
      echo "<script type='text/javascript'>
                  alert('Data Berhasil Disimpan');
                  window.location.replace('?page=kebutuhan');
                </script>";
    } else {
      echo "<script type='text/javascript'>
                  alert('Data Gagal Disimpan');
                  window.location.replace('?page=kebutuhan');
                </script>";
    }
  }
}


if (isset($_POST['editAlternatif'])) {
  $id = mysqli_real_escape_string($con, $_POST['id']);
  // $satuan_pendidikan = mysqli_real_escape_string($con, $_POST['satuan_pendidikan']);
  $guru_matematika = mysqli_real_escape_string($con, $_POST['guru_matematika']);
  $guru_penjaskes = mysqli_real_escape_string($con, $_POST['guru_penjaskes']);
  $guru_bahasa_indonesia = mysqli_real_escape_string($con, $_POST['guru_bahasa_indonesia']);
  $guru_bahasa_inggris = mysqli_real_escape_string($con, $_POST['guru_bahasa_inggris']);
  $guru_ipa = mysqli_real_escape_string($con, $_POST['guru_ipa']);
  $guru_ips = mysqli_real_escape_string($con, $_POST['guru_ips']);
  $guru_seni_budaya = mysqli_real_escape_string($con, $_POST['guru_seni_budaya']);
  $guru_agama = mysqli_real_escape_string($con, $_POST['guru_agama']);

  $update = mysqli_query($con, "UPDATE tb_kebutuhan SET guru_matematika='$guru_matematika', guru_penjaskes='$guru_penjaskes', guru_bahasa_indonesia='$guru_bahasa_indonesia', guru_bahasa_ingris='$guru_bahasa_inggris', guru_ipa='$guru_ipa', guru_ips='$guru_ips', guru_seni_budaya='$guru_seni_budaya', guru_agama='$guru_agama' WHERE id_sekolah='$id'");
  if ($update) {
    echo "<script type='text/javascript'>
                alert('Data Berhasil Diedit');
                window.location.replace('?page=kebutuhan');
              </script>";
  } else {
    echo "<script type='text/javascript'>
                alert('Data Gagal Diedit');
                window.location.replace('?page=kebutuhan');
              </script>";
  }
}
