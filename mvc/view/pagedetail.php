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
						<a href="<?=URL::Base('page/index/'.$add_param)?>" title="<?=$page_title?>">
						<?=$page_title?>
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