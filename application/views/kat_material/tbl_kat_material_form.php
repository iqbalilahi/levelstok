<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_KAT_MATERIAL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Kat Material <?php echo form_error('nama_kat_material') ?></td><td><input type="text" class="form-control" name="nama_kat_material" id="nama_kat_material" placeholder="Nama Kat Material" value="<?php echo $nama_kat_material; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_kat_material" value="<?php echo $id_kat_material; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('kat_material') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>