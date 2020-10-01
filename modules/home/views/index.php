<div class="col-md-12 col-sm-12 col-xs-12 content">
    <p class="title_produk">Produk</p>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php foreach ($produk as $key => $v) { ?>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="box_product">
                        <div class="col-md-12 col-sm-12 col-xs-12 box_product_foto">
                            <center>
                                <img src="<?=base_url('uploads/product').'/'.$v->foto?>" class="img-responsive" style="margin-top: 16px;">
                            </center>

                            <p class="nama_produk"><?=$v->nama_product?></p>
                            <p class="harga"><span class="rp">Rp&nbsp;</span><?=rp($v->harga)?></p>
                        </div>  
                        <div class="col-md-12 col-sm-12 col-xs-12 plr0">
                            <p class="keterangan"><?=substr($v->keterangan, 0, 167)?></p>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <center><a href="<?=site_url($this->cname.'/pesan').'/'.encode($v->id_product).'/'?>" class="btn btn-md btn-success">Pesan</a></center>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>