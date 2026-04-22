<?php /* Smarty version 2.6.9, created on 2020-02-27 15:33:19
         compiled from finai2yearcell.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'finai2yearcell.tpl', 13, false),)), $this); ?>
				<td class='sep'>&nbsp;</td>
					<?php $this->assign('elem', $this->_tpl_vars['CELL'][$this->_tpl_vars['FIEL']]); ?>
					<?php if ($this->_tpl_vars['FIEL'] == 'coun'): ?>
						<?php $this->assign('mycell', $this->_tpl_vars['elem']); ?>
					<?php else: ?>
						<?php $this->assign('mycell', ((is_array($_tmp=$this->_tpl_vars['elem'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp))); ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['CLAS'] == ""): ?>
						<?php $this->assign('myclas', 'cell'); ?>
					<?php else: ?>
						<?php $this->assign('myclas', $this->_tpl_vars['CLAS']); ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']+0 == 0): ?>
<td align=right class="<?php echo $this->_tpl_vars['myclas']; ?>
"> -
					<?php else: ?>
						<?php if ($this->_tpl_vars['FIEL'] == 'suma' && $this->_tpl_vars['CLAS'] == ""): ?>
<td align=right class="link" title="виж списъка" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['CELL']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['mycell']; ?>
 
						<?php else: ?>
<td align=right class="<?php echo $this->_tpl_vars['myclas']; ?>
"> <?php echo $this->_tpl_vars['mycell']; ?>
 
						<?php endif; ?>
					<?php endif; ?>