<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kelompok PKL</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 1%">
              #
            </th>
            <th style="width: 20%">
              Nama Kelompok
            </th>
            <th style="width: 30%">
              Team Members
            </th>


            <th style="width: 20%">
              Dosen Pembimbing
            </th>
            <th style="width: 20%">
              Action
            </th>
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
              <td>
                #
              </td>
              <td>
                <a>
                  <?= substr($kelompok['kelompok'], 64); ?>
                </a>
                <br />
                <small>
                  Created 01.01.2019
                </small>
              </td>
              <td>
                <ul class="list-inline">
                  <?php
                    foreach ($kelompok as $key => $value) {
                      if (!($key === "kelompok")) {
                        ?>
                      <li class="list-inline-item">
                        <?= $value['data']['nama']['value'] ?>,
                      </li>
                  <?php
                        // var_dump($value['data']['nama']['value']); 
                      }
                      //  echo "<br>--------------<br>"; 
                    }
                    ?>

                </ul>
              </td>
              <td class="project_progress">
                <?= substr($kelompok[0]['data']['dosen']['value'], 64); ?>
              </td>
              <td class="project_progress">
                <a class="btn btn-primary btn-sm" href="<?= base_url('Dosen/pkl_lihat_dosbing_action/'.substr($kelompok['kelompok'], 64)) ?>">
                  EDIT Dosbing
                </a>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->