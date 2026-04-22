<?php /* Smarty version 2.6.9, created on 2020-11-23 11:25:02
         compiled from useredit.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>	
				<?php $this->assign('_title', 'ВЪВЕДИ'); ?>
			<?php else: ?>
				<?php $this->assign('_title', 'КОРЕГИРАЙ'); ?>
			<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

име
<br>
<input type="text" name="name" id="name" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'name','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
входно име
<br>
<input type="text" name="username" id="username" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'username','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
входна парола
<br>
<input type="password" name="password" id="password" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'password','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_passinstruc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
права
<br>
<div 
		<?php if (isset ( $this->_tpl_vars['LISTER']['listde'] )): ?>
class="inputer" onmouseover="viewer('listde');" onmouseout="viewer('');"
		<?php else: ?>
class="input"
		<?php endif; ?>
>
		<?php $_from = $this->_tpl_vars['ARPERM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['deid'] => $this->_tpl_vars['dename']):
?>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" class="input" name="listde[]" value="<?php echo $this->_tpl_vars['deid']; ?>
" label="<?php echo $this->_tpl_vars['dename']; ?>
"
				<?php if ($this->_tpl_vars['deid'] == 2): ?>
id="co<?php echo $this->_tpl_vars['deid']; ?>
" onclick="fuprin();">
<span id="coprin">
<br>
принтер
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARUSERPRINNAME'],'ID' => 'codeprin','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</span>
				<?php else: ?>
>
				<?php endif; ?>
<br/>
		<?php endforeach; endif; unset($_from); ?>
</div>

<div id="pas2div" style="display:none"> 
<br>
<input type="password" name="pas2" id="pas2" size=30 class="input"> 
</div> 
<script>
document.ondblclick= function(){document.getElementById("pas2div").style.display="block";}
</script>

<br>
email
<br>
<input type="text" name="email" id="email" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'email','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
телефон
<br>
<input type="text" name="phone" id="phone" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'phone','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<script>
fuprin();
function fuprin(){
	var obje= $("#co2");
	var obcont= $("#coprin");
	if ($(obje).attr("checked")){
		$(obcont).show();
	}else{
		$(obcont).hide();
	}
}
</script>

<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>