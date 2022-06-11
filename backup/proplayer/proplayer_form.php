<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA PROPLAYER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Player <?php echo form_error('nama_player') ?></td><td><input type="text" class="form-control" name="nama_player" id="nama_player" placeholder="Nama Player" value="<?php echo $nama_player; ?>" /></td></tr>
	    <tr><td width='200'>Telp P <?php echo form_error('telp_p') ?></td><td><input type="text" class="form-control" name="telp_p" id="telp_p" placeholder="Telp P" value="<?php echo $telp_p; ?>" /></td></tr>
	    <tr><td width='200'>Id Tim <?php echo form_error('id_tim') ?></td>
	    	<td>
            <div class="form-group">
                        <label>Nama Tim</label>
                        <select class="form-control" name="id_tim" id="id_tim">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($id_tim as $kat) {
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $tim_selected == $kat->id_tim ? 'selected="selected"' : '' ?>
                                    class="<?php echo $kat->id_tim ?>" value="<?php echo $kat->id_tim ?>"><?php echo $kat->nama_tim;  ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
        </td>
	    </tr>
	    <tr><td width='200'>Id Game <?php echo form_error('id_game') ?></td>
	    	<td>
            <div class="form-group">
                        <label>Nama Game</label>
                        <select class="form-control" name="id_game" id="id_game">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($id_game as $kat) {
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $game_selected == $kat->id_game ? 'selected="selected"' : '' ?>
                                    class="<?php echo $kat->id_game ?>" value="<?php echo $kat->id_game ?>"><?php echo $kat->nama_game;  ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
        </td>
	    </tr>
	    
        <tr><td width='200'>Foto Player <?php echo form_error('images') ?></td><td> <input type="file" name="images"></td></tr>
        <tr><td width='200'>Video <?php echo form_error('video') ?></td><td> <textarea class="form-control" rows="3" name="video" id="video" placeholder="Video"><?php echo $video; ?></textarea></td></tr>
	    
        <tr><td width='200'>Prestasi <?php echo form_error('prestasi') ?></td><td> <textarea class="form-control" rows="3" name="prestasi" id="prestasi" placeholder="Prestasi"><?php echo $prestasi; ?></textarea></td></tr>
	    
        <tr><td width='200'>Lat <?php echo form_error('lat') ?></td><td> <textarea class="form-control" rows="3" name="lat" id="lat" placeholder="Lat"><?php echo $lat; ?></textarea></td></tr>
	    
        <tr><td width='200'>Lng <?php echo form_error('lng') ?></td><td> <textarea class="form-control" rows="3" name="lng" id="lng" placeholder="Lng"><?php echo $lng; ?></textarea></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_proplayer" value="<?php echo $id_proplayer; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('proplayer') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>