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
        <h2>Bom List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Material</th>
		<th>Id Model</th>
		<th>Qty</th>
		
            </tr><?php
            foreach ($bom_data as $bom)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bom->id_material ?></td>
		      <td><?php echo $bom->id_model ?></td>
		      <td><?php echo $bom->qty ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>