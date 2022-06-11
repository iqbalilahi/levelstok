<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SCH_PRODUKSI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Kd Produksi <?php echo form_error('kd_produksi') ?></td><td><input type="text" class="form-control" name="kd_produksi" id="kd_produksi" placeholder="Kd Produksi" value="<?php echo $kd_produksi; ?>" /></td></tr>
	    <tr><td width='200'>Id Model <?php echo form_error('id_model') ?></td><td><input type="text" class="form-control" name="id_model" id="id_model" placeholder="Id Model" value="<?php echo $id_model; ?>" /></td></tr>
	    <tr><td width='200'>Stok Pemakaian <?php echo form_error('stok_pemakaian') ?></td><td><input type="text" class="form-control" name="stok_pemakaian" id="stok_pemakaian" placeholder="Stok Pemakaian" value="<?php echo $stok_pemakaian; ?>" /></td></tr>
	    <tr><td width='200'>Tgl Produksi <?php echo form_error('tgl_produksi') ?></td><td><input type="date" class="form-control" name="tgl_produksi" id="tgl_produksi" placeholder="Tgl Produksi" value="<?php echo $tgl_produksi; ?>" /></td></tr>
	    <tr><td width='200'>Hasil Stok <?php echo form_error('hasil_stok') ?></td><td><input type="text" class="form-control" name="hasil_stok" id="hasil_stok" placeholder="Hasil Stok" value="<?php echo $hasil_stok; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_produksi" value="<?php echo $id_produksi; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('sch_produksi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>