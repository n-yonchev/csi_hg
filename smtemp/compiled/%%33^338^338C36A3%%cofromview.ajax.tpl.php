<?php /* Smarty version 2.6.9, created on 2021-03-09 16:45:15
         compiled from cofromview.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $this->assign('_title', 'данни за съдилище');  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<nobr>
				<table align=center>
				<tr>
<td> име
<td> <b><?php echo $this->_tpl_vars['DATA']['name']; ?>
</b>
				<tr>
<td> град
<td> <b><?php echo $this->_tpl_vars['DATA']['city']; ?>
</b>
				<tr>
<td> съд.окръг
<td> <b><?php echo $this->_tpl_vars['DATA']['region']; ?>
</b>
				<tr>
<td> адрес
<td> <b><?php echo $this->_tpl_vars['DATA']['address']; ?>
</b>
				<tr>
<td> ел.поща
<td> <u><a href="mailto:<?php echo $this->_tpl_vars['DATA']['email']; ?>
"> <b><?php echo $this->_tpl_vars['DATA']['email']; ?>
</b> </a></u>
				<tr>
<td> интернет стр.
<td> <u><a href="<?php echo $this->_tpl_vars['DATA']['webpage']; ?>
" target="_blank"> <b><?php echo $this->_tpl_vars['DATA']['webpage']; ?>
</b> </a></u>
				<tr>
<td> банка
<td> <b><?php echo $this->_tpl_vars['DATA']['bank2']; ?>
</b>
				<tr>
<td> сметка
<td> <b><?php echo $this->_tpl_vars['DATA']['bank2acc']; ?>
</b>
				<tr>
<td colspan=2> държавни такси
				<tr>
<td> банка
<td> <b><?php echo $this->_tpl_vars['DATA']['bank1']; ?>
</b>
				<tr>
<td> код
<td> <b><?php echo $this->_tpl_vars['DATA']['bank1bic']; ?>
</b>
				<tr>
<td> сметка
<td> <b><?php echo $this->_tpl_vars['DATA']['bank1acc']; ?>
</b>
				</table>
</nobr>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>