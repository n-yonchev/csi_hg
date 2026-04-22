<?php /* Smarty version 2.6.9, created on 2020-02-27 12:57:06
         compiled from finoform.tpl */ ?>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br>
<br>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
<tr>
<td class='d_table_title' colspan=100> филтър за търсене
	</thead>
	<tbody>

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
въведи за делото номер/година
<br>
или само номер
	</div>
<br>
<input type="text" name="textnome" id="textnome" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'textnome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'намери','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br> &nbsp;

<td width=4> &nbsp;
</table>
</form>