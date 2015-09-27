
<?=$this->FlashMsg()?>
<div style="text-align:right">
<?php echo UI::showButtonMode($mode, $row[$pk])?>
</div>
        <br/>
<table class="table table-form">
<tr><td class="td-label">Nama Dokter</td><td><?php echo UI::createTextBox('nama',$row['nama'],'','',$edited,'form-control')?></td></tr>
<tr><td class="td-label">Isi</td><td><?php echo UI::createTextArea('isi',$row['isi'],50,'',$edited,'form-control contents')?></td></tr>
<?php if($edited){?>
<tr><td></td><td><?php echo UI::showButtonMode('save', null, $edited)?></td></tr>
<?php }?>
</table>