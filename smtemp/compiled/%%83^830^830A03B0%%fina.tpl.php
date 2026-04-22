<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:12
         compiled from fina.tpl */ ?>
	<table class="d_table" cellspacing='0' cellpadding='0' align=center border='0'>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'> 
списък на банковите и други постъпления
				<?php if (isset ( $this->_tpl_vars['FILTTEXT'] )): ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<span style="font: bold 7pt verdana; color: black;">
<?php echo $this->_tpl_vars['FILTTEXT']; ?>

</span>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $this->_tpl_vars['FILTTOALL']; ?>
" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">без филтър</a>
				<?php else: ?>
				<?php endif; ?>
						<span style="float:right;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</span>
	</td>
	<tr>
	<td colspan='200'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_finaexfilt.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	</tr>

	</thead>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_fina.tpl", 'smarty_include_vars' => array('HIST' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</table>


