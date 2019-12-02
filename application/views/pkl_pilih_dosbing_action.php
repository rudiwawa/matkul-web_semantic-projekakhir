<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php
        echo form_open('Dosen/pkl_lihat_dosbing_save', 'class="form-group" id="myform"');
        ?>
        <!-- <div class="form-group"> -->
        <label for="exampleInputPassword1">Ganti Dosen Pembimbing</label>
        <select class="form-control">
            <?php foreach ($data as $key => $value) {?>
                <option><?= $value['nama_lengkap']['value'] ?></option>";
            <?php } ?>
        </select>
        <button type="submit" class="btn btn-primary">Save</button>
        <?php echo form_close(); ?>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->