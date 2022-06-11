<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_MATERIAL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered>' <tr>
                    <td>Nama Supplier <?php echo form_error('id_supplier') ?></td>
                    <td>
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <select class="form-control" name="id_supplier" id="id_supplier">
                                <option value="">Please Select</option>
                                <?php
                                foreach ($id_supplier as $sup) {
                                ?>
                                    <!--di sini kita tambahkan class berisi id provinsi-->
                                    <option <?php echo $supplier_selected == $sup->id_supplier ? 'selected="selected"' : '' ?> class="<?php echo $sup->id_supplier ?>" value="<?php echo $sup->id_supplier ?>"><?php echo $sup->nama_supplier; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    </tr>
                   
                    <tr>
                        <td>Kategori Material <?php echo form_error('id_kat_material') ?></td>
                        <td>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="id_kat_material" id="id_kat_material">
                                    <option value="">Please Select</option>
                                    <?php
                                    foreach ($id_kat_material as $kat) {
                                    ?>
                                        <!--di sini kita tambahkan class berisi id provinsi-->
                                        <option <?php echo $kat_material_selected == $kat->id_kat_material ? 'selected="selected"' : '' ?> class="<?php echo $kat->id_kat_material ?>" value="<?php echo $kat->id_kat_material ?>"><?php echo $kat->nama_kat_material; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Nomor Material <?php echo form_error('nomor_material') ?></td>
                        <td><input type="text" class="form-control" name="nomor_material" id="nomor_material" placeholder="Nomor Material" value="<?php echo $nomor_material; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Nama Material <?php echo form_error('nama_material') ?></td>
                        <td><input type="text" class="form-control" name="nama_material" id="nama_material" placeholder="Nama Material" value="<?php echo $nama_material; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Qty <?php echo form_error('qty') ?></td>
                        <td><input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Satuan <?php echo form_error('satuan') ?></td>
                        <td><input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Spek Material <?php echo form_error('spek_material') ?></td>
                        <td><input type="text" class="form-control" name="spek_material" id="spek_material" placeholder="Spek Material" value="<?php echo $spek_material; ?>" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="hidden" name="id_material" value="<?php echo $id_material; ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                            <a href="<?php echo site_url('material') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>
</div>