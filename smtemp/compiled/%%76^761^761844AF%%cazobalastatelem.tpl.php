<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazobalastatelem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'cazobalastatelem.tpl', 2, false),)), $this); ?>
					<?php if ($this->_tpl_vars['CONT'] < 0): ?>
<span class="red7bg"> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['CONT'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b> </span>
					<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['CONT'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

					<?php endif; ?>