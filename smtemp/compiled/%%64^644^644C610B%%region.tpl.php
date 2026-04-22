<?php /* Smarty version 2.6.9, created on 2020-02-28 11:24:19
         compiled from region.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'>списък на <?php echo $this->_tpl_vars['HEADMAIN']; ?>
</td>
	</tr>
	<tr>
<td class='d_table_button' colspan='200'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	</tr>
</thead>

<tr class='header'>
<td>текст </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
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
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['dele']; ?>
" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</td>

		<td class='sep'>&nbsp;</td>
	<?php if (isset ( $_SESSION['reorderget'] )): ?>
		<?php if ($_SESSION['reorderget'] == $this->_tpl_vars['elem']['id']): ?>
<td>
		<?php else: ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['put']; ?>
"><img src="images/put.gif" title='спусни текста "<?php echo $_SESSION['reordertext']; ?>
" преди този'></a></td>
		<?php endif; ?>
	<?php else: ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['get']; ?>
"><img src="images/get.gif" title="вземи този ред"></a></td>
	<?php endif; ?>

	<?php endforeach; endif; unset($_from); ?>

</table>


