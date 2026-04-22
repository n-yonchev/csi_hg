<?php /* Smarty version 2.6.9, created on 2020-03-09 10:40:58
         compiled from regi14.tpl */ ?>
							<?php if ($this->_tpl_vars['OK']): ?>
<center style="font:normal 10pt verdana;">
<br>
данните са записани
</center>
							<?php else: ?>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
		<tr>
			<td class='d_table_title' colspan=100> данни за достъп до регистър-2014
	</thead>
	<tbody>
<tr>
<td colspan=2 align=center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<tr>
<td> входно име
<td> 
<input type="text" name="regi14user" id="regi14user" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regi14user','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			<tr>
<td> вх.парола
<td> 
<input type="text" name="regi14pass" id="regi14pass" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'regi14pass','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			<tr>
<td colspan=2 align=center>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>&nbsp;
</table>
</form>
							<?php endif; ?>