<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Mahasiswa dan Dosen Pembimbing PKL</h3>

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
                  <th>Dosen Pembimbing</th>
                  <th>Validasi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // var_dump($data);
                $trim = "http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#";
                foreach ($data as $key => $kelompok) {
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
                    <td><?= substr($kelompok[0]['data']['dosen']['value'],64); ?></td>
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
                  <th>Tempat PKL</th>
                  <th>Keminatan</th>
                  <th>Dosen Pembimbing</th>
                  <th>Hasil Validasi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Hanifah , Kharis, Danang, Dicky</td>
                  <td>Gojek</td>
                  <td><span class="tag tag-success">KC</span></td>
                  <td>Dosen KC A</td>
                  <td>Tervalidasi</td>
                </tr>

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