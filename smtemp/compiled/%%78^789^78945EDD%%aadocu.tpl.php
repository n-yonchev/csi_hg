<?php /* Smarty version 2.6.9, created on 2024-04-18 11:16:51
         compiled from aadocu.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='20'>списък на типовете вх.документи</td>
	</tr>
	<tr>
		<td class='d_table_button' colspan='20'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
</thead>

<tr class='header'>
	<td>текст </td>	<td class='sep'>&nbsp;</td>
	<td>срок за<br />отговор </td>	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
</td>
		<td class='sep'>&nbsp;</td>
		<td align="center"><?php if ($this->_tpl_vars['elem']['deadline_days'] > 0): ?> <?php echo $this->_tpl_vars['elem']['deadline_days']; ?>
 дни<?php endif; ?> </td>
		<td class='sep'>&nbsp;</td>
		<td align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
	<td <?php if ($this->_tpl_vars['elem']['isassigned']): ?>class="issigreen"<?php endif; ?> align=center><a href="<?php echo $this->_tpl_vars['elem']['issi']; ?>
" class="nyroModal" target="_blank" style="font-size: 9px">[ИССИ]</a></td>
	</tr>
	<?php endforeach; endif; unset($_from);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>


