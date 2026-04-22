<?php /* Smarty version 2.6.9, created on 2020-03-05 12:20:32
         compiled from outtemuplo.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'outtemuplo.ajax.tpl', 2, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->assign('myti', ((is_array($_tmp=((is_array($_tmp="смяна на файла за изх.шаблон &quot;")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['TEMPTEXT']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['TEMPTEXT'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "&quot;") : smarty_modifier_cat($_tmp, "&quot;"))); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['myti'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
			<?php if (empty ( $this->_tpl_vars['FILENAME'] )): ?>
			<?php else: ?>
ВНИМАНИЕ.
<br>
Текущия файл <b><?php echo $this->_tpl_vars['FILENAME']; ?>
</b>
<br>
ще бъде изтрит след качване на новия.
<br>
			<?php endif; ?>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<div style="color:red"> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </div>
		<?php endif; ?>
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">

<br>
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