<?php /* Smarty version 2.6.9, created on 2020-04-02 19:28:29
         compiled from perc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'perc.tpl', 18, false),)), $this); ?>
		<table align=center>
		<tr>
<td colspan=10 align=center> <b>списък на лихвените периоди</b>
		<tr>
<td>
		</tr>
		</thead>
		<tr>
		<td>
		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
						<?php echo smarty_function_counter(array('start' => $this->_tpl_vars['STEP'],'assign' => 'coun'), $this);?>

<?php $_from = $this->_tpl_vars['ARPERC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<?php if ($this->_tpl_vars['coun'] == $this->_tpl_vars['STEP']): ?>
							<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

		</table>
			<td width=20>
		<td valign=top>
		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<tr class='header'>
<td> нач.дата </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> кр.дата </td>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> ОЛП </td>
		</tr>
						<?php else: ?>
							<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

						<?php endif; ?>
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> <?php echo $this->_tpl_vars['elem']['begin']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['end']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['bnb']; ?>

		</tr>
<?php endforeach; endif; unset($_from); ?>
		</table>
			<td width=20>
		</table>
