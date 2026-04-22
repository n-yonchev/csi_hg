<?php /* Smarty version 2.6.9, created on 2020-02-27 14:00:08
         compiled from cazofigrtota.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'cazofigrtota.tpl', 2, false),)), $this); ?>
<td align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigramou.tpl", 'smarty_include_vars' => array('AMOU' => ((is_array($_tmp=$this->_tpl_vars['DATA']['suma'][$this->_tpl_vars['VARI']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_from = $this->_tpl_vars['CLAILIST2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ckey'] => $this->_tpl_vars['clai']):
?>
<td align=right> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofigramou.tpl", 'smarty_include_vars' => array('AMOU' => ((is_array($_tmp=$this->_tpl_vars['DATA'][$this->_tpl_vars['VARI']][$this->_tpl_vars['ckey']]['total'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>