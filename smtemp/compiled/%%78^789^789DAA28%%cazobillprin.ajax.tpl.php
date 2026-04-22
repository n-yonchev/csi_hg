<?php /* Smarty version 2.6.9, created on 2021-01-14 16:48:58
         compiled from cazobillprin.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "извеждане на сметка")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<span style="border-bottom: 1px solid black; cursor:pointer;" onclick="fuprin('<?php echo $this->_tpl_vars['LINKPRIN']; ?>
');"> отпечати </span>
<br>
<span style="font: normal 7pt verdana">
ЗАБЕЛЕЖКА. 
евентуалните ръчни корекции във файла сметка.doc ще бъдат отпечатани,
<br>
но не може да бъдат запомнени
</span>
<br>
<br>
<?php echo $this->_tpl_vars['CONT']; ?>


<iframe id="idprin" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprin(p1){
	document.getElementById("idprin").focus();
	document.getElementById("idprin").src= p1;
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>