<?php /* Smarty version 2.6.9, created on 2026-01-08 11:43:42
         compiled from /var/www/csi/outgoing/796_431_zemsluj.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/var/www/csi/outgoing/796_431_zemsluj.html', 8, false),)), $this); ?>
<?php $this->assign('tehead', "
ДО
<br>
Общинска служба \"Земеделие\" 
<br>
(-[DO_OBSHTINA]-)
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_header.html") : smarty_modifier_cat($_tmp, "sd_header.html")), 'smarty_include_vars' => array('TEXT' => $this->_tpl_vars['tehead'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<p align=justify style="text-indent:1in">
Моля, на основание чл. 431 ал.З ГПК, да ми съобщите какви земеделски земи и / или гори притежава лицето 
<b>(-[DLUJNIK_NAME]-) ЕГН (-[DLUJNIK_EGN_BULSTAT]-)</b> с адрес (-[DLUJNIK_ADDRESS]-) - длъжник по изп. дело № (-[DELO_NUMBER]-)/(-[DELO_YEAR]-) г., 
както и в качеството му на НАСЛЕДНИК.
</p>
<p align=justify>
Моля в справката да упоменете номерата на документите за собственост.
</p>
<p align=justify>
Моля в справката да бъдат приложени копия от нотариални актове или др. титули за собственост, ако има приложени такива.
</p>
<p align=justify>
Сведенията ни са необходими за извършване на принудителни изпълнителни действия.
</p>
<?php $this->assign('tefoot', "
<br><br><br><br>Връчител : 
<br><br>Получател : 
<br><br>Дата : 
");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['INCPAT'])) ? $this->_run_mod_handler('cat', true, $_tmp, "sd_footer.html") : smarty_modifier_cat($_tmp, "sd_footer.html")), 'smarty_include_vars' => array('TEXT' => $this->_tpl_vars['tefoot'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>