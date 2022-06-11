<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
               
                <div class="box box-warning box-solid">

                    <div class="box-body">
        <h2 class="box-title" style="margin-top:0px">Jadwal Kedatangan Supplier</h2>
        <table class="table">
	    <tr><td>Id Supplier</td><td><?php echo $id_supplier; ?></td></tr>
	    <tr><td>Id Material</td><td><?php echo $id_material; ?></td></tr>
	    <tr><td>Nama Supplier</td><td><?php echo $nama_supplier; ?></td></tr>
	    <tr><td>Nomor Material</td><td><?php echo $nomor_material; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
	    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
	    <tr><td>Tgl Datang</td><td><?php echo $tgl_datang; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sch_supplier') ?>" class="btn btn-default">Cancel</a></td></tr>
        </table>
    </div>
                </div>
            </div>
    </section>
</div>