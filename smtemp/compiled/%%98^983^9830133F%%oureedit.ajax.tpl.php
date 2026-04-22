<?php /* Smarty version 2.6.9, created on 2020-02-27 16:43:00
         compiled from oureedit.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'oureedit.ajax.tpl', 8, false),)), $this); ?>

		<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
			<?php $this->assign('txti', "данни за нов изходящ документ"); ?>
		<?php else: ?>
			<?php $this->assign('txti', ((is_array($_tmp="корекция на данни за изх.документ ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['DOCUNOME']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['DOCUNOME']))); ?>
		<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('ONLOAD' => "chancrea();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['txti'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер - евентуално <b><?php echo $this->_tpl_vars['NEXTNUMB']; ?>
</b>
	<div id="seriente" style="display: block;">
или въведи желания изходящ номер
<input type="text" name="serinome" id="serinome" size=8 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serinome','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
	</div>
		<?php else: ?>
		<?php endif; ?>
					<?php if ($this->_tpl_vars['FROMCASE']): ?>
<input type=hidden name="caseseri" id="caseseri">
<input type=hidden name="caseyear" id="caseyear">
<br>
дело <b><?php echo $_POST['caseseri']; ?>
/<?php echo $_POST['caseyear']; ?>
</b>
					<?php else: ?>
<br>
дело номер 
<input type="text" name="caseseri" id="caseseri" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'caseseri','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
година 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARYEARNAME'],'ID' => 'caseyear','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['CBCREACASE']): ?>
създай делото
<input type="checkbox" name="flagcrea" id="flagcrea">
		<?php else: ?>
		<?php endif; ?>
					<?php endif; ?>

<br>
описание
<br>
<input type="text" name="descrip" id="descrip" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'descrip','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'adresat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
бележки
<br>
<input type="text" name="notes" id="notes" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br><br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
//chancrea();
function chancrea(){
	if (obje.checked){
		obente.style.display= "none";
		resizeNyroModalIframe();
	}else{
		obente.style.display= "block";
		resizeNyroModalIframe();
	}
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>