
<?=$this->FlashMsg()?>
<div style="text-align:right">
<?php echo UI::showButtonMode($mode)?>
</div>
  <table class="table table-striped">
    <thead>
    <?=UI::showHeader($header, $filter_arr, $list_sort, $list_order)?>
    </thead>
    <tbody>
    <?php
    $i = (($page-1)*$limit);
    foreach($list['rows'] as $rows){
    	$i++;
    	echo "<tr>";
    	echo "<td>$i</td>";
    	foreach($header as $rows1){
    		$val = $rows[$rows1['name']];
            if($rows1['name']=='nama'){
                echo "<td><a href='".($url=URL::Base($page_ctrl."/detail/$rows[$pk]"))."'>$val</a></td>";   
            }elseif($rows1['name']=='isi'){
                echo "<td>".ReadMore($val,$url)."</td>";
            }else{
                switch ($rows1['type']) {
                    case 'list':
                        echo "<td>".$rows1["value"][$val]."</td>";
                        break;
                    default :
                        echo "<td>$val</td>";
                        break;
                }
            }
    	}
    	echo "<td style='text-align:right'>
    	".UI::getButton('edit', $rows[$pk], 'class="btn btn-xs btn-warning"')."
		".UI::getButton('delete', $rows[$pk], 'class="btn btn-xs btn-danger"')."
    	</td>";
    	echo "</tr>";
    }
    if(!count($list['rows'])){
        echo "<tr><td colspan='".(count($header)+2)."'>Data kosong</td></tr>";
    }
    ?>
    </tbody>
  </table>
  <?=UI::showPaging($paging,$page, $limit_arr,$limit,$list)?>