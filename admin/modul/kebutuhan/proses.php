<?php
if (isset($_POST['saveAlternatif'])) {
  $satuan_pendidikan = mysqli_real_escape_string($con, $_POST['satuan_pendidikan']);
  $guru_matematika = mysqli_real_escape_string($con, $_POST['guru_matematika']);
  $guru_penjaskes = mysqli_real_escape_string($con, $_POST['guru_penjaskes']);
  $guru_bahasa_indonesia = mysqli_real_escape_string($con, $_POST['guru_bahasa_indonesia']);
  $guru_bahasa_inggris = mysqli_real_escape_string($con, $_POST['guru_bahasa_inggris']);
  $guru_ipa = mysqli_real_escape_string($con, $_POST['guru_ipa']);
  $guru_ips = mysqli_real_escape_string($con, $_POST['guru_ips']);
  $guru_seni_budaya = mysqli_real_escape_string($con, $_POST['guru_seni_budaya']);
  $guru_agama = mysqli_real_escape_string($con, $_POST['guru_agama']);
  $guru_bk = mysqli_real_escape_string($con, $_POST['guru_bk']);

  $save = mysqli_query($con, "INSERT INTO tb_alternatif (satuan_pendidikan, guru_matematika, guru_penjaskes, guru_bahasa_indonesia, guru_bahasa_ingris, guru_ipa, guru_ips, guru_seni_budaya, guru_agama, guru_bk) VALUES ('$satuan_pendidikan', '$guru_matematika', '$guru_penjaskes', '$guru_bahasa_indonesia', '$guru_bahasa_inggris', '$guru_ipa', '$guru_ips', '$guru_seni_budaya', '$guru_agama', '$guru_bk')");
  if ($save) {
    echo "<script type='text/javascript'>
                alert('Data Berhasil Disimpan');
                window.location.replace('?page=alternatif');
              </script>";
  } else {
    echo "<script type='text/javascript'>
                alert('Data Gagal Disimpan');
                window.location.replace('?page=alternatif');
              </script>";
  }
}

if (isset($_POST['editAlternatif'])) {
  $id = mysqli_real_escape_string($con, $_POST['id']);
  $satuan_pendidikan = mysqli_real_escape_string($con, $_POST['satuan_pendidikan']);
  $guru_matematika = mysqli_real_escape_string($con, $_POST['guru_matematika']);
  $guru_penjaskes = mysqli_real_escape_string($con, $_POST['guru_penjaskes']);
  $guru_bahasa_indonesia = mysqli_real_escape_string($con, $_POST['guru_bahasa_indonesia']);
  $guru_bahasa_inggris = mysqli_real_escape_string($con, $_POST['guru_bahasa_inggris']);
  $guru_ipa = mysqli_real_escape_string($con, $_POST['guru_ipa']);
  $guru_ips = mysqli_real_escape_string($con, $_POST['guru_ips']);
  $guru_seni_budaya = mysqli_real_escape_string($con, $_POST['guru_seni_budaya']);
  $guru_agama = mysqli_real_escape_string($con, $_POST['guru_agama']);
  $guru_bk = mysqli_real_escape_string($con, $_POST['guru_bk']);

  $update = mysqli_query($con, "UPDATE tb_alternatif SET satuan_pendidikan='$satuan_pendidikan', guru_matematika='$guru_matematika', guru_penjaskes='$guru_penjaskes', guru_bahasa_indonesia='$guru_bahasa_indonesia', guru_bahasa_ingris='$guru_bahasa_inggris', guru_ipa='$guru_ipa', guru_ips='$guru_ips', guru_seni_budaya='$guru_seni_budaya', guru_agama='$guru_agama', guru_bk='$guru_bk' WHERE id_alternatif='$id'");
  if ($update) {
    echo "<script type='text/javascript'>
                alert('Data Berhasil Diedit');
                window.location.replace('?page=alternatif');
              </script>";
  } else {
    echo "<script type='text/javascript'>
                alert('Data Gagal Diedit');
                window.location.replace('?page=alternatif');
              </script>";
  }
}
