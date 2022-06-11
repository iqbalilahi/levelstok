<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
               
                <div class="box box-warning box-solid">

                    <div class="box-body">
        <h2 class="box-title" style="margin-top:0px">Jadwal Produksi</h2>
        <table class="table">
	    <tr><td>Kd Produksi</td><td><?php echo $kd_produksi; ?></td></tr>
	    <tr><td>Id Model</td><td><?php echo $id_model; ?></td></tr>
	    <tr><td>Stok Pemakaian</td><td><?php echo $stok_pemakaian; ?></td></tr>
	    <tr><td>Tgl Produksi</td><td><?php echo $tgl_produksi; ?></td></tr>
	    <tr><td>Hasil Stok</td><td><?php echo $hasil_stok; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sch_produksi') ?>" class="btn btn-default">Cancel</a></td></tr>
        </table>
    </div>
                </div>
            </div>
    </section>
</div>