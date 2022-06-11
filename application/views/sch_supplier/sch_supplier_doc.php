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
        <h2>Sch_supplier List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Supplier</th>
		<th>Id Material</th>
		<th>Nama Supplier</th>
		<th>Nomor Material</th>
		<th>Satuan</th>
		<th>Stok</th>
		<th>Tgl Datang</th>
		
            </tr><?php
            foreach ($sch_supplier_data as $sch_supplier)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sch_supplier->id_supplier ?></td>
		      <td><?php echo $sch_supplier->id_material ?></td>
		      <td><?php echo $sch_supplier->nama_supplier ?></td>
		      <td><?php echo $sch_supplier->nomor_material ?></td>
		      <td><?php echo $sch_supplier->satuan ?></td>
		      <td><?php echo $sch_supplier->stok ?></td>
		      <td><?php echo $sch_supplier->tgl_datang ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>