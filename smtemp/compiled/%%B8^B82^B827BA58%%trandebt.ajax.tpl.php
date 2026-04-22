<?php /* Smarty version 2.6.9, created on 2021-09-17 15:26:57
         compiled from trandebt.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'trandebt.ajax.tpl', 6, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "корекция на длъжник за превод",'WIDTH' => 400)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
Избери длъжник за превод на сумата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARDATA']['amount'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> 
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDEBTNAME'],'ID' => 'iddebtor','C1' => 'input','C2' => 'inputer','ONCH' => "getiban(this);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<div id="debtiban"></div>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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

<script>
function getiban(obje){
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	jQuery.ajax({
		url: "trandebtiban.ajax.php?p="+valu
		,success: ibansucc
		});
}
function ibansucc(data){
	var arre= data.split("^");
//alert(data);
	var text;
	if (arre[0]=="ok"){
		if (arre[1]==""){
			text= "";
		}else{
			text= "iban= <b>"+arre[1]+"</b>";
		}
		$("#debtiban").html(text);
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>