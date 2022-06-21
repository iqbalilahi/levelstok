<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA SCH_PRODUKSI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>       

	    <tr><td width='200'>Kd Produksi <?php echo form_error('kd_produksi') ?></td><td><input type="text" class="form-control" name="kd_produksi" id="kd_produksi" placeholder="Kd Produksi" value="<?php echo $kd_produksi; ?>" /></td></tr>
	    
	    <tr>
			<td>BOM <?php echo form_error('id_bom') ?></td>
			<td>
				<div class="form-group">
					<label>BOM</label>
					<select class="form-control" name="id_bom" id="id_bom">
						<option value="">Please Select</option>
						<?php
						foreach ($id_bom as $mod) {
						?>
							<!--di sini kita tambahkan class berisi id modegori material-->
							<option <?php echo $id_bom_selected == $mod->id_bom ? 'selected="selected"' : '' ?> class="<?php echo $mod->id_bom ?>" value="<?php echo $mod->id_bom ?>"><?php echo $mod->keterangan;?></option>
						
					</select>
					<?php }?>
				</div>
			</td>
		</tr>
			<tr><td width='200'> <?php echo form_error('id_model') ?></td><td><input type="text" class="form-control" name="id_model" id="id_model" value="" readonly /></td></tr>
		
			<tr><td width='200'></td><td><input type="text" class="form-control" name="qty" id="qty" value="" readonly /></td></tr>
		
		<tr><td width='200'>Stok Pemakaian <?php echo form_error('stok_pemakaian') ?></td><td><input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="stok_pemakaian" id="stok_pemakaian" placeholder="Stok Pemakaian" value="<?php echo $stok_pemakaian; ?>" /></td></tr>
	    <tr><td width='200'>Tgl Produksi <?php echo form_error('tgl_produksi') ?></td><td><input type="date" class="form-control" name="tgl_produksi" id="tgl_produksi" placeholder="Tgl Produksi" value="<?php echo $tgl_produksi; ?>" /></td></tr>
	    <tr><td width='200'>Hasil Stok <?php echo form_error('hasil_stok') ?></td><td><input type="text" class="form-control" name="hasil_stok" id="hasil_stok" placeholder="Hasil Stok" value="<?php echo $hasil_stok; ?>" readonly /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_produksi" value="<?php echo $id_produksi; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('sch_produksi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //request data model
        $('#id_bom').change(function() {
            var id_bom = $('#id_bom').val(); //ambil value id dari bom
            if (id_bom != '') {
                $.ajax({
                    url: '<?= base_url(); ?>sch_produksi/get_model',
                    method: 'POST',
                    data: {
                        id_bom: id_bom
                    },
                    success: function(data) {
						$('input[name=id_model]').val(data);
                    }
                });
				$.ajax({
                    url: '<?= base_url(); ?>sch_produksi/get_qty',
                    method: 'POST',
                    data: {
                        id_bom: id_bom
                    },
                    success: function(data) {
						var qty = $('input[name=qty]').val(data);
                    }
                });
            }
        });

		$(document).ready(function() {
			$("#stok_pemakaian").keyup(function() {
				var stok  = $("#qty").val();
				var pakai = $("#stok_pemakaian").val();
				var total = $("#hasil_stok").val(0);

				total = parseInt(stok) * parseInt(pakai);
				total = isNaN(total) ? 0 : total;
				$("#hasil_stok").val(total);
			});
		});

    });
	function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>