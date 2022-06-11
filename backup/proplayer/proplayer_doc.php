<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Proplayer List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Player</th>
		<th>Telp P</th>
		<th>Id Tim</th>
		<th>Id Game</th>
		<th>Foto</th>
		<th>Video</th>
		<th>Prestasi</th>
		<th>Lat</th>
		<th>Lng</th>
		
            </tr><?php
            foreach ($proplayer_data as $proplayer)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $proplayer->nama_player ?></td>
		      <td><?php echo $proplayer->telp_p ?></td>
		      <td><?php echo $proplayer->nama_tim ?></td>
		      <td><?php echo $proplayer->nama_game ?></td>
		      <td><?php echo $proplayer->images ?></td>
		      <td><?php echo $proplayer->video ?></td>
		      <td><?php echo $proplayer->prestasi ?></td>
		      <td><?php echo $proplayer->lat ?></td>
		      <td><?php echo $proplayer->lng ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>