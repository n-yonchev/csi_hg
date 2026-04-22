<?php /* Smarty version 2.6.9, created on 2020-02-27 15:42:24
         compiled from cazo6uplo.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => "качване на файл")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<?php if ($this->_tpl_vars['VARI'] == 'INIT'): ?>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
		<?php else: ?>
<span class="former"> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </span>
<br>
<br>
		<?php endif; ?>
			<?php if (empty ( $this->_tpl_vars['FILENAME'] )): ?>
			<?php else: ?>
ВНИМАНИЕ.
<br>
Текущия файл <b><?php echo $this->_tpl_vars['FILENAME']; ?>
</b>
<br>
ще бъде изтрит след качване на новия.
<br>
<br>
			<?php endif; ?>
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'качи файла','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
					<?php endif; ?>

					<?php if ($this->_tpl_vars['VARI'] == 'submit'): ?>
		<?php if ($this->_tpl_vars['ERTEXT'] == ""): ?>
файла е качен успешно
		<?php else: ?>
<span class="former"> <?php echo $this->_tpl_vars['ERTEXT']; ?>
 </span>
<br>
<br>
		<?php endif; ?>
					<?php else: ?>
					<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>