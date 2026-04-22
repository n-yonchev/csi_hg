<?php /* Smarty version 2.6.9, created on 2026-01-03 20:04:37
         compiled from cazobalaexte.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'cazobalaexte.tpl', 39, false),array('function', 'math', 'cazobalaexte.tpl', 42, false),)), $this); ?>
					<?php if (0): ?>
					<?php elseif ($this->_tpl_vars['VARI'] == 'move'): ?>
			<?php if ($this->_tpl_vars['elem']['move']['taxamo'] == 0): ?>
			<?php else: ?>
<tr>
<td class="tdbalasuma" colspan=3> към сумата за т.26
<td class="tdbalasuma" align=right> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elem']['move']['taxamo'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
					<?php elseif ($this->_tpl_vars['VARI'] == 'plus'): ?>
			<?php if ($this->_tpl_vars['elem']['plus']['taxamo'] == 0): ?>
			<?php else: ?>
<tr>
<td class="tdbalasuma" colspan=3> сума за т.26
<td class="tdbalasuma" align=right> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastatelem.tpl", 'smarty_include_vars' => array('CONT' => $this->_tpl_vars['elem']['plus']['taxamo'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
										<?php elseif ($this->_tpl_vars['VARI'] == 'resu'): ?>
<tr>
<td class="tdbalasuma" colspan=4> актуален дълг
<td class="tdbala" align=right 
		<?php if ($this->_tpl_vars['ACTUDEBT']): ?>
onclick="$('#actudebtinfo').load('cazoactuinfo.ajax.php?edit=<?php echo $this->_tpl_vars['IDCASE']; ?>
');"
oncontextmenu="$('#actudebtinfo').html(''); return false;"
		<?php else: ?>
		<?php endif; ?>
> 
													<?php if ($this->_tpl_vars['ACTUDEBT']): ?>
											<font size=+1>
													<?php else: ?>
													<?php endif; ?>
												<?php if ($this->_tpl_vars['elem']['tosuma'] < 0): ?>
													<span class="red7bg"> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['tosuma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b> </span>
												<?php else: ?>
													<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['tosuma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 €
													<?php echo smarty_function_math(array('assign' => 'suma_leva','equation' => "x * y",'x' => $this->_tpl_vars['elem']['tosuma'],'y' => 1.95583), $this);?>

													<span style="white-space: nowrap;"><?php echo ((is_array($_tmp=$this->_tpl_vars['suma_leva'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 лв</span>
												<?php endif; ?>
													<?php if ($this->_tpl_vars['ACTUDEBT']): ?>
											</font>
													<?php else: ?>
													<?php endif; ?>
<script>
function getacdebt(){
return "<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['tosuma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
";
}
function getacdebt_list(){
return "<?php echo $this->_tpl_vars['ACDEBT_LIST']; ?>
";
}
</script>
					<?php else: ?>
					<?php endif; ?>
					