<?php /* Smarty version 2.6.9, created on 2020-03-11 17:17:07
         compiled from /var/www/csi/outgoing/796_sluj_bele.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/var/www/csi/outgoing/796_sluj_bele.html', 2, false),)), $this); ?>
<?php $this->assign('tehead', "");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_header.html") : smarty_modifier_cat($_tmp, "sd_header.html")), 'smarty_include_vars' => array('TEXT' => $this->_tpl_vars['tehead'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br>
<p align=center>
<b>
СЛУЖЕБНА БЕЛЕЖКА
</b>
</p>

<br>
<p align=justify>
Уведомяваме Ви, че (-[DLUJNIK_NAME]-) ЕГН (-[DLUJNIK_EGN_BULSTAT]-) по изпълнително дело № (-[DELO_NUMBER]-)/(-[DELO_YEAR]-) г. 
дължи следните суми към дата (-[CURRENT_DATE]-) г. :
<br>
<br>
<div style="padding-left: 40pt;">
(-[SPIS_SUMI_LIST_2]-)
</div>
</p>

<br>
<p>
ОСТАВА ДА ДЪЛЖИТЕ: (-[TOTAL_SUMI_LIST_2]-) лв
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_footer.html") : smarty_modifier_cat($_tmp, "sd_footer.html")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>