<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					Form Edit <?=ucwords(@$this->title)?>
				</div>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?=site_url($this->cname.'/do_ubah')  ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'kode'))?></label>
							<div class="col-md-2">
								<input class="form-control" type="text" name="kode" placeholder="<?=ucwords(str_replace('_', ' ', 'kode'))?>" value="<?=@$item->kode?>" required/>
								<input class="form-control" type="hidden" name="id_layanan" placeholder="<?=ucwords(str_replace('_', ' ', 'id_layanan'))?>" value="<?=@$item->id_layanan?>" required/>
								<input class="form-control" type="hidden" name="kode_sekarang" placeholder="<?=ucwords(str_replace('_', ' ', 'kode_sekarang'))?>" value="<?=@$item->kode?>" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'nama_layanan'))?></label>
							<div class="col-md-3">
								<input class="form-control" type="text" name="nama_layanan" placeholder="<?=ucwords(str_replace('_', ' ', 'nama_layanan'))?>" value="<?=@$item->nama_layanan?>" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2"><?=ucwords(str_replace('_', ' ', 'status'))?></label>
							<div class="col-md-2">
								<input type="checkbox" class="make-switch" name="status" <?=$item->status == 'Y' ? 'checked' : ''?> data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak&nbsp;" data-on-color="primary" data-off-color="danger">
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