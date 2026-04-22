<?php /* Smarty version 2.6.9, created on 2020-03-13 08:44:34
         compiled from casecompform.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
	<td class='d_table_title' colspan='200'>брой дела с непълни основни данни</td>
	</tr>
</thead>

<tr class='header'>
	<td>име</td>
	<td class='sep'>&nbsp;</td>
	<td>общо</td>
	<td class='sep'>&nbsp;</td>
<?php $_from = $this->_tpl_vars['LISTYEAR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
	<td align=center> <?php echo $this->_tpl_vars['year']; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<?php endforeach; endif; unset($_from); ?>
</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<?php if ($this->_tpl_vars['elem']['id'] == 0): ?>
		<tr>
		<td>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> <font color="red"> СВОБОДНИ </font></td>
			<?php else: ?>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
</td>
			<?php endif; ?>
		<td class='sep'>&nbsp;</td>
	<?php $this->assign('cuuser', $this->_tpl_vars['elem']['id']); ?>
		<td align=center> <b><?php echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['cuuser']]['tota']; ?>
</b> </td>
		<td class='sep'>&nbsp;</td>
<?php $_from = $this->_tpl_vars['LISTYEAR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
	<?php $this->assign('councase', $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['cuuser']][$this->_tpl_vars['year']]); ?>
		<td align=center 
<?php if ($this->_tpl_vars['councase'] == 0 || $this->_tpl_vars['elem']['id'] == 0):  else: ?>
bgcolor="#dddddd" style="cursor:pointer" onclick="document.location.href='<?php echo $this->_tpl_vars['elem'][$this->_tpl_vars['year']]['view']; ?>
';" title="виж делата"
<?php endif; ?>>
		<b><?php echo $this->_tpl_vars['councase']; ?>
</b> </td>
		<td class='sep'>&nbsp;</td>
<?php endforeach; endif; unset($_from); ?>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
		<tr>
		<td> <b>ОБЩО ДЕЛА</b> </td>
		<td class='sep'>&nbsp;</td>
		<td align=center> <b><?php echo $this->_tpl_vars['ARTOTA']['tota']; ?>
</b> </td>
		<td class='sep'>&nbsp;</td>
<?php $_from = $this->_tpl_vars['LISTYEAR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
	<?php $this->assign('councase', $this->_tpl_vars['ARTOTA'][$this->_tpl_vars['year']]); ?>
		<td align=center> <b><?php echo $this->_tpl_vars['councase']; ?>
</b> </td>
		<td class='sep'>&nbsp;</td>
<?php endforeach; endif; unset($_from); ?>
	
</table>


