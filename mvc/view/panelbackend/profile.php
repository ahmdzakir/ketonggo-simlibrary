
<?=$this->FlashMsg()?>
        <br/>
<table class="table table-form">
<tr><td class="td-label">Nama</td><td><?php echo UI::createTextBox('name',$row['name'],'','',$edited,$class='form-control')?></td></tr>
<tr><td class="td-label">Username</td><td><?php echo UI::createTextBox('username',$row['username'],'','',$edited,$class='form-control')?></td></tr>
<?php if($edited){ ?>
<tr><td></td><td>Kosongkan password apabila Anda tidak ingin merubahnya</td></tr>
<tr><td class="td-label">Password</td><td><?php echo UI::createTextPassword('password','','','',$edited,$class='form-control')?></td></tr>
<tr><td class="td-label">Confirm Password</td><td><?php echo UI::createTextPassword('confirmpassword','','','',$edited,$class='form-control')?></td></tr>
<?php }else{?>
<tr><td class="td-label">Last IP</td><td><?=$row['last_ip']?></td></tr>
<tr><td class="td-label">Last Login</td><td><?=$row['last_login']?></td></tr>
<?php }?>
<?php if($edited){?>
<tr><td></td><td><?php echo UI::showButtonMode('save', null, $edited)?></td></tr>
<?php }?>
</table>