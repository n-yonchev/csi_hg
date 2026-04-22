<?php /* Smarty version 2.6.9, created on 2020-11-16 17:04:48
         compiled from reports.tpl */ ?>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br>
<br>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
<tr>
<td class='d_table_title' colspan=100> избор на период
	</thead>
	<tbody>

<tr>
<td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
	<div style="font: normal 10pt verdana">
избери период за отчетите раздел 1, раздел 2 и ВСС
	</div>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARPERINAME'],'ID' => 'period','C1' => 'input','C2' => 'inputer','ONCH' => "document.forms['myform'].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br> &nbsp;

</table>
</form>