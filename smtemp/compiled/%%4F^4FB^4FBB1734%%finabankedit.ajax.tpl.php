<?php /* Smarty version 2.6.9, created on 2020-02-28 11:28:45
         compiled from finabankedit.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => "извлечение")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<?php if ($this->_tpl_vars['VARI'] == 'INIT' || $this->_tpl_vars['VARI'] === NULL): ?>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<span><font color=red> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </font></span>
<br>
<br>
		<?php endif; ?>
<br>
от коя банка е файла с извлечението
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARXMLNAME'],'ID' => 'xmlsuffix','C1' => 'input','C2' => 'inputer','ONCH' => "tosuff();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<br>
избери <font color=red><b><span id="banksuff"></span></b></font> файл с извлечението
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
<input type="file" name="file" id="file" size=50 class="input">
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'приеми файла','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
					<?php endif; ?>

					<?php if ($this->_tpl_vars['VARI'] == 'submit'): ?>
<input type="hidden" name="xmlsuffix">
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<span><font color=red> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </font></span>
<br>
		<?php endif; ?>
	<table class="base" align=center>
	<tr>
<td class="t8" colspan=4> 
<br>
<center class="n10">
основни параметри на извлечението
</center>
<br>
	<tr>
<td class="t8"> сметка
<td class="filtvisu" colspan=3> <b><?php echo $this->_tpl_vars['DATA']['iban']; ?>
</b>
	<tr>
<td class="t8"> от дата
<td class="filtvisu" colspan=3> <b><?php echo $this->_tpl_vars['DATA']['date1']; ?>
</b>
	<tr>
<td class="t8"> до дата
<td class="filtvisu" colspan=3> <b><?php echo $this->_tpl_vars['DATA']['date2']; ?>
</b>
	<tr>
<td class="t8"> нач.салдо
<td class="filtvisu" colspan=3> <b><?php echo $this->_tpl_vars['DATA']['balance1']; ?>
</b>
	<tr>
<td class="t8"> кр.салдо
<td class="filtvisu" colspan=3> <b><?php echo $this->_tpl_vars['DATA']['balance2']; ?>
</b>
	<tr>
<td class="t8" colspan=4> 
<br>
<center class="n10">
статистика на извлечението
</center>
<br>
	<tr>
					<?php if ($this->_tpl_vars['DATA']['cotot'] == 0): ?>
						<?php $this->assign('foco', "color='red'"); ?>
					<?php else: ?>
						<?php $this->assign('foco', ""); ?>
					<?php endif; ?>
<td class="t8"><font <?php echo $this->_tpl_vars['foco']; ?>
> <nobr>общо редове</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['DATA']['cotot']; ?>
</b>
	<tr>
<td class="t8"> <nobr>&nbsp;-&nbsp; разходи</nobr>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['DATA']['cotot']-$this->_tpl_vars['DATA']['coinp']; ?>
</b>
	<tr>
					<?php if ($this->_tpl_vars['DATA']['coinp'] == 0): ?>
						<?php $this->assign('foco', "color='red'"); ?>
					<?php else: ?>
						<?php $this->assign('foco', ""); ?>
					<?php endif; ?>
<td class="t8"><font <?php echo $this->_tpl_vars['foco']; ?>
> <nobr>&nbsp;-&nbsp; постъпления</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['DATA']['coinp']; ?>
</b>
	<tr>
					<?php if ($this->_tpl_vars['DATA']['codub'] == 0): ?>
						<?php $this->assign('foco', "color='red'"); ?>
					<?php else: ?>
						<?php $this->assign('foco', ""); ?>
					<?php endif; ?>
<td class="t8"><font <?php echo $this->_tpl_vars['foco']; ?>
> <nobr>&nbsp;-&nbsp;&nbsp;-&nbsp; дублирани</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['DATA']['codub']; ?>
</b>
	<tr>
					<?php if ($this->_tpl_vars['DATA']['conew'] == 0): ?>
						<?php $this->assign('foco', "color='red'"); ?>
					<?php else: ?>
						<?php $this->assign('foco', ""); ?>
					<?php endif; ?>
<td class="t8"><font <?php echo $this->_tpl_vars['foco']; ?>
> <nobr>&nbsp;-&nbsp;&nbsp;-&nbsp; нови</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['DATA']['conew']; ?>
</b>
	</table>
<br>
			<?php if ($this->_tpl_vars['DATA']['conew'] == 0): ?>
			<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'приеми извлечението','NAME' => 'action','ID' => 'action')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
tosuff();
function tosuff(){
	$('#banksuff').load('finabanksuff.ajax.php?indx='+$('#xmlsuffix').get(0).options[$('#xmlsuffix').get(0).selectedIndex].value);
}
</script>