
<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1 class="page_title"><?=$row['nama']?></h1>
				<div style="clear:both"></div>
				<ul class="bread_crumb">
					<li>
						<a href="<?=URL::Base()?>" title="Home">
						Home
						</a>
					</li>
					<li class="separator icon_small_arrow right_gray">
						&nbsp;
					</li>
					<li>
						<?=$row['nama']?>
					</li>
				</ul>
			</div>
		</div>
		<div class="clearfix">
			<div class="vc_row wpb_row vc_row-fluid"> 
				<div class="wpb_column vc_column_container ">
					<div class="wpb_wrapper">
						<div class="text">
							<p>
							<?=$row['isi'],$url?>
							</p>
						</div>
						<div class="post_footer clearfix">
							<ul class="post_footer_details">
								<li>Posted by <?=$row['created_name']?></li>
								<li>on <?=Eng2Ind($row['created_date'])?></li>
							</ul>
						</div>
					</div> 
				</div> 
			</div>
		</div>		
	</div>
</div>

<style>
	#map{
		width: 100%; height: 300px;
	}
</style>

<?php if($add_param=='hubungikami'){ ?>
<script type='text/javascript' src='//maps.google.com/maps/api/js?sensor=false&#038;ver=4.1.4'></script>
<script type='text/javascript'>
if(typeof(theme_google_maps)=='undefined') 
{
	var theme_google_maps=[];
}
var map_map = null;
var coordinate_map;
try
{
    coordinate_map=new google.maps.LatLng(-7.30632,112.73475);
    var mapOptions= 
    {
        zoom:15,
		scrollwheel: true,
        center:coordinate_map,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
		streetViewControl:false,
		mapTypeControl:false
    };
    var map_map = new google.maps.Map(document.getElementById('map'),mapOptions);
	theme_google_maps.push({map: map_map, coordinate: coordinate_map});
	
	var marker_map = new google.maps.Marker({
		position: new google.maps.LatLng(-7.30632,112.73475),
		map: map_map, icon: new google.maps.MarkerImage('<?=URL::Base('assets/template')?>/mediacenter/images/map_pointer.png', new google.maps.Size(38, 45), null, new google.maps.Point(18, 44))
	});
}
catch(e) {};
jQuery(document).ready(function($){
	$(window).resize(function(){
		if(map_map!=null)
			map_map.setCenter(coordinate_map);
	});
});
</script>
<?php }?>