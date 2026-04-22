<?php /* Smarty version 2.6.9, created on 2020-03-02 11:28:38
         compiled from cazo34reg4.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo34reg4.ajax.tpl', 2, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp="съвпадения за длъжник ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['DEBTNAME']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['DEBTNAME'])),'WIDTH' => 400)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<?php if (isset ( $this->_tpl_vars['MESS'] )): ?>
<?php echo $this->_tpl_vars['MESS']; ?>

			<?php else: ?>
				<?php if (count ( $this->_tpl_vars['ARRESU'] ) == 0): ?>
няма регистрирани дела 
				<?php else: ?>
<style>
.trow {border-bottom: 1px solid black;}
</style>
						<table align=center>
						<tr>
<td colspan=10> списък съвпадения
						<tr bgcolor=silver>
<td> име
<td> ЕГН/ЕИК
<td> чужд
<td> изп.дело
<td> статус
<td> ЧСИ
<td> номер
		<?php $_from = $this->_tpl_vars['ARRESU']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
						<tr>
<td class="trow"> <?php if (empty ( $this->_tpl_vars['elem']['name'] )):  echo $this->_tpl_vars['elem']['company_name'];  else:  echo $this->_tpl_vars['elem']['name'];  endif; ?>
<td class="trow"> <?php echo $this->_tpl_vars['elem']['egn_eik']; ?>

<td class="trow"> <?php if ($this->_tpl_vars['elem']['foreigner'] == 0): ?>&nbsp;<?php else: ?>да<?php endif; ?>
<td class="trow"> <?php echo $this->_tpl_vars['elem']['number']; ?>

<td class="trow"> <?php echo $this->_tpl_vars['AR4CASESTAT'][$this->_tpl_vars['elem']['status']]; ?>

<td class="trow"> <?php echo $this->_tpl_vars['elem']['chsi_name']; ?>

<td class="trow"> <?php echo $this->_tpl_vars['elem']['chsi_number']; ?>

		<?php endforeach; endif; unset($_from); ?>
						</table>
				<?php endif; ?>
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