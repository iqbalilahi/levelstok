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
        <h2>Tbl_model List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kd Model</th>
		<th>Nama Model</th>
		<th>Keterangan</th>
		
            </tr><?php
            foreach ($model_data as $model)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $model->kd_model ?></td>
		      <td><?php echo $model->nama_model ?></td>
		      <td><?php echo $model->keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>