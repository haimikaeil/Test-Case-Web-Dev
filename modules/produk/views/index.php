<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="col-md-12"></div>
            <div class="portlet-title">
                <div class="caption font-dark font-green-sharp">
                    <i class="<?=$this->icon?> font-green-sharp font-dark"></i>
                    <span class="caption-subject bold uppercase"> Data <?=$this->title?></span>
                    <br/>
                    <span style="font-size: 12px;margin-top : 4px;">Last update : <?= $last_update?></span>
                </div>
                <div class="actions">
                    <a class="btn sbold btn-default" href="<?=site_url($this->cname.'/tambah')?>"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
<script type="text/javascript">

    function formatMoney(n, c, d, t) {
        var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "," : d,
            t = t == undefined ? "." : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    $(document).ready(function(){
        var oTable = $('#tabel').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo site_url($this->cname . "/get_data");?>', //mengambil data ke controller datatable fungsi getdata
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[15, 30, 75, -1], [15, 30, 75, "All"]],
            "iDisplayStart ":15,
            "columns": [
                { "data": "foto", 
                    "render" : function(data, type, row) {
                        return '<img src="<?=base_url('uploads/product').'/'?>'+data+'" width=" 110px" onerror="imgError(this)" />';
                    }
                },
                { "data": "nama_product"},
                { "data": "harga", 
                    "render": function(data, type, row) {
                        return formatMoney(data);      
                    }
                },
                { "data": "keterangan"},
                { "data": "status",
                    "render": function(data, type, row) {
                        if(data == 'Y'){
                            return '<input type="checkbox" class="make-switch" name="status" checked="" data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak&nbsp;" data-on-color="primary" data-off-color="danger" onchange="ubah_status('+row.id_product+')">';
                        }
                        else{
                            return '<input type="checkbox" class="make-switch" name="status" data-on-text="&nbsp;Aktif&nbsp;" data-off-text="&nbsp;Tidak&nbsp;" data-on-color="primary" data-off-color="danger" onchange="ubah_status('+row.id_product+')">';
                        }
                                
                    }
                },
                { "data": "action"},
            ],
             "oLanguage": {
                "sProcessing": '<img src="<?php echo base_url("assets/loading2.gif");?>"><br><p style="margin-top:-5px;">Loading</p>'
            },
            "fnInitComplete": function() {
                     //oTable.fnAdjustColumnSizing();
            },
            'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            }

        });
        $('#tabel').on('draw.dt',function(){
            reloadbutton();
            $('.make-switch').bootstrapSwitch();
        });

    });

    function ubah_status(id) {
        $.ajax({
            url:"<?= site_url($this->cname.'/ubah_status')  ?>",
            type:"POST",
            data: {id_product: id},
            dataType: "json",
            cache:false,
            success:function(hasil){
                
            }
        });
    }

</script>