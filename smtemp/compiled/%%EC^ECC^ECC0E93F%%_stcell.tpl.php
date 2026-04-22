<?php /* Smarty version 2.6.9, created on 2025-04-11 16:19:06
         compiled from _stcell.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', '_stcell.tpl', 18, false),)), $this); ?>
										<?php if ($this->_tpl_vars['FLPRIN']):  echo ((is_array($_tmp=$this->_tpl_vars['VALUE'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, ",", "") : number_format($_tmp, 2, ",", "")); ?>

										<?php else: ?>
	<?php if ($this->_tpl_vars['VALUE'] == 0): ?>
&nbsp;
	<?php else: ?>
					<?php if ($this->_tpl_vars['FLAG'] == 1): ?>
<a href="stmontuser3.ajax.php<?php echo $this->_tpl_vars['USERLINK'][$this->_tpl_vars['userid']]; ?>
" class="nyroModal" target="_blank" 
style="border-bottom:0px solid black;font:normal 8pt verdana;cursor:pointer;">
<?php echo ((is_array($_tmp=$this->_tpl_vars['VALUE'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
&nbsp;
</a>
					<?php elseif ($this->_tpl_vars['FLAG'] == 2): ?>
<a href="stmontuser4.ajax.php<?php echo $this->_tpl_vars['USERLINK'][$this->_tpl_vars['userid']]; ?>
" class="nyroModal" target="_blank" 
style="border-bottom:0px solid black;font:normal 8pt verdana;cursor:pointer;">
<?php echo ((is_array($_tmp=$this->_tpl_vars['VALUE'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
&nbsp;
</a>
					<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['VALUE'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ".", ",") : number_format($_tmp, 0, ".", ",")); ?>
&nbsp;
					<?php endif; ?>
	<?php endif; ?>
										<?php endif; ?>