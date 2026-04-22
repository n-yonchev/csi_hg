<?php /* Smarty version 2.6.9, created on 2020-03-09 10:41:09
         compiled from presen.tpl */ ?>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<table cellspacing=0 cellpadding=0 align=center border=0>
<tr>
<td width=4> &nbsp;
<td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<span style="font: normal 8pt verdana;">
въведи дата за представянето
</span>
				<table>
				<tr>
<td>
<input type="text" name="date" id="date" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> autocomplete=off> 
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'готово','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>

<td width=4> &nbsp;
</table>
</form>

<br>

					<?php if (isset ( $this->_tpl_vars['ARUSER'] )): ?>
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<tr class='header'>
<td> деловодител
		<td class='sep'>&nbsp;</td>
<td align=right> входени<br>документи
		<td class='sep'>&nbsp;</td>
<td align=right> изходени<br>документи
		<td class='sep'>&nbsp;</td>
<td align=right> извършени<br>действия
<?php $_from = $this->_tpl_vars['ARUSER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['iduser'] => $this->_tpl_vars['name']):
?>
		<tr>
<td> <?php echo $this->_tpl_vars['name']; ?>

		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['ARDOCU'][$this->_tpl_vars['iduser']]; ?>
 &nbsp;
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['ARDOUT'][$this->_tpl_vars['iduser']]; ?>
 &nbsp;
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['ARJOUR'][$this->_tpl_vars['iduser']]; ?>
 &nbsp;
<?php endforeach; endif; unset($_from); ?>
		</table>
					<?php else: ?>
					<?php endif; ?>