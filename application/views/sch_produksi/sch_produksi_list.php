<div class="content-wrapper">
    <section class="content">
    <div id="notip"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SCH_PRODUKSI</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('sch_produksi/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php //echo anchor(site_url('sch_produksi/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php //echo anchor(site_url('sch_produksi/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?>
        
        <button href="#my-modal3" role="button" data-toggle="modal" class="btn btn-success btn-sm">
            <a class="fa fa-upload"></a>Import Data
		</button></div>
        
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Kd Produksi</th>
		    <th>Id Model</th>
		    <th>Stok Pemakaian</th>
		    <th>Tgl Produksi</th>
		    <th>Hasil Stok</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
    <div id="my-modal3" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Import Data Schedule Produksi</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" enctype="multipart/form-data" id="formImport">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Import Excel FIle </label>
								<div class="col-sm-6">
									<input type="file" id="file" required name="file" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sample </label>
								<div class="col-sm-9">
									<a href="<?php echo base_url() . 'sch_produksi/excel'; ?>" for="form-field-1"> Sample Download </label></a>
								</div>
							</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_import" class="btn btn-sm btn-success pull-left">
                    <i class="ace-icon fa fa-save"></i>
                    Import
                </button>
                <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Batal
                </button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "sch_produksi/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_produksi",
                            "orderable": false
                        },{"data": "kd_produksi"},{"data": "id_model"},{"data": "stok_pemakaian"},{"data": "tgl_produksi"},{"data": "hasil_stok"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        
    if ($("#formImport").length > 0) {
		$("#formImport").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			rules: {
				kd_produksi: {
					required: true,
					maxlength: 14,
				},
				id_model: {
					required: true,
					digits: true,
				},
                id_bom: {
					required: true,
					digits: true,
				},
				stok_pemakaian: {
					required: true,
                    digits: true,
				},
				tgl_produksi: {
					required: true,
				},
                hasil_stok: {
					required: true,
				},
			},
			messages: {
				kd_produksi: {
					required: "Kode produksi harus diisi!"
				},
				id_model: {
					required: "Id Model harus diisi!"
				},
                id_bom: {
					required: "Id Bom harus diisi!"
				},
				stok_pemakaian: {
					required: "Stok Pakai harus diisi!"
				},
				tgl_produksi: {
					required: "Tanggal Produksi harus diisi!"
				},
                hasil_stok: {
					required: "Hasil Stok harus diisi!"
				},
			},
			submitHandler: function(form) {
				formdata = new FormData(form);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('sch_produksi/import') ?>",
					data: formdata,
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(data) {
                        if ("status" == "success") {
                            document.getElementById("formImport").reset();
                            $( "#notip" ).append( '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>Data berhasil di input/update.</div>' );
                            setTimeout(
                            function() 
                            {
                                location.replace("<?php echo base_url('sch_produksi') ?>");
                            }, 2000);
                        }
                        document.getElementById("formImport").reset();
                            $( "#notip" ).append( '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Gagal!</h4>Data gagal di input/update.</div>' );
                            setTimeout(
                            function() 
                            {
                                location.replace("<?php echo base_url('sch_produksi') ?>");
                            }, 2000);
                        $("#my-modal3").modal('hide');
					}
				});
				return false;
			}
		});
	}
        </script>