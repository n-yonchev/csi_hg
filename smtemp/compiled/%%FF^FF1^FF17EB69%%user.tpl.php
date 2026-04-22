<?php /* Smarty version 2.6.9, created on 2020-02-28 11:24:24
         compiled from user.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>списък на потребителите</td>
		</tr>
		<tr>
			<td class='d_table_button' colspan='200'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => "добави")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
	</thead>
		<tr class='header'>
			<td><span> име </span></td>
			<td class='sep'>&nbsp;</td>
<td> активен </td>
			<td class='sep'>&nbsp;</td>
<td> email </td>
			<td class='sep'>&nbsp;</td>
<td> телефон </td>
			<td class='sep'>&nbsp;</td>
			<td align=center> 
		</tr>
	<tbody>
		<?php $_from = $this->_tpl_vars['USERLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
 </td>
			<td class='sep'>&nbsp;</td>
			<td align=center> 
					<?php if ($this->_tpl_vars['elem']['inactive'] == 0): ?>
				<a href="<?php echo $this->_tpl_vars['elem']['inac']; ?>
"><img src='css/checkbox_checked.gif' alt='' /></a>
					<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['elem']['acti']; ?>
"><img src='css/checkbox.gif' alt='' /></a>
					<?php endif; ?>
			</td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['email']; ?>
 </td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['phone']; ?>
 </td>
			<td class='sep'>&nbsp;</td>
			<td class="none" align=center> 
				<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
			</td>
			</tr>

		<?php endforeach; endif; unset($_from); ?>
	</tbody>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>