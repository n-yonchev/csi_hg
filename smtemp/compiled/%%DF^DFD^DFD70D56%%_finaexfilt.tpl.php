<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:12
         compiled from _finaexfilt.tpl */ ?>
<script type="text/javascript" src="js/_finaexfilt.js"></script>
					<table align="left" cellspacing="0" cellpadding="0">
					<tr>
<td align=left colspan=2> сума
<td align=left colspan=2> дата
<td align=left colspan=2> &nbsp;&nbsp;описание
<input type="text" name="exdesc" id="exdesc" class="inp7bold" size=20 onkeyup="exfilt(event);">
<td align=left colspan=2> &nbsp;&nbsp;дело/год
<input type="text" name="excase" id="excase" class="inp7bold" size=10 onkeyup="exfilt(event);">
					<tr>
<td align=left> от
<td>
<input type="text" name="exsum1" id="exsum1" class="inp7bold" size=8 onkeyup="exfilt(event);">
<td align=left> нач.
<td>
<input type="text" name="exdat1" id="exdat1" class="inp7bold" size=12 onkeyup="exfilt(event);">
<td align=left> &nbsp;&nbsp;тип
<td align=left> &nbsp;&nbsp;назнач.дело
<td align=left> &nbsp;&nbsp;деловодител
<td align=left> &nbsp;&nbsp;за ЧСИ
<td align=left> &nbsp;&nbsp;приключване
<td align=left> &nbsp;&nbsp;връщане
<td align=left>
<a href="#" onclick="exfiltsubm();" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">приложи</a>
					<tr>
<td align=left> до
<td align=left>
<input type="text" name="exsum2" id="exsum2" class="inp7bold" size=8 onkeyup="exfilt(event);">
<td align=left> край
<td align=left>
<input type="text" name="exdat2" id="exdat2" class="inp7bold" size=12 onkeyup="exfilt(event);">
<td align=left>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTYPENAME'],'ID' => 'e1type','C1' => 'input7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDIRENAME'],'ID' => 'e1dire','C1' => 'input7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARUSERNAME'],'ID' => 'e1user','C1' => 'input7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSEPANAME'],'ID' => 'e1sepa','C1' => 'input7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCLOSNAME'],'ID' => 'e1clos','C1' => 'input7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARBACKNAME'],'ID' => 'e1back','C1' => 'input7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left>
<a href="#" onclick="exclear();" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">изчисти</a>
					</table>

			<?php if ($this->_tpl_vars['NOUSER']): ?>
<script>
$("#e1user").attr("disabled","disabled");
</script>
			<?php else: ?>
			<?php endif; ?>