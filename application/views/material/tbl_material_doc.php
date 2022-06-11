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
        <h2>Tbl_material List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Supplier</th>
		<th>Id Model</th>
		<th>Id Kat Material</th>
		<th>Nomor Material</th>
		<th>Nama Material</th>
		<th>Qty</th>
		<th>Satuan</th>
		<th>Spek Material</th>
		
            </tr><?php
            foreach ($material_data as $material)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $material->id_supplier ?></td>
		      <td><?php echo $material->id_model ?></td>
		      <td><?php echo $material->id_kat_material ?></td>
		      <td><?php echo $material->nomor_material ?></td>
		      <td><?php echo $material->nama_material ?></td>
		      <td><?php echo $material->qty ?></td>
		      <td><?php echo $material->satuan ?></td>
		      <td><?php echo $material->spek_material ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>