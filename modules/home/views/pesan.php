<div class="col-md-12 col-sm-12 col-xs-12 content">
    <p class="title_produk">Detail Pesanan</p>
    <br>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="smartwizard">
			<ul>
				<li><a href="#step-1">Step 1<br />Detail Pesanan</a></li>
				<li><a href="#step-2">Step 2<br /><small>Data Pemesan</small></a></li>
			</ul>
		   
		   <div>
			<div id="step-1" class="" style="display: block;">
				<div class="col-md-3 col-sm-3 col-xs-3">
				    <div class="box_product" style="height: 265px !important">
				        <div class="col-md-12 col-sm-12 col-xs-12 box_product_foto" style="background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.2) 0, rgba(255, 255, 255, 0) 60.86%) !important;">
				            <center>
				                <img src="<?=base_url('uploads/product/paket-advance.png')?>" class="img-responsive">
				            </center>

				            <p class="nama_produk"><?=$detail_produk->nama_product?></p>
				            <p class="harga"><span class="rp">Rp&nbsp;</span><?=rp($detail_produk->harga)?></p>
				        </div>
				    </div>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-9" style="height: 200px;margin-top: 20px;">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" style="background-color: whitesmoke;height: 36px;">
							<a href="<?=site_url($this->cname)?>" class="btn" style="color: #a69f9f;padding-top: 6px;">
								<p class="pull-left"><i class="fa fa-arrow-left">&nbsp;&nbsp;Kembali ke produk</i></p>
								<p class="pull-right" style="margin-left: 460px;"><i class="fa fa-calendar">&nbsp;&nbsp;Tanggal Pesanan : <?=date('d-m-Y')?></i></p>
							</a>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 20px;">
							<div class="form-group">
								<label class="control-label col-md-2">Jumlah :</label>
								<div class="col-md-2">
									<input type="number" id="jml" class="form-control" value="1" style="margin-left: -80px;margin-top: -3px;width: 66px;">
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 20px;">
							<label class="control-label col-md-2">Keterangan</label><br><br>
							<div class="col-md-12">
							<p><?=substr($detail_produk->keterangan, 0, 470)?></p>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="step-2" class="">				
				<div class="col-md-12 col-sm-12 col-xs-12" style="height: 200px;margin-top: 20px;">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" style="background-color: whitesmoke;height: 36px;">
							<a href="<?=site_url($this->cname)?>" class="btn" style="color: #a69f9f;padding-top: 6px;">
								<p class="pull-left"><i class="fa fa-arrow-left">&nbsp;&nbsp;Kembali ke produk</i></p>
							</a>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
							<form action="<?=site_url($this->cname.'/order').'/'.$this->uri->segment(3)  ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-2">Nama Lengkap</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" required/>
											<input class="form-control" id="jml_fix" type="hidden" name="jml"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">Nomor Telepon</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="no_telp" placeholder="Nomor Telepon" required/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">Alamat</label>
										<div class="col-md-8">
											<input class="form-control" type="text" name="alamat" placeholder="Alamat Lengkap, Provinsi, Kota/Kabupaten" required/>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-2 col-md-9">
											<button type="submit" class="btn btn-primary btn-success" style="letter-spacing: 2px">ORDER</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function(){

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               // alert("You are on step "+stepPosition+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
                    $(".sw-btn-next").css('display', 'block');
               }else if(stepPosition === 'final'){
                   // $("#next-btn").addClass('disabled');
                   $(".sw-btn-next").css('display', 'none');
                   var jml = $('#jml').val();
                   $('#jml_fix').val(jml);
               }else{
                   $("#prev-btn").removeClass('disabled');
                   $("#next-btn").removeClass('disabled');
                   $(".sw-btn-next").css('display', 'block');
               }
            });

    		
    		 


            // Smart Wizard
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    transitionEffect:'fade',
                    showStepURLhash: true,
                    toolbarSettings: {toolbarPosition: 'bottom',
                                      toolbarButtonPosition: 'end',
                                    }
            });


            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });

            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });
        });
    </script>