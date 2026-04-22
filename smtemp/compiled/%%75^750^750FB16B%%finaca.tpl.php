<?php /* Smarty version 2.6.9, created on 2020-02-28 11:21:04
         compiled from finaca.tpl */ ?>
	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'> списък на постъпленията
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
	</tr>
	<tr>
	<td colspan='200'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_finaexfilt.tpl", 'smarty_include_vars' => array('NOUSER' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	</tr>
	</thead>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_fina.tpl", 'smarty_include_vars' => array('HIST' => false,'CASEUSER' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</table>


