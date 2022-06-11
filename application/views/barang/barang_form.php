<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA BARANG</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'>       

	    <tr><td width='200'>Kd Barang <?php echo form_error('kd_barang') ?></td><td><input type="text" class="form-control" name="kd_barang" id="kd_barang" placeholder="Kd Barang" value="<?php echo $kd_barang; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Id Jenis Brg <?php echo form_error('id_jenis_brg') ?></td><td><input type="text" class="form-control" name="id_jenis_brg" id="id_jenis_brg" placeholder="Id Jenis Brg" value="<?php echo $id_jenis_brg; ?>" /></td></tr> -->
	    <tr><td>Material <?php echo form_error('id_jenis_brg') ?></td>
            <td>
            <div class="form-group">
                        <label>Nama Material</label>
                        <select class="form-control" name="id_jenis_brg" id="id_jenis_brg">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($id_jenis_brg as $kot) {
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $jenis_brg_selected == $kot->id_jenis_brg ? 'selected="selected"' : '' ?>
                                    class="<?php echo $kot->id_jenis_brg ?>" value="<?php echo $kot->id_jenis_brg ?>"><?php echo $kot->material; echo " - "; echo $kot->tempat ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
        </td>
	    <tr><td width='200'>Nama Barang <?php echo form_error('nama_barang') ?></td><td><input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" /></td></tr>
	    <tr><td width='200'>Stok <?php echo form_error('stok') ?></td><td><input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" /></td></tr>
	    <tr><td>Customer <?php echo form_error('id_cust') ?></td>
            <td>
            <div class="form-group">
                        <label>Nama Customer</label>
                        <select class="form-control" name="id_cust" id="id_cust">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($id_cust as $kot) {
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $customer_selected == $kot->id_cust ? 'selected="selected"' : '' ?>
                                    class="<?php echo $kot->id_cust ?>" value="<?php echo $kot->id_cust ?>"><?php echo $kot->nama_cust; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
        </td>
	    <tr><td></td><td><input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('barang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>