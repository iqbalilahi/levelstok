<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_MODEL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Kd Model <?php echo form_error('kd_model') ?></td><td><input type="text" class="form-control" name="kd_model" id="kd_model" placeholder="Kd Model" value="<?php echo $kd_model; ?>" /></td></tr>
	    <tr><td width='200'>Nama Model <?php echo form_error('nama_model') ?></td><td><input type="text" class="form-control" name="nama_model" id="nama_model" placeholder="Nama Model" value="<?php echo $nama_model; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_model" value="<?php echo $id_model; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('model') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>