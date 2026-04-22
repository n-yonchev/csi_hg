<?php /* Smarty version 2.6.9, created on 2020-03-09 09:19:42
         compiled from archedit.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'archedit.ajax.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
	<?php $this->assign('_title', 'архивирай изпълнително дело '); ?>
<?php else: ?>
	<?php $this->assign('_title', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='корегирай архивните данните за изп.дело ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ROCONT']['caseseri']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ROCONT']['caseseri'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ROCONT']['caseyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ROCONT']['caseyear']))); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<input type="hidden" name="year" id="year" value="<?php echo $this->_tpl_vars['YEAR']; ?>
">
						<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
изп.дело/год
<input type="text" name="seriyear" id="seriyear" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'seriyear','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния архивен номер - евентуално <b><span id="yearnext"></span></b>
	<div id="seriente" style="display: block;">
<nobr>
или въведи желания архивен номер за <?php echo $this->_tpl_vars['YEAR']; ?>
 год.
<input type="text" name="serial" id="serial" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serial','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
</nobr>
	</div>
						<?php else: ?>
архивен номер за <?php echo $this->_tpl_vars['YEAR']; ?>
 год.
<input type="text" name="serial" id="serial" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'serial','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
						<?php endif; ?>
<br>
дата на архивиране
<input type="text" name="date" id="date" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
&nbsp;
връзка номер
<input type="text" name="packet" id="packet" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'packet','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<br>
<nobr>
протокол №
<input type="text" name="protocol" id="protocol" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'protocol','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
&nbsp;
от дата
<input type="text" name="protdate" id="protdate" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'protdate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
</nobr>
<br>
запазени документи - номер, дата, описание
<br>
<textarea rows=8 cols=80 name="doculist" id="doculist" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'doculist','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
<br>
том година и номер
<br>
<input type="text" name="volume" id="volume" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'volume','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
забележка
<br>
<input type="text" name="notes" id="notes" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
						<?php else: ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="toggle(); return false;" style="font: normal 8pt verdana; border-bottom: 1px solid black;"> 
деархивирай дело <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ROCONT']['caseseri'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ROCONT']['caseyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ROCONT']['caseyear'])); ?>
 </a>
<div id="dearch" style="display:none;">
<br>
ВНИМАНИЕ.
В резултат на деархивирането :
<br>
Всички ТЕЗИ архивни данни за делото ще бъдат ИЗТРИТИ.
<br>
Архивния номер <b><?php echo $_POST['serial']; ?>
/<?php echo $this->_tpl_vars['YEAR']; ?>
</b> ще остане СВОБОДЕН.
<br>
Изп.дело <b><?php echo $this->_tpl_vars['ROCONT']['caseseri']; ?>
/<?php echo $this->_tpl_vars['ROCONT']['caseyear']; ?>
</b> ще попадне ИЗВЪН АРХИВА.
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'потвърди','NAME' => 'delete','ID' => 'delete')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'откажи','NAME' => 'cancel','ID' => 'cancel')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
						<?php endif; ?>

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
chansele();
chancrea();
function chansele(){
	$("#yearnext").load("casearchnext.ajax.php?year="+$("#year").attr("value"));
}
function chancrea(){
	if (obje.checked){
		obente.style.display= "none";
		resizeNyroModalIframe();
	}else{
		obente.style.display= "block";
		resizeNyroModalIframe();
	}
}
function toggle(){
//	$("#dearch:visible").hide();
	$("#dearch:hidden").show();
		resizeNyroModalIframe();
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>