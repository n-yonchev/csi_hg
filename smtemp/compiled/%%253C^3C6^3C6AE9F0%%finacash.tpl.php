<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:15
         compiled from finacash.tpl */ ?>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<table cellspacing=0 cellpadding=0 align=center border=0>
<tr>
<td width=4> &nbsp;
<td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
	<div style="font: normal 10pt verdana">
въведи една или две дати за търсене
<br>
на постъпления в брой за период
	</div>
				<table>
				<tr>
<td style="font: normal 8pt verdana"> от дата
<td style="font: normal 8pt verdana"> до дата
				<tr>
<td>
<input type="text" name="date1" id="date1" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date1','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<input type="text" name="date2" id="date2" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'търси','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>

<td width=4> &nbsp;
</table>
</form>

<br>