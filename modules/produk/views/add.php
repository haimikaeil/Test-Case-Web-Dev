<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Form Tambah <?=ucwords(@$this->title)?>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?=site_url($this->cname.'/do_tambah')  ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group">
	                        <label class="col-md-2 control-label">Gambar</label>
	                        <div class="col-md-8">
	                            <div class="fileinput fileinput-new" data-provides="fileinput">
	                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
	                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
	                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
	                                <div>
	                                    <span class="btn btn-default btn-file">
	                                        <span class="fileinput-new"> Pilih Gambar </span>
	                                        <span class="fileinput-exists"> Ubah </span>
	                                        <input type="file" value="" name="foto"></span>
	                                    <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Hapus </a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'nama_product'))?></label>
							<div class="col-md-3">
								<input class="form-control" type="text" name="nama_product" placeholder="<?=ucwords(str_replace('_', ' ', 'nama_product'))?>" value="<?=@$this->session->flashdata('postdata')->nama_product?>" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'harga'))?></label>
							<div class="col-md-3">
								<input class="form-control harga" type="number" name="harga" placeholder="<?=ucwords(str_replace('_', ' ', 'harga'))?>" value="<?=@$this->session->flashdata('postdata')->harga?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'deskripsi'))?></label>
							<div class="col-md-4">
								<textarea class="form-control"  name="keterangan" placeholder="<?=ucwords(str_replace('_', ' ', 'deskripsi'))?>" required><?=@$this->session->flashdata('postdata')->deskripsi?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'status'))?></label>
							<div class="col-md-2">
								<input type="checkbox" class="make-switch" name="status" checked="" data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak&nbsp;" data-on-color="primary" data-off-color="danger">
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-9">
								<button type="submit" class="btn green">Simpan</button>
								<a href="<?=site_url($this->cname)?>" class="btn default">Kembali</a>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
		</div>
	</div>
</div>