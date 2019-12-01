<!-- Main content -->
<section class="content ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header text-center">
            <h3 class="card-title">Data Mahasiswa Semhas PKL</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kelompok</th>
                  <th>Nama Anggota</th>
                  <th>Tempat PKL</th>
                  <th>Keminatan</th>
                  <th>Dosen Penguji</th>
                  <th>Validasi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // var_dump($data);
                $trim = "http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#";
                foreach ($non_valid as $key => $kelompok) {
                  // echo $key;
                  ?>
                  <tr>
                    <td><?= substr($kelompok['kelompok'], 64); ?></td>
                    <td class="list-inline-item">
                      <?php
                        foreach ($kelompok as $key => $value) {
                          if (!($key === "kelompok")) {
                            ?>

                          <?= $value['data']['nama']['value'] ?>,
                      <?php }
                        }
                        ?>
                    </td>
                    <td><?= ($kelompok[0]['data']['tempat_pkl']['value']); ?></td>
                    <td><span class="tag tag-success"><?= ($kelompok[0]['data']['minat']['value']); ?></span></td>
                    <td><?= $kelompok[0]['data']['nama_dosen']['value']; ?></td>
                    <td><a href="#" class="btn btn-success btn-lg">Validasi</a></td>
                  </tr>
                <?php
                }

                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>

  <!-- /.row -->

  <!-- /.row -->
  <div class="row" text-center>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Hasil Validasi PKL</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed">
            <thead>
              <tr>
                <th>Kelompok</th>
                <th>Nama Anggota</th>
                <th>Ruang Semhas</th>
                <th>Keminatan</th>
                <th>Dosen Penguji</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // var_dump($data);
              $trim = "http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#";
              foreach ($valid as $key => $kelompok) {
                // echo $key;
                ?>
                <tr>
                  <td><?= substr($kelompok['kelompok'], 64); ?></td>
                  <td class="list-inline-item">
                    <?php
                      foreach ($kelompok as $key => $value) {
                        if (!($key === "kelompok")) {
                          ?>

                        <?= $value['data']['nama']['value'] ?>,
                    <?php }
                      }
                      ?>
                  </td>
                  <td><?= ($kelompok[0]['data']['tempat_pkl']['value']); ?></td>
                  <td><span class="tag tag-success"><?= ($kelompok[0]['data']['minat']['value']); ?></span></td>
                  <td><?= $kelompok[0]['data']['nama_dosen']['value']; ?></td>
                  <td><a href="#" class="fas fa-check-circle mx-auto"></a></td>
                </tr>
              <?php
              }

              ?>

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
  <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->