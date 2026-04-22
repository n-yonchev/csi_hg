<?php /* Smarty version 2.6.9, created on 2020-12-16 22:08:56
         compiled from fdyeform.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на годините</td>
	</tr>
</thead>

<tr class='header'>
	<td>година</td>
	<td class='sep'>&nbsp;</td>
	<td>докум.</td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<?php $_from = $this->_tpl_vars['LISTYEAR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuye']):
?>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> <?php echo $this->_tpl_vars['cuye']; ?>
</td>
		<td class='sep'>&nbsp;</td>
		<td align=center <?php if ($this->_tpl_vars['LIST'][$this->_tpl_vars['cuye']]['coun'] == 0):  else: ?>bgcolor="#dddddd"<?php endif; ?>> <b><?php echo $this->_tpl_vars['LIST'][$this->_tpl_vars['cuye']]['coun']; ?>
</b> </td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	<?php if ($this->_tpl_vars['LIST'][$this->_tpl_vars['cuye']]['coun'] == 0): ?>
	<?php else: ?>
<a href="<?php echo $this->_tpl_vars['LIST'][$this->_tpl_vars['cuye']]['view']; ?>
"><img src="images/view.png" title="виж документите"></a>
	<?php endif; ?>
</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>


