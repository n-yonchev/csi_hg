<?php /* Smarty version 2.6.9, created on 2026-01-03 22:22:15
         compiled from finamarkclos.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'finamarkclos.ajax.tpl', 29, false),array('modifier', 'tomo3', 'finamarkclos.ajax.tpl', 42, false),array('modifier', 'tomoney2', 'finamarkclos.ajax.tpl', 121, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "приключване на постъпление")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.h6 {font:bold 10pt verdana;}
</style>

								<font color=red><span id="<?php echo $this->_tpl_vars['NYREMO']['idzone']; ?>
"></span></font>

				
		<table bgcolor=beige>
		<tr>
<td> по изп.дело
<td class="h6"> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ROCASE']['serial'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ROCASE']['year']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ROCASE']['year'])); ?>

		<tr>
<td> статус на делото
<td class="h6">
				<?php if ($this->_tpl_vars['ROCASE']['idstat'] == 0 || $this->_tpl_vars['ROCASE']['idstat'] == 24): ?>
<?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['ROCASE']['idstat']]; ?>

				<?php else: ?>
<font color=red>
<?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['ROCASE']['idstat']]; ?>

</font>
				<?php endif; ?>
		<tr>
<td> сума на постъплението
<td class="h6"> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['inco'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

		</table>
<br>
<nobr>
Ще маркирате постъплението като ГОТОВО ЗА ПРЕВОД.
</nobr>
<br>
<nobr>
След маркирането няма да може да променяте данните за това постъпление.
</nobr>

<br>
<?php $_from = $this->_tpl_vars['ARFINA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['elem']):
?>
	<?php if ($this->_tpl_vars['idclai'] > 0 && empty ( $this->_tpl_vars['elem']['iban'] )): ?>
<div class="no"> ВНИМАНИЕ.</div>
<div class="no"> липсва IBAN за сумата <?php echo $this->_tpl_vars['elem']['suma']; ?>
 към взискател <?php echo $this->_tpl_vars['elem']['clainame']; ?>

</div>
	<?php else: ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['idclai'] > 0 && $this->_tpl_vars['elem']['ibaniser']): ?>
<div class="no"> ВНИМАНИЕ.</div>
<div class="no"> ГРЕШЕН IBAN за сумата <?php echo $this->_tpl_vars['elem']['suma']; ?>
 към взискател <?php echo $this->_tpl_vars['elem']['clainame']; ?>

</div>
	<?php else: ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

 						<?php if ($this->_tpl_vars['SUMA26'] == 0): ?>
						<?php else: ?>
<br>
ВНИМАНИЕ.
<br>
Ще бъде формирана планирана такса в размер <b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA26'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b> € 
<br>
за т.26 с платец длъжника <b><?php echo $this->_tpl_vars['DEBTNAME']; ?>
</b>
						<?php endif; ?>

<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'маркирай постъплението','NAME' => 'submtran','ID' => 'submtran')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
като готово за превод
<br>&nbsp;

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