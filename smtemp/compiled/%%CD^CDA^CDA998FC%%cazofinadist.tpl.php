<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazofinadist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'cazofinadist.tpl', 13, false),)), $this); ?>
	<table cellspacing=0 cellpadding=0>
				<?php if (count ( $this->_tpl_vars['elem']['clailist'] ) == 0): ?>
	<tr>
<td colspan=3> няма взискатели
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['elem']['clailist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['clainame']):
?>
				<?php if ($this->_tpl_vars['elem']['claiamou'][$this->_tpl_vars['idclai']] == 0): ?>
				<?php else: ?>
	<tr>
<td> <?php echo $this->_tpl_vars['clainame']; ?>

	<td width=10>
<td align=right> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['claiamou'][$this->_tpl_vars['idclai']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
				<?php if ($this->_tpl_vars['elem']['separa'] == 0): ?>
				<?php else: ?>
	<tr>
	<td> ЧСИ неолихвяеми
	<td width=10>
<td align=right> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['elem']['separa2'] == 0): ?>
				<?php else: ?>
	<tr>
	<td> ЧСИ т.26
	<td width=10>
<td align=right> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa2'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['elem']['back'] == 0): ?>
				<?php else: ?>
	<tr>
	<td> връщане
	<td width=10>
<td align=right> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['back'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
				<?php endif; ?>
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
	<tr>
	<td> банкови такси
	<td width=10>
<td align=left> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['banktax'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
					<?php else: ?>
					<?php endif; ?>
	</table>