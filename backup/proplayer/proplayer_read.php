<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Proplayer Read</h2>
        <table class="table">
	    <tr><td>Nama Player</td><td><?php echo $nama_player; ?></td></tr>
	    <tr><td>Telp P</td><td><?php echo $telp_p; ?></td></tr>
	    <tr><td>Id Tim</td><td><?php echo $id_tim; ?></td></tr>
	    <tr><td>Id Game</td><td><?php echo $id_game; ?></td></tr>
	    <tr><td>Foto</td><td><?php echo "<td><img src='".base_url('assets/foto_proplayer/'.$images)."' width='100px' height='100px'></td>"?></td></tr>
	    <tr><td>Video</td><td><?php echo $video; ?></td></tr>
	    <tr><td>Prestasi</td><td><?php echo $prestasi; ?></td></tr>
	    <tr><td>Lat</td><td><?php echo $lat; ?></td></tr>
	    <tr><td>Lng</td><td><?php echo $lng; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('proplayer') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>