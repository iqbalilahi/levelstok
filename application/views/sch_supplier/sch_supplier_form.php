<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SCH_SUPPLIER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Id Supplier <?php echo form_error('id_supplier') ?></td><td><input type="text" class="form-control" name="id_supplier" id="id_supplier" placeholder="Id Supplier" value="<?php echo $id_supplier; ?>" /></td></tr>
	    <tr><td width='200'>Id Material <?php echo form_error('id_material') ?></td><td><input type="text" class="form-control" name="id_material" id="id_material" placeholder="Id Material" value="<?php echo $id_material; ?>" /></td></tr>
	    <tr><td width='200'>Nama Supplier <?php echo form_error('nama_supplier') ?></td><td><input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" value="<?php echo $nama_supplier; ?>" /></td></tr>
	    <tr><td width='200'>Nomor Material <?php echo form_error('nomor_material') ?></td><td><input type="text" class="form-control" name="nomor_material" id="nomor_material" placeholder="Nomor Material" value="<?php echo $nomor_material; ?>" /></td></tr>
	    <tr><td width='200'>Satuan <?php echo form_error('satuan') ?></td><td><input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" /></td></tr>
	    <tr><td width='200'>Stok <?php echo form_error('stok') ?></td><td><input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" /></td></tr>
	    <tr><td width='200'>Tgl Datang <?php echo form_error('tgl_datang') ?></td><td><input type="date" class="form-control" name="tgl_datang" id="tgl_datang" placeholder="Tgl Datang" value="<?php echo $tgl_datang; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_sch_supplier" value="<?php echo $id_sch_supplier; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('sch_supplier') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>