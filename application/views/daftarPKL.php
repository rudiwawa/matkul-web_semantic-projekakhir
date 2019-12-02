
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- /.row -->
                        <!-- Main row -->
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-8">
                                <!-- general form elements -->
                                <div class="card card-secondary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <?php if ($this->session->userdata('status') != "valid") { ?>
                                                     <i class="fas fa-times-circle mx-auto" style="font-size: 300px;"></i>
                                                <?php }
                                                else{ ?>
                                                    <i class="fas fa-check-circle mx-auto" style="font-size: 300px;"></i>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-7 my-auto">
                                                <h2 class="text-bold">Status PKL</h2>
                                                <?php if ($this->session->userdata('status') != "valid") { ?>     
                                                    <h2 class="text-danger">Belum Mendaftar PKL</h2>
                                                <?php }
                                                else{ ?>
                                                     <h2 class="text-success">Sudah Mendaftar PKL</h2>
                                                <?php } ?>
                                            </div>
                                            <!-- <span>Wakakaka</span> -->
                                        </div>
                                        <?php if ($this->session->userdata('status') != "valid") { ?>     
                                            <a href="<?php echo base_url('Mahasiswa/formDaftarPKL') ?>" class="btn btn-primary mt-3 float-right">Daftar
                                            PKL</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- /.card -->

                            </div>
                            <!--/.col (left) -->
                        </div>
                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
