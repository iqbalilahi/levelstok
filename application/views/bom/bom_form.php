<div class="content-wrapper">

	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">INPUT DATA BOM</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">

				<table class='table table-bordered>' 
				<tr>
                        <td>Nama Material <?php echo form_error('id_material') ?></td>
                        <td>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="id_material" id="id_material">
                                    <option value="">Please Select</option>
                                    <?php
                                    foreach ($id_material as $mat) {
                                    ?>
                                        <option <?php echo $material_selected == $mat->id_material ? 'selected="selected"' : '' ?> class="<?php echo $mat->id_material ?>" value="<?php echo $mat->id_material ?>"><?php echo $mat->nama_material; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
					<tr>
						<td>Nama Model <?php echo form_error('id_model') ?></td>
						<td>
							<div class="form-group">
								<label>Nama Model</label>
								<select class="form-control" name="id_model" id="id_model">
									<option value="">Please Select</option>
									<?php
									foreach ($id_model as $mod) {
									?>
										<!--di sini kita tambahkan class berisi id provinsi-->
										<option <?php echo $model_selected == $mod->id_model ? 'selected="selected"' : '' ?> class="<?php echo $mod->id_model ?>" value="<?php echo $mod->id_model ?>"><?php echo $mod->nama_model; ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td width='200'>Qty <?php echo form_error('qty') ?></td>
						<td><input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="hidden" name="id_bom" value="<?php echo $id_bom; ?>" />
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
							<a href="<?php echo site_url('bom') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
</div>
</div>