<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
               
                <div class="box box-warning box-solid">

                    <div class="box-body">
        <h2 class="box-title" style="margin-top:0px">Barang Read</h2>
        <table class="table table-bordered">
	    <tr><td>Kd Barang</td><td><?php echo $kd_barang; ?></td></tr>
	    <!-- <tr><td>Id Jenis Barang</td><td><?php echo $id_jenis_brg; ?></td></tr> -->
        <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
        <tr><td>Nama Material</td><td><?php echo $material; ?></td></tr>
	    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
	    <!-- <tr><td>Id Cust</td><td><?php echo $id_cust; ?></td></tr> -->
        <tr><td>Nama Customer</td><td><?php echo $nama_cust; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
    </div>
                </div>
            </div>
    </section>
</div>