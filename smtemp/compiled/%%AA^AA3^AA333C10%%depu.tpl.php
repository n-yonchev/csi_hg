<?php /* Smarty version 2.6.9, created on 2020-03-09 10:44:42
         compiled from depu.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на деловодителите</td>
		</tr>
		</thead>
		<tr class='header'>
<td><span> име </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> дела</span></td>
		<td class='sep'>&nbsp;</td>
<td>заместник</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		</tr>
	<tbody>
		<?php $_from = $this->_tpl_vars['USERLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
 </td>
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['COUNLIST'][$this->_tpl_vars['elem']['id']]; ?>
&nbsp; </td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['namedepu']; ?>
&nbsp; </td>
		<td class='sep'>&nbsp;</td>
<td class="none" align=center> 
				<?php if ($this->_tpl_vars['elem']['idconn'] == 0): ?>
					<?php if ($this->_tpl_vars['elem']['isnamedepu'] == 0): ?>
						<?php if ($this->_tpl_vars['COUNLIST'][$this->_tpl_vars['elem']['id']] == 0): ?>
						<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/makeeq.gif" title="определи заместник"></a>
						<?php endif; ?>
					<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['dele']; ?>
" class="nyroModal" target="_blank"><img src="images/restore.gif" title="прекрати заместването"></a>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>
&nbsp;
</td>
		</tr>

		<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
