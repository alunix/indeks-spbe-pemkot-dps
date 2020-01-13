<?php

// link ke file yang dituju melalui include
if (isset($_GET['act']) && $_GET['act'] == "hapus") {
  include 'delete.php';
} else if (isset($_GET['act']) && $_GET['act'] == "tambah") {
  include 'formtambah.php';
} else if (isset($_GET['act']) && $_GET['act'] == "ubah") {
  include 'formedit.php';
} else {


  ?>


  <!-- agar menu sidebar saat di klik active -->
  <script type="text/javascript">
    document.getElementById('alleva').classList.add('active');
  </script>


  <!-- isi konten -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

      <h1 class="h3 mb-0 text-gray-800"><?php include 'template/title.php'; ?></h1>

    </div>

    <div class="row">

      <div class="col-xl-12 col-lg-12">

        <!-- <a class="btn btn-primary btn-icon-split h3 mb-4" title="Tambah" href="?page=indeks&act=tambah">
          <span class="icon">
            <i class="fas fa-fw fa-plus"></i>
          </span>
          <span class="text">Tambah</span>
        </a> -->

        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data <?php include 'template/title.php'; ?></h6>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionExample">
            <?php
              $sql = "SELECT * FROM tb_indeks";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">
                      <?= $row['nama_indeks']; ?>
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead align="center" >
                          <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nilai Pusat</th>
                            <th rowspan="2">Tahapan Yang Harus dipenuhi OPD untuk menaikkan nilai SPBE</th>
                            <th rowspan="2">OPD Terkait</th>
                            <th colspan="2">Data Pendukung</th>
                          </tr>
                          <tr>
                            <th>Telah dimiliki</th>
                            <th>Belum dimiliki</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "SELECT * FROM tb_indeks";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              $no = 1;
                              // output data of each row
                              while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id_indeks'];
                                $nama_indeks = $row['nama_indeks'];
                                $nilai_indeks = $row['nilai_indeks'];
                                $tahun_indeks = $row['tahun_indeks'];
                                ?>

                              <tr>
                                <td><?= $no; ?></td>
                                <td><?= $nama_indeks; ?></td>
                                <td><?= number_format($nilai_indeks, 2, ",", "."); ?></td>
                                <td><?= $tahun_indeks; ?></td>
                                <td><?= $tahun_indeks; ?></td>
                                <td><?= $tahun_indeks; ?></td>
                              </tr>
                          <?php
                                $no++;
                              }
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

<?php } ?>