<!DOCTYPE html>
<html lang="en" class="">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>SIM Diklat</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="Metronic Launcher"/>
<meta content="" name="KeenThemes"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet' type='text/css'>
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link href="<?=base_url();?>assets/_start/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?=base_url();?>assets/_start/style.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body quick-markup_injected="true">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="margin-top: 0;">
      <div class="container">
        <center>
        	<span class="title-main">SIM</span>
			<span class="title-thin">DIKLAT</span><br>
			<span class="title-small">Aplikasi yang mengelola kegiatan diklat skala pemerintahan.</span><br>
		</center>

		<!--
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" role="button">Learn more »</a></p>
		-->
      </div>
    </div>

    <div class="container pagebody">
      <!-- Example row of columns -->
      <div class="row">
      	<div class="col-md-2">
      	</div>
        <div class="col-md-4">
			<div class="widget-layout">
				<center><h4 class="widget-title">Umum</h2></center>
				<div class="widget-screen"><a href="<?=site_url('start/loadTipe?tipe=umum')?>"><img src="<?=base_url();?>assets/_start/img/screen1.jpg" class="img-responsive"></a></div>
				<center>
					<p class="widget-btn">
						<a class="btn btn-primary btn-default" href="<?=site_url('start/loadTipe?tipe=umum')?>" role="button">Umum</a>&nbsp;
					</p>
				</center>
			</div>
        </div>
        <div class="col-md-4">
			<div class="widget-layout">
				<center><h4 class="widget-title">Diklat</h2></center>
				<div class="widget-screen"><a href="<?=site_url('start/loadTipe?tipe=diklat')?>"><img src="<?=base_url();?>assets/_start/img/screen1.jpg" class="img-responsive"></a></div>
				<center>
					<p class="widget-btn">
						<a class="btn btn-primary btn-default" href="<?=site_url('start/loadTipe?tipe=diklat')?>" role="button">Diklat</a>&nbsp;
					</p>
				</center>
			</div>
        </div>
      </div>


      <hr>

      <footer>
      	<center>
        	<p>&copy; PT. Cendana Teknika Utama, Ruko Griya Shanta NR. 24/25 Jln. Sukarno Hatta, Malang, Jawa Timur</p>
        </center>
      </footer>
    </div> <!-- /container -->

<!-- BEGIN JAVASCRIPTS -->
<!-- BEGIN CORE PLUGINS -->
<script src="plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script>
	jQuery(document).ready(function() {
	});
</script>
<!-- END JAVASCRIPTS -->

<div id="window-resizer-tooltip" style="display: none;"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth">1920</span> x <span class="tooltipHeight" id="winHeight">1080</span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth">1920</span> x <span class="tooltipHeight" id="vpHeight">479</span></div>

</body>
<!-- END BODY -->
</html>
<style>
	body{
		border-radius: none;
	}
</style>
