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
    
            <th style="width: 8%" class="text-center">
              Status
            </th>
            <th style="width: 20%">
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
                  <?= substr($kelompok['kelompok'],64); ?>
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
                    if (!($key ==="kelompok")) {
                      ?>
                                        <li class="list-inline-item">
                    <?=$value['data']['nama']['value']?>,
                  </li>
                  <?php
                      // var_dump($value['data']['nama']['value']); 
                    }
                    //  echo "<br>--------------<br>"; 
                  }
                  ?>
     
                </ul>
              </td>
              <td class="project-state">
                <span class="badge badge-success"><?=$value['data']['status']['value']?></span>
              </td>
              <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="input_nilai.html">
                  <i class="fas fa-folder">
                  </i>
                  View
                </a>
                <a class="btn btn-info btn-sm" href="pkl_pilih_dosbing.html">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                </a>
                <a class="btn btn-danger btn-sm" href="#">
                  <i class="fas fa-trash">
                  </i>
                  Delete
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