<?php

// inisiasi id
if (isset($_GET['id']) && $_GET['id'] != "") {
  $id = $_GET['id'];
} else {
  $id = "";
}

// query edit
if (isset($_POST['update'])) {
  $namadomain   = $_POST['namadomain'];
  $namaaspek    = $_POST['namaaspek'];
  $bobot        = str_replace(",", ".", $_POST['bobot']);
  $target       = $_POST['target'];
  $tahun        = $_POST['tahun'];
  $nilaindeks   = str_replace(",", ".", $_POST['nilaindeks']);
  $urutanaspek  = $_POST['urutanaspek'];

  $res = true;

  if ($res) {
    $sql = "UPDATE tb_aspek 
        SET iddomain = '$namadomain',
        nilai_indeks_aspek = '$nilaindeks',
        nama_aspek = '$namaaspek',
        bobot_aspek = '$bobot',
        target = '$target',
        urutan_aspek = '$urutanaspek',
        tahun_aspek = '$tahun'
        WHERE idaspek = '$id'";

    if (mysqli_query($conn, $sql)) {
      echo '<script type="text/javascript">
            alert("Data Aspek Berhasil Diedit");
            window.location.href="t.php?page=aspek";
            </script>';
    } else {
      echo '<script type="text/javascript">
            alert("Data Aspek Gagal Diedit");
            window.location.href="t.php?page=aspek&act=ubah&id=$id";
            </script>';
    }
  }
}

// query menampilkan data dengan id
$sqlUbah = "SELECT * FROM tb_aspek WHERE idaspek = '$id'";
$resUbah = mysqli_query($conn, $sqlUbah);
$data = mysqli_fetch_assoc($resUbah);

?>

<!-- agar menu sidebar saat di klik active -->
<script type="text/javascript">
  document.getElementById('aspek').classList.add('active');
</script>

<!-- isi konten -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800"><?php include 'template/title.php'; ?></h1>

  </div>

  <div class="row">

    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Form Ubah <?php include 'template/title.php'; ?></h6>
        </div>
        <div class="card-body">
          <div>
            <form method="post">
              <div class="form-group row">
                <label for="namadomain" class="col-md-2 col-form-label">Nama Domain</label>
                <div class="col-md-10">
                  <select class="form-control" id="namadomain" name="namadomain">
                    <option value="0">-</option>
                    <?php
                    $sqlDomain = "SELECT * FROM tb_domain ORDER BY namadomain ASC";
                    $resDomain = mysqli_query($conn, $sqlDomain);
                    while ($rowDomain = mysqli_fetch_assoc($resDomain)) {
                      if ($rowDomain['iddomain'] == $data['iddomain']) { ?>
                        <option value="<?= $rowDomain['iddomain']; ?>" selected><?= $rowDomain['namadomain']; ?></option>
                      <?php } else { ?>
                        <option value="<?= $rowDomain['iddomain']; ?>"><?= $rowDomain['namadomain']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="namaaspek" class="col-md-2 col-form-label">Nama Aspek</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="namaaspek" id="namaaspek" placeholder="Enter Nama Aspek" autocomplete="off" value="<?= $data['nama_aspek']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="bobot" class="col-md-2 col-form-label">Bobot (%)</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="bobot" id="bobot" placeholder="Enter Bobot" autocomplete="off" value="<?= number_format($data['bobot_aspek'], 2, ",", "."); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="target" class="col-md-2 col-form-label">Target</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="target" id="target" placeholder="Enter Target" autocomplete="off" value="<?= $data['target']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="tahun" class="col-md-2 col-form-label">Tahun</label>
                <div class="col-md-10">
                  <select class="form-control" id="tahun" name="tahun">
                    <option value="0">-</option>
                    <?php
                    $thnnow = date('Y');
                    for ($i = 2010; $i <= $thnnow; $i++) {
                      if ($data['tahun_aspek'] == $i) { ?>
                        <option value="<?= $i; ?>" selected><?= $i; ?></option>
                      <?php } else { ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nilaindeks" class="col-md-2 col-form-label">Nilai</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="nilaindeks" id="nilaindeks" placeholder="Enter Nilai Indeks" autocomplete="off" value="<?= number_format($data['nilai_indeks_aspek'], 2, ",", "."); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="urutanaspek" class="col-md-2 col-form-label">Urutan</label>
                <div class="col-md-2">
                  <input type="text" class="form-control" name="urutanaspek" id="urutanaspek" placeholder="Enter Urutan" autocomplete="off" value="<?= $data['urutan_aspek']; ?>">
                </div>
              </div>
              <div class="form-group">
                <a class="btn btn-dark btn-icon-split" title="Kembali" href="?page=aspek">
                  <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary" name="update">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>