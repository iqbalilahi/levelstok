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
        <h2>Sch_produksi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kd Produksi</th>
		<th>Id Model</th>
		<th>Stok Pemakaian</th>
		<th>Tgl Produksi</th>
		<th>Hasil Stok</th>
		
            </tr><?php
            foreach ($sch_produksi_data as $sch_produksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sch_produksi->kd_produksi ?></td>
		      <td><?php echo $sch_produksi->id_model ?></td>
		      <td><?php echo $sch_produksi->stok_pemakaian ?></td>
		      <td><?php echo $sch_produksi->tgl_produksi ?></td>
		      <td><?php echo $sch_produksi->hasil_stok ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>