<div class="theme_page relative">
	<div class="page_layout page_margin_top clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1 class="page_title"><?=$page_title?></h1>
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
						<?=$page_title?>
					</li>
				</ul>
			</div>
			<div class="page_header_right">
				<input name="keyword" class="search_input hint" value="<?=$keyword?>" placeholder="To search type and hit enter..." type="text">		
			</div>
		</div>
		<div class="clearfix">
			<div class="vc_row wpb_row vc_row-fluid"> 
				<div class="wpb_column vc_column_container ">
					<div class="wpb_wrapper">
						<ul class="blog simple clearfix page_margin_top">
							<?php
    						foreach($list['rows'] as $rows){
    							$title = str_replace(" ", "-", $rows['nama']).'.html';
    						?>
							<li class="item_content post-489 post type-post status-publish format-standard hentry category-general">
							<div class="text">
								<h3> 
									<a href="<?=($url=URL::Base("page/detail/{$add_param}/$rows[$pk]/$title"))?>" title="<?=$rows['nama']?>">
										<?=$rows['nama']?>
									</a>
								</h3> 
								<p>
								<?=ReadMore($rows['isi'],$url)?>
								</p>
							</div>
							<div class="post_footer clearfix">
								<ul class="post_footer_details">
									<li>Posted by <?=$rows['created_name']?></li>
									<li>on <?=Eng2Ind($rows['created_date'])?></li>
								</ul>
							</div>
							</li>
							<?php }?>
						</ul>
  <?=UI::showPagingCms($paging,$page, $limit_arr,$limit,$list)?>
					</div> 
				</div> 
			</div>
		</div>		
	</div>
</div>
<script type="text/javascript">
	jQuery(function(){
		jQuery("#main_form").submit(function(){
			if(jQuery("#act").val()==''){
				jQuery("#act").val('search');
			}
		});
	})
</script>

<style>
	.text img{
		max-width: 100px;
		height: auto;
		float: left;
		padding: 10px;
		margin: 10px;
	}
</style>