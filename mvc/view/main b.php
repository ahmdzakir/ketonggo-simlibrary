<!DOCTYPE html>
<html class="csstransforms no-csstransforms3d csstransitions js_active  vc_desktop  vc_transform " lang="en-US"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

	<title><?=Config::Title($page_title)?></title>
	<!--meta-->
	<meta charset="UTF-8">
	<meta name="generator" content="<?=URL::Base()?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Rumah Sakit Inslam">
	<meta name="format-detection" content="telephone=no">
	<!--style-->
	<link rel='stylesheet' id='rs-plugin-settings-css'  href='<?=URL::Base()?>assets/css/settings.css?ver=4.6.4' type='text/css' media='all' />

	<link rel="shortcut icon" href="<?=URL::Base()?>assets/img/darus_syifa.png">
    <link href="<?=URL::Base()?>assets/css/bootstrap-front.min.css" rel="stylesheet">
	<link rel="stylesheet" id="css3_grid_font_yanone-css" href="<?=URL::Base()?>assets/template/mediacenter/css_003.css" type="text/css" media="all">
	<link rel="stylesheet" id="css3_grid_table1_style-css" href="<?=URL::Base()?>assets/template/mediacenter/css3_grid_style_002.css" type="text/css" media="all">
	<link rel="stylesheet" id="css3_grid_table2_style-css" href="<?=URL::Base()?>assets/template/mediacenter/css3_grid_style.css" type="text/css" media="all">
	<link rel="stylesheet" id="css3_grid_responsive-css" href="<?=URL::Base()?>assets/template/mediacenter/responsive.css" type="text/css" media="all">
	<link rel="stylesheet" id="google-font-droid-sans-css" href="<?=URL::Base()?>assets/template/mediacenter/css_002.css" type="text/css" media="all">
	<link rel="stylesheet" id="google-font-droid-serif-css" href="<?=URL::Base()?>assets/template/mediacenter/css.css" type="text/css" media="all">
	<link rel="stylesheet" id="reset-css" href="<?=URL::Base()?>assets/template/mediacenter/reset.css" type="text/css" media="all">
	<link rel="stylesheet" id="superfish-css" href="<?=URL::Base()?>assets/template/mediacenter/superfish.css" type="text/css" media="all">
	<link rel="stylesheet" id="jquery-fancybox-css" href="<?=URL::Base()?>assets/template/mediacenter/jquery_002.css" type="text/css" media="all">
	<link rel="stylesheet" id="jquery-qtip-css" href="<?=URL::Base()?>assets/template/mediacenter/jquery.css" type="text/css" media="all">
	<link rel="stylesheet" id="jquery-ui-custom-css" href="<?=URL::Base()?>assets/template/mediacenter/jquery-ui-1.css" type="text/css" media="all">
	<link rel="stylesheet" id="animations-css" href="<?=URL::Base()?>assets/template/mediacenter/animations.css" type="text/css" media="all">
	<link rel="stylesheet" id="main-style-css" href="<?=URL::Base()?>assets/template/mediacenter/style.css" type="text/css" media="all">
	<link rel="stylesheet" id="responsive-css" href="<?=URL::Base()?>assets/template/mediacenter/responsive_002.css" type="text/css" media="all">
	<link rel="stylesheet" id="custom-css" href="<?=URL::Base()?>assets/template/mediacenter/custom.css" type="text/css" media="all">
	<link rel="stylesheet" id="js_composer_front-css" href="<?=URL::Base()?>assets/template/mediacenter/js_composer.css" type="text/css" media="all">
	

	<script style="" type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_004.js"></script>
    <script src="<?=URL::Base()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=URL::Base()?>assets/js/jquery.transit.min.js"></script>
	<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery-migrate.js"></script>

</head>
	<body  class="fullwidthlayout home page page-id-5 page-template page-template-template-home page-template-template-home-php wpb-js-composer js-comp-ver-4.4.3 vc_responsive">
<div class="site_container" style="background: url(<?=URL::Base()?>assets/img/symphony1.jpg) top left repeat;">
<!-- Header -->
<div class="header_container fixed">
<div class="header clearfix layout_1">
<div class="header_left">
<a href="<?=URL::Base()?>" title="Rumah Sakit Islam Surabaya">
<img src="<?=URL::Base()?>assets/img/logo-small.png" alt="logo" style="width:205;margin: 0px 25px 0px 13px;">
<!--<span class="logo" style="padding-top: 10px">RSI Surabaya</span>-->
</a>
</div>
<div class="menu-main-menu-container">
<?php $this->front->GetMenu(); ?>
</div>

<div class="mobile_menu">
<select>
<?php $this->front->GetMenuMobile(); ?>
</select>
</div>

</div>
			</div>
			<!-- /Header -->
<div class="content-arp">
<form method="post" class="search" enctype="multipart/form-data" id="main_form">
<input type="hidden" name="act" id="act" />
  <?php $this->FlashMsg(); echo $content;?>
</form>

<div class="theme_page relative" style="border:none">
	<br/>
		<div class="clearfix">
			<div class="header_left">
				<h3 class="box_header animation-slide slide">Sponsor</h3>			
			</div>
			<div class="header_right">
				<a style="display: block;" href="#" id="prev2" class="scrolling_list_control_left icon_small_arrow left_black"></a>
				<a style="display: block;" href="#" id="next2" class="scrolling_list_control_right icon_small_arrow right_black"></a>
			</div>
		</div>
	<br/>
	<div class="list_carousel_arip">
		<ul id="foo2">
			<?php 
		    $base = URL::Base();
		    $folder_project = Config::FolderProject();
			foreach ($list_sponsor as $rp) { ?>
				<li><a href="<?=$rp['link']?>" target="_BLANK"><img src="<?=$base?><?=str_replace($folder_project,'',$rp['file_path'])?>" style="display: block;" height="40px"></a></li>
			<?php }
			?>
		</ul>
	</div>
</div>

</div>
<div class="footer_container">
<br/>
	<div class="footer">

	<div class="footer_box_container clearfix">
<div id="medicenter_contact_details-2" class="widget contact_details_widget footer_box">
  <h3 class="box_header animation-slide">Kontak Layanan Masyarakat </h3>
  <p class="info">Silahkan menghubungi kami apabila Anda tidak puas dengan layanan kami.</p>    
  <ul class="contact_data">
    <li class="clearfix"><span class="social_icon" style="background-image: url('<?=URL::Base("assets/template/mediacenter/images")?>/phone-black.png');"></span><p class="value">telephone: <strong style="color:#D5D5D5">(031) 828 4505, (031) 828 4506</strong></p></li>
    <li class="clearfix"><span class="social_icon" style="background-image: url('<?=URL::Base("assets/template/mediacenter/images")?>/mail-black.png');"></span><p class="value">E-mail: <a href="mailto:info@rsisurabaya.com">info@rsisurabaya.com</a></p></li>
    <li class="clearfix"><span class="social_icon" style="background-image: url('<?=URL::Base("assets/template/mediacenter/images")?>/facebook.png');"></span><p class="value"><a href="http://www.facebook.com/rsisurabaya">facebook.com/rsisurabaya</a></p></li>
    <li class="clearfix"><span class="social_icon" style="background-image: url('<?=URL::Base("assets/template/mediacenter/images")?>/twitter.png');"></span><p class="value"><a href="http://www.twitter.com/rsisurabaya">@rsisurabaya</a></p></li>
    <li class="clearfix"><span class="social_icon" style="background-image: url('<?=URL::Base("assets/template/mediacenter/images")?>/form-black.png');"></span><p class="value">atau <a title="Contact form" href="<?=URL::Base("pagedetail/index/hubungikami/HUBUNGI-KAMI.html")?>">lebih lengkap</a> di halaman hubungi kami.</p></li>
  </ul>
</div>
<div id="medicenter_scrolling_recent_posts-2" class="widget scrolling_recent_posts_widget footer_box">		
	<div class="clearfix">
		<div class="header_left">
			<h3 class="box_header animation-slide slide">Tanggapan Masyarakat</h3>			
		</div>
		<div class="header_right">
			<a style="display: block;" href="#" id="testimonials_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
			<a style="display: block;" href="#" id="testimonials_next" class="scrolling_list_control_right icon_small_arrow right_white"></a>
		</div>
	</div>
	<div class="scrolling_list_wrapper">
		<div style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: 310px; height: 358px; margin: 0px; overflow: hidden;" class="caroufredsel_wrapper">
			<ul style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; height: 833px; width: 310px;" class="scrolling_list footer_recent_posts">
				<?php foreach ($list_testimoni as $row) { ?>
				<li>
				<h4 class="sentence" style="margin-top:5px; margin-buttom:5px;"><?=$row['isi']?></h4>
				<span class="sentence_author">- <?=$row['nama']?> -</span>
				<div style="clear:both;padding:3px;"></div>
				</li>
				<?php }?>
				
			</ul>
		</div>
	</div>
</div>
<!--end testimonial-->
<!--add testimonial-->

<div id="medicenter_scrolling_recent_posts-2" class="widget scrolling_recent_posts_widget footer_box">		
	<div class="clearfix">
		<div class="header_left">
			<h3 class="box_header animation-slide slide">Berkontribusi Memberi Tanggapan</h3>			
		</div>
	</div>
	<div class="scrolling_list_wrapper">
		<form class="testimoni_form" id="testimoni_form" method="post" action="">
			<fieldset style="clear:both;">
			<label>Nama</label>
				<div class="block">
					<input class="text_input" name="nama" type="text" value="<?=$row_testimoni['nama']?>" />
					<input name="act" type="hidden" value="" id="act" />
				</div>
				<label>Nomor HP</label>
				<div class="block">
					<input class="text_input" name="no_telepon" type="text" value="<?=$row_testimoni['no_telepon']?>" />
				</div>
				<label>E-mail</label>
				<div class="block">
					<input class="text_input" type="text" name="email" value="<?=$row_testimoni['email']?>" />
				</div>
				<label>Tanggapan</label>
				<div class="block">
					<textarea name="isi"><?=$row_testimoni['isi']?></textarea>
				</div>
				<input type="submit" onclick="goTestimoni()" name="submit" value="Send" class="more mc_button" />
			</fieldset>
		</form>
	</div>
</div>
<!--end add testimonial-->
</div>

	<div class="copyright_area clearfix">
		<div class="copyright_left">
		© Copyright - <a href="<?=URL::Base()?>" target="_blank">RSI Surabaya</a> by <a href="http://jasamultimedia.com/" title="Jasa Multimedia" target="_blank">jasamultimedia.com</a>						
		</div>
		<div class="copyright_right">
		<a class="scroll_top icon_small_arrow top_white" href="#top" title="Scroll to top">Top</a>						
		</div>
	</div>
</div>
</div>
</div>
<link rel="stylesheet" id="css3_grid_font_yanone-css" href="<?=URL::Base()?>assets/template/mediacenter/stylemain.css" type="text/css" media="all">
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/core.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/widget.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/accordion.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/tabs.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/datepicker.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_008.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_009.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_003.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_013.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_011.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_010.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_007.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_002.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_005.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_006.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/jquery_012.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
var config = [];
/* ]]> */
</script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/main_002.js"></script>
<script type="text/javascript" src="<?=URL::Base()?>assets/template/mediacenter/js_composer_front.js"></script>
<script>
	function goTestimoni(){
		//http://localhost/ketonggo_project/cms/#medicenter_scrolling_recent_posts-2
		jQuery("#testimoni_form").attr("action","<?=URL::FullUri()?>#medicenter_scrolling_recent_posts-2");
		jQuery("#testimoni_form #act").val("save_testimoni");
		jQuery("#testimoni_form").submit();
	}



	var target = jQuery('.header_container');
	var header = jQuery('.header');
	var img = jQuery('.header_left img');
	var header_logo = jQuery('.header_left .logo');
	var sf_menu = jQuery('.sf-menu');
	var div_position = target.offset().top;

	jQuery(function(){
		jQuery('#foo2').carouFredSel({
			auto: {
				pauseOnHover: 'resume',
			},
			prev: '#prev2',
			next: '#next2',
			mousewheel: true,
			swipe: {
				onMouse: true,
				onTouch: true
			}
		});

		setHeader();
	});
	jQuery(window).scroll(function() { 
		setHeader();
	});

	function setHeader(){

	    var y_position = jQuery(window).scrollTop();
	    if(y_position>318){
	    	y_position = 318;
	    }


	   	if(y_position>=0 && y_position<=318){
	   		target.height(86-(y_position/10));
	    	opacity = 1-(y_position/1000000);
	    	padding = 21-(y_position/20);
	    	sf1 = 10-(y_position/36);
	    	sf2 = 9-(y_position/36);
	    	header.css('padding',""+padding+"px 0");
	    	width = 205-(y_position/7);
	    	img.css("width",width+"px");
	    	margin = 0+(y_position/64);
	    	img.css("margin",margin+"px 13px");
	    	sf_menu.css('padding',sf1+"px 14px "+sf2+"px 14px")
	    	/*
padding: 1px 14px 0px 14px;

width: 30px;
margin: 5px;
margin-right: 13px;
	    	*/
	    }
	}
</script>
<style type="text/css">
	.fixed{
		position:fixed;
		z-index: 10000;
		width: 100%;
		box-shadow: 0 0px 10px rgba(0, 0, 0,0.2);
		background: -webkit-linear-gradient(bottom, rgb(2, 90, 60) , rgb(22, 128, 93)); /* For Safari 5.1 to 6.0 */
  		background: -o-linear-gradient(bottom, rgb(2, 90, 60) , rgb(22, 128, 93)); /* For Opera 11.1 to 12.0 */
  		background: -moz-linear-gradient(bottom, rgb(2, 90, 60) , rgb(22, 128, 93)); /* For Firefox 3.6 to 15 */
  		background: linear-gradient(bottom, rgb(2, 90, 60) , rgb(22, 128, 93)); /* Standard syntax */
	}
	.content-arp{
		padding-top:86px;
	}
	.header{
		padding: 21px 0;
	}
	.header .sf-menu li{
		background-color: rgba(255, 255, 255,0);
		/*border-right: 1px solid #D8FFDB;*/
		margin: 0px;
	}
	.header_left {
float: left;
width: 295px;
margin-top: -6px;
margin-left: -12px;
}
.header_left a img {
	float: left;
	background: #fff;
	padding: 1px 2px;
	border-radius: 8px;
}
	.header .sf-menu li a{
		border: 1px solid rgba(255, 255, 255,0);
	}
	.header .sf-menu li a:visited{
		/*border:none;*/
		border: 1px solid rgba(255, 255, 255,1);
	}

	.header .sf-menu li.submenu:hover > a
	{
		color: #000;
		background: #FFF;
		border-color: #D8FFDB;
		border-bottom-color: #FFF;
	}
	.contact_data li:first-child {
		border:none;
	}
	.contact_data li {
		padding: 10px 0;
		color: #666;
		border-top: 1px solid #2a2a2a;
		border-bottom: none;
	}


	.list_carousel_arip {
		margin: 0px;
		width: 100%;
	}
	.list_carousel_arip ul {
		margin: 0;
		padding: 0;
		list-style: none;
		display: block;
	}
.list_carousel_arip li {
font-size: 40px;
text-align: center;
border: none;
height: auto;
padding: 0;
margin: 5px 20px;
display: block;
float: left;
}
	.list_carousel_arip.responsive {
		width: auto;
		margin-left: 0;
	}
			.clearfix {
				float: none;
				clear: both;
			}
			.prev {
				float: left;
				margin-left: 10px;
			}
			.next {
				float: right;
				margin-right: 10px;
			}
			.pager {
				float: left;
				width: 300px;
				text-align: center;
			}
			.pager a {
				margin: 0 5px;
				text-decoration: none;
			}
			.pager a.selected {
				text-decoration: underline;
			}
			.timer {
				background-color: #999;
				height: 6px;
				width: 0px;
			}
.sf-menu {padding: 10px 14px 9px 14px;
margin: 0;
margin-top: -2.5px;
border: 20px solid rgb(0, 130, 56);
border-top: 3px solid rgb(0, 130, 56);
border-bottom: 0px;
border-radius: 100px 100px 0px 0px;
background: #F8FFF9;
-moz-box-shadow: inset 0px 3px 3px rgba(0, 0, 0, 0.3);
-webkit-box-shadow: inset 0px 3px 3px rgba(0, 0, 0, 0.3);
box-shadow: inset 0px 3px 3px rgba(0, 0, 0, 0.3);
}
.sf-menu li:last-child a:hover{
border-radius: 0px 30px 0px 0px;
}
.sf-menu li:first-child a:hover{
border-radius: 30px 0px 0px 0px;
}
</style>
</body></html>