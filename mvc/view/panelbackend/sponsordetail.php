
<?=$this->FlashMsg()?>
<div style="text-align:right">
<?php echo UI::showButtonMode($mode, $row[$pk])?>
</div>
        <br/>
<table class="table table-form">
<tr>
  <td class="td-label">Nama</td>
  <td>
    <?php echo UI::createTextBox('nama',$row['nama'],'','',$edited,$class='form-control')?> 
	</td>
</tr>
<tr>
  <td class="td-label">File</td>
  <td><?php echo UI::createTextBox('file_path',$row['file_path'],'','',$edited,$class='form-control mce-img_file_path')?> 
  <?php if($row['file_path']) {?>
  <img src="<?=URL::Base()?><?=str_replace(Config::FolderProject(),'',str_replace('/files/', '/thumbs/', $row['file_path']))?>" class="mc_preload wp-post-image" alt="<?=$row['link']?>" title="" style="display: block;">
  <?php } if($edited) {?>
  <a data-toggle="modal" class="btn btn-warning" href="javascript:void('')" data-target="#myModal">File Manager</a>
  <?php }?>
  </td>
</tr>
<tr><td class="td-label">Link</td><td><?php echo UI::createTextBox('link',$row['link'],'','',$edited,$class='form-control')?></td></tr>
<tr><td class="td-label">Aktif ?</td><td><?php echo UI::createCheckBox('is_aktif',1,$row['is_aktif'],$edited,$class='')?></td></tr>
<?php if($edited){?>
<tr><td></td><td><?php echo UI::showButtonMode('save', null, $edited)?></td></tr>
<?php }?>
</table>




<div class="modal fade mce-filemanager" id="myModal" data-width="900">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close mce-close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">File Manager</h4>
    </div>
    <div class="modal-body" style="padding:0px; margin:0px width: 900px;">
      <iframe width="100%" height="500" src="<?=URL::Base()?>assets/js/tinymce/plugins/filemanager/dialog.php?type=1&editor=file_path&subfolder=&popup=0&field_id=&lang=undefined" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>