<?php /* Smarty version 2.6.9, created on 2020-03-04 20:46:23
         compiled from docuedituplo.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'docuedituplo.ajax.tpl', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


							<?php if (count ( $this->_tpl_vars['ARINCO'] ) == 1): ?>
								<?php $this->assign('innumb', $this->_tpl_vars['ARINCO'][0]); ?>
							<?php else: ?>
								<?php $this->assign('innumb', ""); ?>
							<?php endif; ?>
																<?php if (! $this->_tpl_vars['ISDOCUOUT']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp="качване на сканиран файл за вх.документ ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['innumb']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['innumb'])),'WIDTH' => 420)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
nyremo= function(){
	jQuery.ajax({
		url: "docuedituplosess.ajax.php"
		,success: fusucc
		});
}
function fusucc(data){
	if (data=="OK"){
parent.$.nyroModalRemove();
	}else{
alert(data);
	}
}
</script>

							<?php if (count ( $this->_tpl_vars['ARINCO'] ) == 1): ?>
							<?php else: ?>
входящи документи : 
<?php $_from = $this->_tpl_vars['ARINCO']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
	&nbsp;<?php echo $this->_tpl_vars['elem']; ?>

<?php endforeach; endif; unset($_from); ?>
<br>
							<?php endif; ?>
<br>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<div style="color:red"> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </div>
		<?php endif; ?>
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="12000000">
<input type="file" name="file" id="file" size="90" class="input">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'качи','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
			<br>&nbsp;

																<?php else: ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp="качване на сканиран файл за изходящ документ ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['innumb']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['innumb'])),'WIDTH' => 420)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
nyremo= function(){
	jQuery.ajax({
		url: "docuedituplosess.ajax.php"
		,success: fusucc
		});
}
function fusucc(data){
	if (data=="OK"){
parent.$.nyroModalRemove();
	}else{
alert(data);
	}
}
</script>

<br>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<div style="color:red"> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </div>
		<?php endif; ?>
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="12000000">
<input type="file" name="file" id="file" size="90" class="input">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'качи','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<br>&nbsp;

																<?php endif; ?>

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