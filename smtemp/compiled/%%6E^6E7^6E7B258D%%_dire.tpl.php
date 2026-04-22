<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:44
         compiled from _dire.tpl */ ?>
	<?php if (isset ( $this->_tpl_vars['DATADIRE'] )): ?>
<table align=center>
<tr><td style="background-color:moccasin; font: normal 8pt verdana; padding: 10px;">
насочване към дело на постъпление <b><?php echo $this->_tpl_vars['DATADIRE']['rofina']['inco']; ?>

<br>
<?php echo $this->_tpl_vars['DATADIRE']['rofina']['descrip']; ?>
</b>
<br>
		<?php if (isset ( $this->_tpl_vars['DATADIRECASE'] )): ?>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['DATADIRE']['oklink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> насочи към текущото дело
</a>
&nbsp;&nbsp;
		<?php else: ?>
		<?php endif; ?>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['DATADIRE']['exitlink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> прекрати
</a>
</table>
	<?php else: ?>
	<?php endif; ?>