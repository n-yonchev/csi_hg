<?php /* Smarty version 2.6.9, created on 2020-03-05 14:51:04
         compiled from cofrom.tpl */ ?>
<table class="d_table" width='350px' cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на съдилищата и др.източници</td>
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
<td>тип</td>
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
<td> <?php if ($this->_tpl_vars['elem']['idtype'] == 0): ?>съд<?php else: ?><nobr>друг изт.</nobr><?php endif; ?></td>
		<td class='sep'>&nbsp;</td>
		<td align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="<?php echo $this->_tpl_vars['elem']['view']; ?>
" class="nyroModal" target="_blank"><img src="images/view.png" title="подробно"></a></td>
		<td class='sep'>&nbsp;</td>
	<?php if (isset ( $_SESSION['getcofrom'] )): ?>
<td align=center><a href="<?php echo $this->_tpl_vars['elem']['put']; ?>
"><img src="images/put.gif" title="спусни тук <?php echo $_SESSION['getcofromname']; ?>
"></a></td>
	<?php else: ?>
<td align=center><a href="<?php echo $this->_tpl_vars['elem']['get']; ?>
"><img src="images/get.gif" title="вземи"></a></td>
	<?php endif; ?>
	</tr>
	<?php endforeach; endif; unset($_from);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>


