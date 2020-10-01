<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <meta name="mobile-web-app-capable" content="yes">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>Tes Web Developer - Mikaeilar</title>

  <link rel="shortcut icon" href="<?=base_url('assets/antum/antam.png')?>">

  <?=@$_header?>

  <script src="<?=base_url()?>assets/jquery.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>assets/frontend/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>assets/step/js/jquery.smartWizard.min.js"></script>
</head>
  <body>
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 header">
      <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <p class="title_header">Majoo Teknologi Indonesia</p>
      </div>
    </div>

    <div class="col-md-12">
      <?php echo @$this->session->flashdata('msg');?>
    </div>

    <?=@$_content?>

    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 footer">
      <p class="title_footer"><?=date('Y')?> &copy; PT Majoo Teknologi Indonesia</p>      
    </div>
    <?=@$_footer?>
  </body>
</html>
